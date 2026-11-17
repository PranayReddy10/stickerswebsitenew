<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An ad of your own, shown in the app when no network had one.
 *
 * <p>Last in the waterfall on purpose. Every network ahead of it pays; this one
 * does not, so it only ever takes the slots nobody bought - which is also why it
 * can never fail to fill. A phone with no connection to any ad network still has
 * these, because they come down with the settings and are cached.
 *
 * @ORM\Table(name="house_ad_table")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HouseAdRepository")
 */
class HouseAd
{
    /** The slot shapes an ad can be written for. */
    const FORMAT_BANNER = 'BANNER';
    const FORMAT_MREC = 'MREC';
    const FORMAT_NATIVE = 'NATIVE';
    const FORMAT_INTERSTITIAL = 'INTERSTITIAL';
    const FORMAT_REWARDED = 'REWARDED';

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Which slot this is for. One ad serves one shape: a 320x50 strip and a full
     * page are not the same picture, however much you would like them to be.
     *
     * @ORM\Column(name="format", type="string", length=32)
     */
    private $format = self::FORMAT_BANNER;

    /**
     * @ORM\Column(name="title", type="string", length=120, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(name="body", type="string", length=255, nullable=true)
     */
    private $body;

    /**
     * What the button says. "Open" unless you have something better.
     *
     * @ORM\Column(name="cta", type="string", length=40, nullable=true)
     */
    private $cta;

    /**
     * @ORM\ManyToOne(targetEntity="MediaBundle\Entity\Media")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id", nullable=true)
     */
    private $image;

    /** Uploaded picture, before it becomes a Media. Not a column. */
    private $imagefile;

    /**
     * Where tapping it goes. A Play listing, your shop, anything the phone can
     * open. Without one there is nothing to tap, so the app skips the ad.
     *
     * @ORM\Column(name="url", type="string", length=500, nullable=true)
     * @Assert\Url()
     */
    private $url;

    /**
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled = true;

    /**
     * Relative share of the slots for this format. Two ads at 1 and 3 means the
     * second is picked three times as often.
     *
     * @ORM\Column(name="weight", type="integer")
     */
    private $weight = 1;

    /**
     * Running totals. Kept on the row as well as by day so the list can be sorted
     * on them without summing the day table every time it is drawn.
     *
     * @ORM\Column(name="impressions", type="integer")
     */
    private $impressions = 0;

    /**
     * @ORM\Column(name="clicks", type="integer")
     */
    private $clicks = 0;

    /**
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    public function __construct()
    {
        $this->created = new \DateTime();
    }

    /** Every format, for a dropdown. */
    public static function formats()
    {
        return array(
            self::FORMAT_BANNER => 'Banner - the strip at the bottom of a screen',
            self::FORMAT_MREC => 'MREC - the box between packs',
            self::FORMAT_NATIVE => 'Native - a card in the list, built from the parts below',
            self::FORMAT_INTERSTITIAL => 'Interstitial - the full page between screens',
            self::FORMAT_REWARDED => 'Rewarded - the full page somebody opted into',
        );
    }

    /** The size the picture for this format should be. */
    public static function sizeFor($format)
    {
        switch ($format) {
            case self::FORMAT_BANNER: return '640 x 100 (a 320 x 50 banner at 2x)';
            case self::FORMAT_MREC: return '600 x 500 (a 300 x 250 box at 2x)';
            case self::FORMAT_NATIVE: return '1200 x 628';
            default: return '1080 x 1920 portrait';
        }
    }

    /**
     * Whether this ad can actually be shown.
     *
     * <p>A native ad is built from its text, so it needs a title; every other
     * format is the picture itself. All of them need somewhere to go.
     */
    public function isServable()
    {
        if (!$this->enabled || trim((string) $this->url) === '') {
            return false;
        }
        // Normalised rather than compared raw: a row written before the form was
        // fixed holds a label, and a native ad judged by the wrong branch is
        // asked for a picture it was never meant to have.
        if (self::normaliseFormat($this->format) === self::FORMAT_NATIVE) {
            return trim((string) $this->title) !== '';
        }

        return $this->image !== null;
    }

    /** Clicks per hundred impressions, the number everyone actually reads. */
    public function ctr()
    {
        if ($this->impressions <= 0) {
            return 0.0;
        }

        return round(($this->clicks / $this->impressions) * 100, 2);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setFormat($format)
    {
        $this->format = self::normaliseFormat($format);

        return $this;
    }

    /**
     * The key for whatever was passed in.
     *
     * <p>Guards the column against anything that is not one of the five keys, and
     * repairs a row written by the form before it was fixed: that stored the
     * label rather than the key, cut to the column's 32 characters, so the match
     * is on what is left of the label.
     */
    public static function normaliseFormat($raw)
    {
        $value = strtoupper(trim((string) $raw));
        $formats = self::formats();
        if (isset($formats[$value])) {
            return $value;
        }

        foreach ($formats as $key => $label) {
            if ($value !== '' && strpos(strtoupper($label), $value) === 0) {
                return $key;
            }
        }

        return self::FORMAT_BANNER;
    }

    public function getFormat()
    {
        return $this->format;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setCta($cta)
    {
        $this->cta = $cta;

        return $this;
    }

    public function getCta()
    {
        return $this->cta;
    }

    /** The button's words, with a sensible default rather than an empty button. */
    public function buttonText()
    {
        $cta = trim((string) $this->cta);

        return $cta === '' ? 'Open' : $cta;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImagefile($imagefile)
    {
        $this->imagefile = $imagefile;

        return $this;
    }

    public function getImagefile()
    {
        return $this->imagefile;
    }

    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getEnabled()
    {
        return $this->enabled;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function setImpressions($impressions)
    {
        $this->impressions = $impressions;

        return $this;
    }

    public function getImpressions()
    {
        return $this->impressions;
    }

    public function setClicks($clicks)
    {
        $this->clicks = $clicks;

        return $this;
    }

    public function getClicks()
    {
        return $this->clicks;
    }

    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    public function getCreated()
    {
        return $this->created;
    }
}

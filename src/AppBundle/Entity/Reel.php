<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * A short vertical photo or video post, shown in the app's Reels tab.
 *
 * The media itself lives in DigitalOcean Spaces; this row only keeps the object
 * keys, so the bucket can be moved or put behind a CDN without touching the data.
 *
 * @ORM\Table(name="reel_table")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReelRepository")
 */
class Reel
{
    const TYPE_VIDEO = 'video';
    const TYPE_PHOTO = 'photo';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $user;

    /**
     * "video" or "photo".
     *
     * @ORM\Column(name="type", type="string", length=16)
     */
    private $type = self::TYPE_VIDEO;

    /**
     * Object key inside the Spaces bucket, e.g. reels/2026/02/ab12….mp4
     *
     * @ORM\Column(name="objectkey", type="string", length=500)
     */
    private $objectkey;

    /**
     * Object key of the poster frame. Videos need one so the feed can show
     * something before playback starts; photos reuse the media key.
     *
     * @ORM\Column(name="thumbkey", type="string", length=500, nullable=true)
     */
    private $thumbkey;

    /**
     * @ORM\Column(name="caption", type="text", nullable=true)
     */
    private $caption;

    /**
     * @ORM\Column(name="width", type="integer", nullable=true)
     */
    private $width;

    /**
     * @ORM\Column(name="height", type="integer", nullable=true)
     */
    private $height;

    /**
     * Video length in seconds. Null for photos.
     *
     * @ORM\Column(name="duration", type="integer", nullable=true)
     */
    private $duration;

    /**
     * @ORM\Column(name="views", type="integer")
     */
    private $views = 0;

    /**
     * Denormalised like counter so the feed does not have to count rows.
     *
     * @ORM\Column(name="likes", type="integer")
     */
    private $likes = 0;

    /**
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled = true;

    /**
     * True while the reel is waiting for a moderator.
     *
     * @ORM\Column(name="review", type="boolean")
     */
    private $review = false;

    /**
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @ORM\OneToMany(targetEntity="ReelLike", mappedBy="reel", cascade={"remove"})
     */
    private $reelLikes;

    public function __construct()
    {
        $this->created = new \DateTime();
        $this->reelLikes = new ArrayCollection();
    }

    public function isVideo()
    {
        return $this->type === self::TYPE_VIDEO;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type === self::TYPE_PHOTO ? self::TYPE_PHOTO : self::TYPE_VIDEO;
        return $this;
    }

    public function getObjectkey()
    {
        return $this->objectkey;
    }

    public function setObjectkey($objectkey)
    {
        $this->objectkey = $objectkey;
        return $this;
    }

    public function getThumbkey()
    {
        return $this->thumbkey;
    }

    public function setThumbkey($thumbkey)
    {
        $this->thumbkey = $thumbkey;
        return $this;
    }

    public function getCaption()
    {
        return $this->caption;
    }

    public function setCaption($caption)
    {
        $this->caption = $caption;
        return $this;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function setHeight($height)
    {
        $this->height = $height;
        return $this;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function setDuration($duration)
    {
        $this->duration = $duration;
        return $this;
    }

    public function getViews()
    {
        return $this->views === null ? 0 : $this->views;
    }

    public function setViews($views)
    {
        $this->views = $views;
        return $this;
    }

    public function getLikes()
    {
        return $this->likes === null ? 0 : $this->likes;
    }

    public function setLikes($likes)
    {
        $this->likes = $likes < 0 ? 0 : $likes;
        return $this;
    }

    public function getEnabled()
    {
        return $this->enabled;
    }

    /** "true" / "false" for the JSON the app consumes. */
    public function getEnabledValue()
    {
        return $this->enabled ? "true" : "false";
    }

    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
        return $this;
    }

    public function getReview()
    {
        return $this->review;
    }

    public function getReviewValue()
    {
        return $this->review ? "true" : "false";
    }

    public function setReview($review)
    {
        $this->review = $review;
        return $this;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    public function getReelLikes()
    {
        return $this->reelLikes;
    }
}

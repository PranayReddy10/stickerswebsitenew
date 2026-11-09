<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * One ad, one day: how often it was shown and how often it was tapped.
 *
 * <p>A row per ad per day rather than a row per event. A phone reports every
 * impression, and at the volumes this app sees that would be millions of rows a
 * month to answer a question nobody asks at that resolution. By day is what the
 * panel draws and what anyone actually reads.
 *
 * @ORM\Table(name="house_ad_stat_table",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="house_ad_day", columns={"ad_id", "day"})},
 *     indexes={@ORM\Index(name="house_stat_day", columns={"day"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HouseAdStatRepository")
 */
class HouseAdStat
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="HouseAd")
     * @ORM\JoinColumn(name="ad_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $ad;

    /**
     * Kept alongside the ad so the panel can total a format without joining, and
     * so the numbers survive an ad being deleted and replaced.
     *
     * @ORM\Column(name="format", type="string", length=32)
     */
    private $format;

    /**
     * @ORM\Column(name="day", type="date")
     */
    private $day;

    /**
     * @ORM\Column(name="impressions", type="integer")
     */
    private $impressions = 0;

    /**
     * @ORM\Column(name="clicks", type="integer")
     */
    private $clicks = 0;

    public function getId()
    {
        return $this->id;
    }

    public function setAd($ad)
    {
        $this->ad = $ad;

        return $this;
    }

    public function getAd()
    {
        return $this->ad;
    }

    public function setFormat($format)
    {
        $this->format = $format;

        return $this;
    }

    public function getFormat()
    {
        return $this->format;
    }

    public function setDay($day)
    {
        $this->day = $day;

        return $this;
    }

    public function getDay()
    {
        return $this->day;
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
}

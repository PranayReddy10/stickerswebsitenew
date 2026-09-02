<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Device
 *
 * @ORM\Table(name="device_table")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DeviceRepository")
 */
class Device
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="text")
     */
    private $token;

    /**
     * First time this install said hello.
     *
     * Nullable because the devices already in the table were never dated.
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    private $created;

    /**
     * The last time it opened the app.
     *
     * <p>The app registers for notifications every time the home screen starts, so
     * this endpoint is already an "app opened" ping - it just was not written down.
     * That is what makes "active today" answerable without asking the app for
     * anything new.
     *
     * @ORM\Column(name="seen", type="datetime", nullable=true)
     */
    private $seen;

    /**
     * How many times it has opened the app since this was added.
     *
     * @ORM\Column(name="opens", type="integer")
     */
    private $opens = 1;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set token
     *
     * @param string $token
     * @return Device
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string 
     */
    public function getToken()
    {
        return $this->token;
    }

    public function __construct()
    {
        $this->created = new \DateTime();
        $this->seen = new \DateTime();
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

    public function getSeen()
    {
        return $this->seen;
    }

    public function setSeen($seen)
    {
        $this->seen = $seen;

        return $this;
    }

    public function getOpens()
    {
        return $this->opens;
    }

    public function setOpens($opens)
    {
        $this->opens = $opens;

        return $this;
    }

    /** Counts one more app open. */
    public function open()
    {
        $this->opens++;
        $this->seen = new \DateTime();

        return $this;
    }
}

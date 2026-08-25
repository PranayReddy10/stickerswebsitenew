<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * One user liking one reel. The pair is unique, so liking twice is a no-op and
 * the app can ask whether the current user already liked a reel.
 *
 * @ORM\Table(name="reel_like_table",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="reel_user_unique", columns={"reel_id", "user_id"})})
 * @ORM\Entity()
 */
class ReelLike
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
     * @ORM\ManyToOne(targetEntity="Reel", inversedBy="reelLikes")
     * @ORM\JoinColumn(name="reel_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $reel;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $user;

    /**
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    public function __construct()
    {
        $this->created = new \DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getReel()
    {
        return $this->reel;
    }

    public function setReel($reel)
    {
        $this->reel = $reel;
        return $this;
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

    public function getCreated()
    {
        return $this->created;
    }

    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }
}

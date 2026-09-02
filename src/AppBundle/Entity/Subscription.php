<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * One subscription, as the app has seen it.
 *
 * <p>Google Play owns the truth; this is the app's report of what Play told it,
 * so the panel can answer questions Play's own console will not: which of your
 * users subscribed, from which device, and how many times.
 *
 * <p>A row is the purchase, not the check: the same purchase token seen again at
 * the next launch updates this row rather than adding another. Play only returns
 * subscriptions that are live, so a row stops being refreshed when one lapses -
 * the app says so outright, and the panel also treats a row nobody has confirmed
 * for a while as gone.
 *
 * @ORM\Table(name="subscription_table")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SubscriptionRepository")
 */
class Subscription
{
    /** Live as far as the last check could tell. */
    const STATE_ACTIVE = 'active';
    /** Play stopped returning it, or the app said it was gone. */
    const STATE_EXPIRED = 'expired';

    /** Days without a confirmation after which a row is no longer counted as live. */
    const STALE_DAYS = 5;

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Who was signed in when it was reported, if anybody was. A subscription is
     * tied to a Play account rather than to an account here, so this is nullable.
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL", nullable=true)
     */
    private $user;

    /**
     * The installation it was seen on - the same id the app already sends when it
     * registers for notifications, so devices line up between the two.
     *
     * @ORM\Column(name="device", type="string", length=191, nullable=true)
     */
    private $device;

    /**
     * @ORM\Column(name="product", type="string", length=191, nullable=true)
     */
    private $product;

    /**
     * Play's purchase token. Long, so what is indexed is the hash below.
     *
     * @ORM\Column(name="purchasetoken", type="text", nullable=true)
     */
    private $purchasetoken;

    /**
     * sha1 of the purchase token: what makes one purchase one row.
     *
     * @ORM\Column(name="tokenhash", type="string", length=40, nullable=true)
     */
    private $tokenhash;

    /**
     * @ORM\Column(name="orderid", type="string", length=191, nullable=true)
     */
    private $orderid;

    /**
     * @ORM\Column(name="state", type="string", length=32)
     */
    private $state = self::STATE_ACTIVE;

    /**
     * Which store it came from. Only Google Play today, but a row should say so
     * rather than leave the next store to be told apart by guesswork.
     *
     * @ORM\Column(name="platform", type="string", length=32)
     */
    private $platform = 'google_play';

    /**
     * @ORM\Column(name="renewing", type="boolean")
     */
    private $renewing = true;

    /**
     * When Play says the purchase was made.
     *
     * @ORM\Column(name="started", type="datetime", nullable=true)
     */
    private $started;

    /**
     * When this server first heard about it.
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * The last time the app confirmed it was still live.
     *
     * @ORM\Column(name="updated", type="datetime")
     */
    private $updated;

    /**
     * How many times the app has confirmed this purchase. A rough measure of how
     * long somebody has been with you, without storing a row per launch.
     *
     * @ORM\Column(name="checks", type="integer")
     */
    private $checks = 1;

    public function __construct()
    {
        $this->created = new \DateTime();
        $this->updated = new \DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setDevice($device)
    {
        $this->device = $device;

        return $this;
    }

    public function getDevice()
    {
        return $this->device;
    }

    /** The device id shortened for a table, which is wide enough to recognise. */
    public function getDeviceShort()
    {
        return $this->device === null ? '' : substr($this->device, 0, 12);
    }

    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function setPurchasetoken($purchasetoken)
    {
        $this->purchasetoken = $purchasetoken;
        $this->tokenhash = $purchasetoken === null ? null : sha1($purchasetoken);

        return $this;
    }

    public function getPurchasetoken()
    {
        return $this->purchasetoken;
    }

    public function getTokenhash()
    {
        return $this->tokenhash;
    }

    public function setOrderid($orderid)
    {
        $this->orderid = $orderid;

        return $this;
    }

    public function getOrderid()
    {
        return $this->orderid;
    }

    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setPlatform($platform)
    {
        $this->platform = $platform;

        return $this;
    }

    public function getPlatform()
    {
        return $this->platform;
    }

    public function setRenewing($renewing)
    {
        $this->renewing = (bool) $renewing;

        return $this;
    }

    public function getRenewing()
    {
        return $this->renewing;
    }

    public function setStarted($started)
    {
        $this->started = $started;

        return $this;
    }

    public function getStarted()
    {
        return $this->started;
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

    public function getUpdated()
    {
        return $this->updated;
    }

    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    public function getChecks()
    {
        return $this->checks;
    }

    public function setChecks($checks)
    {
        $this->checks = $checks;

        return $this;
    }

    /** Counts one more confirmation from the app. */
    public function seen()
    {
        $this->checks++;
        $this->updated = new \DateTime();

        return $this;
    }

    /**
     * Live, as best this server can tell.
     *
     * <p>A phone that is switched off stops confirming, so a row that has not been
     * seen for a few days is treated as gone even though nothing said so. Without
     * that, "active" would only ever grow.
     */
    public function getLive()
    {
        if ($this->state !== self::STATE_ACTIVE) {
            return false;
        }
        $stale = new \DateTime('-' . self::STALE_DAYS . ' days');

        return $this->updated > $stale;
    }

    /** How long it has been going, in whole days. */
    public function getDays()
    {
        $from = $this->started ? $this->started : $this->created;
        $to = $this->getLive() ? new \DateTime() : $this->updated;

        return max(0, (int) $from->diff($to)->days);
    }

    /**
     * How long it has been going, in words.
     *
     * <p>Days alone reads as "0 days" for most of the first day of a subscription,
     * which looks like nothing has happened when in fact it started this morning.
     */
    public function getRunning()
    {
        $from = $this->started ? $this->started : $this->created;
        $to = $this->getLive() ? new \DateTime() : $this->updated;
        $difference = $from->diff($to);

        if ($difference->days >= 1) {
            return $difference->days . ' day' . ($difference->days == 1 ? '' : 's');
        }
        if ($difference->h >= 1) {
            return $difference->h . ' hour' . ($difference->h == 1 ? '' : 's');
        }

        return 'under an hour';
    }
}

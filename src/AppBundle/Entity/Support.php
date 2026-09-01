<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Support
 *
 * @ORM\Table(name="support_table")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SupportRepository")
 */
class Support
{
    /** A message somebody wrote from Contact us. */
    const KIND_CONTACT = 'contact';
    /** A report about a sticker pack. */
    const KIND_PACK = 'pack';
    /** A report about a user. */
    const KIND_USER = 'user';
    /** A report about a reel. */
    const KIND_REEL = 'reel';
    /** Stars and a comment from the rate-the-app dialog. */
    const KIND_RATING = 'rating';

    /** The kinds the panel knows, in the order it lists them. */
    public static function kinds()
    {
        return array(self::KIND_CONTACT, self::KIND_RATING,
            self::KIND_PACK, self::KIND_USER, self::KIND_REEL);
    }

    /** What to call each kind on screen. */
    public static function labels()
    {
        return array(
            self::KIND_CONTACT => 'Contact',
            self::KIND_RATING => 'App rating',
            self::KIND_PACK => 'Pack report',
            self::KIND_USER => 'User report',
            self::KIND_REEL => 'Reel report',
        );
    }

    /**
     * Works out what a message is about from its text.
     *
     * <p>Every report used to arrive as a wall of prose with an id buried in it, and
     * the app versions already on people's phones still send exactly that. Reading
     * the id back out is what lets an old message, and an old app, still be filed
     * under the right heading.
     *
     * @return array kind and target id
     */
    public static function classify($message, $email = null, $subject = null)
    {
        $text = (string) $message;
        // The rate-the-app dialog has no address to send: it puts its own label in
        // the email field and the stars in the name, which is how an old one is
        // recognised.
        $address = (string) $email;
        $noAddress = strpos($address, '@') === false;
        if (($noAddress && stripos($address, 'rating') !== false)
                || preg_match('/star\(s\)\s*rating/i', (string) $subject)) {
            return array(self::KIND_RATING, null);
        }
        // Reel first: its wording contains the word id on its own, so a looser
        // pattern below would otherwise claim it.
        if (preg_match('/reel[^0-9]{0,20}id\s*:?\s*(\d+)/i', $text, $m)) {
            return array(self::KIND_REEL, (int) $m[1]);
        }
        if (preg_match('/user[^0-9]{0,24}id\s*:?\s*(\d+)/i', $text, $m)) {
            return array(self::KIND_USER, (int) $m[1]);
        }
        if (preg_match('/(?:status|pack)[^0-9]{0,24}id\s*:?\s*(\d+)/i', $text, $m)) {
            return array(self::KIND_PACK, (int) $m[1]);
        }
        return array(self::KIND_CONTACT, null);
    }

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
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=255)
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text")
     */
    private $message;

    /**
     * What this message is: a plain contact, or a report about a pack, a user or
     * a reel. Nullable because rows written before this existed have no value -
     * classify() reads those out of the message text instead.
     *
     * @var string
     *
     * @ORM\Column(name="kind", type="string", length=32, nullable=true)
     */
    private $kind;

    /**
     * The id of the thing being reported, when there is one.
     *
     * @var int
     *
     * @ORM\Column(name="targetid", type="integer", nullable=true)
     */
    private $targetid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    public function __construct(){
        $this->created= new \DateTime();
    
    }
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
     * Set email
     *
     * @param string $email
     * @return Support
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set subject
     *
     * @param string $subject
     * @return Support
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return Support
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Support
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    public function setKind($kind)
    {
        $this->kind = $kind;

        return $this;
    }

    /**
     * What this message is, falling back to reading it out of the text.
     *
     * @return string one of the KIND_ constants
     */
    public function getKind()
    {
        if (in_array($this->kind, self::kinds(), true)) {
            return $this->kind;
        }
        $guess = self::classify($this->message, $this->email, $this->subject);

        return $guess[0];
    }

    public function setTargetid($targetid)
    {
        $this->targetid = $targetid;

        return $this;
    }

    /**
     * The id of the pack, user or reel being reported, or null.
     *
     * @return int|null
     */
    public function getTargetid()
    {
        if ($this->targetid) {
            return $this->targetid;
        }
        $guess = self::classify($this->message, $this->email, $this->subject);

        return $guess[1];
    }

    /** The heading this message is filed under. */
    public function getLabel()
    {
        $labels = self::labels();
        $kind = $this->getKind();

        return isset($labels[$kind]) ? $labels[$kind] : $kind;
    }

    /** True for a report about something, which is what has a target to open. */
    public function getReport()
    {
        return in_array($this->getKind(),
            array(self::KIND_PACK, self::KIND_USER, self::KIND_REEL), true);
    }

    /** True when the address is one somebody can actually be written back to. */
    public function getReplyable()
    {
        return strpos((string) $this->email, '@') !== false;
    }

    /**
     * Who wrote in.
     *
     * <p>The name has always been stored in the subject column - the app sends it as
     * the form's name field - so this says what it actually holds.
     */
    public function getName()
    {
        return $this->subject;
    }
}

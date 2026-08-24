<?php

namespace MediaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Media
 *
 * @ORM\Table(name="media_table")
 * @ORM\Entity(repositoryClass="MediaBundle\Repository\MediaRepository")
 */
class Media
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @Assert\File(
     *     mimeTypes={"image/gif","image/jpeg","image/png","image/webp"},
     *     maxSize="10M"
     * )
     */
    private $file;

    /**
     * @ORM\Column(name="titre", type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * filename.webp  OR  https://cdn.site.com/file.webp
     *
     * @ORM\Column(name="url", type="string", length=500)
     */
    private $url;

    /**
     * image/webp, image/png, youtube
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * webp, png, jpg, jpeg, gif
     *
     * @ORM\Column(name="extension", type="string", length=255)
     */
    private $extension;

    /**
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

    private $fileName;

    public function __construct()
    {
        $this->date = new \DateTime();
        $this->enabled = true;
    }

    /* ===================== GETTERS / SETTERS ===================== */

    public function getId()
    {
        return $this->id;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
        return $this;
    }

    public function getTitre()
    {
        return $this->titre;
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

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setExtension($extension)
    {
        $this->extension = $extension;
        return $this;
    }

    public function getExtension()
    {
        return $this->extension;
    }

    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    public function getDate()
    {
        return $this->date;
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

    /* ===================== 🔑 FINAL FIX ===================== */

    /**
     * Returns final usable media URL
     */
    public function getLink()
    {
        // External URL → return directly
        if (filter_var($this->url, FILTER_VALIDATE_URL)) {
            return $this->url;
        }

        // Local file → extension-based folders
        return "uploads/" . $this->extension . "/" . $this->url;
    }

    /* ===================== FILE UPLOAD ===================== */

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }

    public function upload($path)
    {
        $file = $this->getFile();
        $this->fileName = md5(uniqid());
        $fileName = $this->fileName . '.' . $file->guessExtension();

        $this->setTitre($file->getClientOriginalName());
        $this->setUrl($fileName);
        $this->setType($file->getMimeType());
        $this->setExtension($file->guessExtension());

        $file->move(
            $path . "/" . $file->guessExtension(),
            $fileName
        );
    }

    public function delete($basePath)
    {
        if ($this->enabled && !filter_var($this->url, FILTER_VALIDATE_URL)) {
            @unlink($basePath . $this->extension . "/" . $this->url);
        }
    }

    /* ===================== YOUTUBE SUPPORT (UNCHANGED) ===================== */

    public function addVideo($url)
    {
        $video_id = explode("?v=", $url);
        if (empty($video_id[1])) {
            $video_id = explode("/v/", $url);
        }

        $video_id = explode("&", $video_id[1]);
        $video_id = $video_id[0];

        $content = @file_get_contents("http://youtube.com/get_video_info?video_id=" . $video_id);
        @parse_str($content, $ytarr);

        if (!empty($ytarr['title'])) {
            $this->setTitre($ytarr['title']);
        }

        $this->setUrl($url);
        $this->setType("youtube");
    }

    private function getYoutubeId()
    {
        try {
            $video_id = explode("?v=", $this->url);
            if (empty($video_id[1])) {
                $video_id = explode("/v/", $this->url);
            }
            $video_id = explode("&", $video_id[1]);
            return $video_id[0];
        } catch (\Exception $e) {
            return "invalid";
        }
    }

    public function getImage()
    {
        return "http://img.youtube.com/vi/" . $this->getYoutubeId() . "/hqdefault.jpg";
    }

    public function getImageL()
    {
        return "http://img.youtube.com/vi/" . $this->getYoutubeId() . "/maxresdefault.jpg";
    }

    public function generateThum($path)
    {
        $thum = new Media();
        $thum->setExtension("png");
        $thum->setType("image/png");
        $thum->setTitre(str_replace(".gif", "", $this->getTitre()));
        $thum->setUrl($this->fileName . ".png");
        $thum->setEnabled(true);

        imagepng(
            imagecreatefromstring(file_get_contents($this->getLink())),
            $path . "/png/" . $this->fileName . ".png"
        );

        return $thum;
    }
}

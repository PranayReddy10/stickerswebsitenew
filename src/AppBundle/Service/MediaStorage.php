<?php

namespace AppBundle\Service;

use MediaBundle\Entity\Media;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Where a pack's pictures are kept.
 *
 * Two choices, made per pack on the add form: this server's own uploads folder,
 * which is what the panel has always done, or the DigitalOcean Space the reels
 * already use. Either way the result is a Media row - the only difference is
 * whether its url column holds a file name or a full https URL, which
 * Media::getLink() has always known how to tell apart. Nothing else in the panel
 * or the app has to care.
 */
class MediaStorage
{
    /** The uploads folder on this server. */
    const LOCAL = 'local';
    /** The DigitalOcean Space, same bucket the reels go to. */
    const SPACES = 'spaces';

    private $spaces;
    private $filesDirectory;

    public function __construct(SpacesClient $spaces, $filesDirectory)
    {
        $this->spaces = $spaces;
        $this->filesDirectory = $filesDirectory;
    }

    /** False when no Space is configured, so the form can say so instead of failing. */
    public function spacesAvailable()
    {
        return $this->spaces->isConfigured();
    }

    /** The target actually usable, so a stale form value cannot lose an upload. */
    public function resolveTarget($target)
    {
        return ($target === self::SPACES && $this->spacesAvailable()) ? self::SPACES : self::LOCAL;
    }

    /**
     * The target a pack is already using, read off one of its pictures.
     *
     * Adding a sticker to a pack whose files are in the Space should put it in the
     * Space too, rather than leaving one file behind on the server.
     */
    public function targetFor(Media $media = null)
    {
        return ($media !== null && $media->isRemote()) ? self::SPACES : self::LOCAL;
    }

    /**
     * Stores one uploaded file and hands back the Media describing it.
     *
     * The caller still persists it: this only decides where the bytes go.
     *
     * @param string $prefix folder inside the bucket, e.g. packs/12
     *
     * @throws \RuntimeException when the Space refuses the file, so a Media row is
     *                           never written pointing at something that is not there
     */
    public function store(UploadedFile $file, $target, $prefix)
    {
        $media = new Media();
        $media->setFile($file);

        if ($this->resolveTarget($target) === self::LOCAL) {
            $media->upload($this->filesDirectory);
            return $media;
        }

        // Read before the upload: an UploadedFile can no longer describe itself once
        // it has been moved, and guessExtension() is what names the object.
        $extension = $file->guessExtension();
        $mime = $file->getMimeType();
        $key = $this->spaces->buildKey($prefix, $extension);

        $result = $this->spaces->putFile($key, $mime, $file->getPathname());
        if ($result !== true) {
            throw new \RuntimeException(is_string($result) ? $result : 'Storage refused the file.');
        }

        $media->setTitre($file->getClientOriginalName());
        $media->setUrl($this->spaces->publicUrl($key));
        $media->setType($mime);
        $media->setExtension($extension);

        return $media;
    }

    /**
     * Removes the file behind a Media, wherever it was put.
     *
     * A bucket that will not answer must not stop the row being deleted, the same
     * rule the reels delete follows.
     */
    public function delete(Media $media)
    {
        if (!$media->isRemote()) {
            $media->delete($this->filesDirectory);
            return;
        }
        try {
            $key = $this->spaces->keyFromUrl($media->getUrl());
            if ($key !== '') {
                $this->spaces->deleteObject($key);
            }
        } catch (\Exception $e) {
            error_log('Could not delete pack file: ' . $e->getMessage());
        }
    }
}

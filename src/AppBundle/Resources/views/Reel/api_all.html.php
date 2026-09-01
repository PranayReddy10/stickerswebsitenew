<?php
/**
 * Reel feed for the app.
 *
 * @var $reels  AppBundle\Entity\Reel[]
 * @var $spaces AppBundle\Service\SpacesClient
 * @var $liked     array  reel id => true, for the viewer who asked
 * @var $following array  author id => true, for the same viewer
 */
$list = array();
foreach ($reels as $reel) {
    $author = $reel->getUser();

    $r = array();
    $r["id"] = $reel->getId() . "";
    $r["type"] = $reel->getType();
    $r["url"] = $spaces->publicUrl($reel->getObjectkey());
    // getThumb(), not the raw column: a photo is its own still.
    $r["thumb"] = $spaces->publicUrl($reel->getThumb());
    $r["caption"] = $reel->getCaption() === null ? "" : $reel->getCaption();
    $r["width"] = $reel->getWidth() === null ? 0 : $reel->getWidth();
    $r["height"] = $reel->getHeight() === null ? 0 : $reel->getHeight();
    $r["duration"] = $reel->getDuration() === null ? 0 : $reel->getDuration();
    $r["likes"] = $reel->getLikes();
    $r["views"] = $reel->getViews();
    $r["liked"] = isset($liked[$reel->getId()]) ? "true" : "false";
    $r["created"] = $view['time']->diff($reel->getCreated());

    $r["userid"] = $author ? $author->getId() . "" : "0";
    $r["user"] = $author ? $author->getName() : "";
    $r["userimage"] = $author ? $author->getImage() : "";
    // getTrusedValue() already returns the string "true"/"false"; note that "false"
    // is truthy in PHP, so it must be passed through, not tested.
    $r["trusted"] = $author ? $author->getTrusedValue() : "false";
    $r["following"] = ($author && isset($following[$author->getId()])) ? "true" : "false";

    $list[] = $r;
}
echo json_encode($list, JSON_UNESCAPED_SLASHES);

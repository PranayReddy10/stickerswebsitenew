<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Reel;
use AppBundle\Entity\ReelLike;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Reels: short vertical photo and video posts.
 *
 * The media never passes through this server. The app (or the admin's browser)
 * asks for a presigned URL, uploads straight to DigitalOcean Spaces, then calls
 * create with the object key it was given. That keeps large video off PHP's
 * upload limits entirely.
 */
class ReelController extends Controller
{
    /** Extensions accepted for each kind of reel, and the Content-Type to sign. */
    private static $VIDEO_TYPES = array(
        'mp4' => 'video/mp4',
        'mov' => 'video/quicktime',
        'webm' => 'video/webm',
    );
    private static $PHOTO_TYPES = array(
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png' => 'image/png',
        'webp' => 'image/webp',
    );

    // ======================================================== app facing API

    /** Newest reels from everyone. */
    public function api_feedAction(Request $request, $page, $user, $token)
    {
        $this->assertAppToken($token);
        $reels = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:Reel')->findFeed($page);
        return $this->renderReels($reels, $user);
    }

    /** Newest reels from the people this user follows. */
    public function api_by_followAction(Request $request, $page, $user, $token)
    {
        $this->assertAppToken($token);
        $reels = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:Reel')->findFollowing($page, $user);
        return $this->renderReels($reels, $user);
    }

    /** One author's reels, for the profile grid. */
    public function api_by_userAction(Request $request, $page, $author, $user, $token)
    {
        $this->assertAppToken($token);
        $reels = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:Reel')->findByUser($page, $author);
        return $this->renderReels($reels, $user);
    }

    /**
     * Step 1 of an upload: hand back a short lived URL the client can PUT to.
     *
     * Nothing is written to the database here. An abandoned upload just leaves an
     * orphaned object in the bucket, never a half created reel.
     */
    public function api_upload_urlAction(Request $request, $token)
    {
        $this->assertAppToken($token);
        $user = $this->assertUser($request->get('id'), $request->get('key'));

        $spaces = $this->get('app.spaces');
        if (!$spaces->isConfigured()) {
            return $this->error(503, 'Storage is not configured yet.');
        }

        $type = $request->get('type') === Reel::TYPE_PHOTO ? Reel::TYPE_PHOTO : Reel::TYPE_VIDEO;
        $allowed = $type === Reel::TYPE_PHOTO ? self::$PHOTO_TYPES : self::$VIDEO_TYPES;

        $extension = strtolower(trim((string) $request->get('ext')));
        if (!isset($allowed[$extension])) {
            return $this->error(400, 'Unsupported file type: ' . $extension);
        }

        $media = $spaces->presignPut(
            $spaces->buildKey('reels/' . $user->getId(), $extension),
            $allowed[$extension]);

        $payload = array(
            'code' => 200,
            'media' => $media,
        );

        // A video also needs a poster frame, so sign a second slot in one round trip.
        $thumbExtension = strtolower(trim((string) $request->get('thumbext')));
        if ($type === Reel::TYPE_VIDEO) {
            if (!isset(self::$PHOTO_TYPES[$thumbExtension])) {
                $thumbExtension = 'jpg';
            }
            $payload['thumb'] = $spaces->presignPut(
                $spaces->buildKey('reels/' . $user->getId() . '/thumbs', $thumbExtension),
                self::$PHOTO_TYPES[$thumbExtension]);
        }

        return new JsonResponse($payload);
    }

    /**
     * Step 2: the file is in the bucket, record the reel.
     *
     * The object key is checked against the caller's own prefix so one user cannot
     * claim a file uploaded by somebody else.
     */
    public function api_createAction(Request $request, $token)
    {
        $this->assertAppToken($token);
        $user = $this->assertUser($request->get('id'), $request->get('key'));

        $objectKey = (string) $request->get('objectkey');
        $prefix = 'reels/' . $user->getId() . '/';
        if ($objectKey === '' || strpos($objectKey, $prefix) !== 0) {
            return $this->error(400, 'That file does not belong to this user.');
        }

        $em = $this->getDoctrine()->getManager();
        $settings = $em->getRepository('AppBundle:Settings')->findOneBy(array());

        $reel = new Reel();
        $reel->setUser($user);
        $reel->setType($request->get('type'));
        $reel->setObjectkey($objectKey);
        $reel->setThumbkey($request->get('thumbkey') ? (string) $request->get('thumbkey') : $objectKey);
        $reel->setCaption($this->clean($request->get('caption'), 500));
        $reel->setWidth((int) $request->get('width') ?: null);
        $reel->setHeight((int) $request->get('height') ?: null);
        $reel->setDuration((int) $request->get('duration') ?: null);
        $reel->setEnabled(true);
        // Reels from the app wait for a moderator unless the panel says otherwise.
        $reel->setReview(!($settings && $settings->getReelsautopublishValue()));

        $em->persist($reel);
        $em->flush();

        return new JsonResponse(array(
            'code' => 200,
            'message' => $reel->getReview()
                ? 'Your reel was uploaded and is waiting for review.'
                : 'Your reel is live.',
            'id' => $reel->getId(),
            'review' => $reel->getReviewValue(),
        ));
    }

    /** Like or unlike. Returns the new state so the app does not have to guess. */
    public function api_likeAction(Request $request, $reelId, $token)
    {
        $this->assertAppToken($token);
        $user = $this->assertUser($request->get('id'), $request->get('key'));

        $em = $this->getDoctrine()->getManager();
        $reel = $em->getRepository('AppBundle:Reel')->find($reelId);
        if ($reel === null) {
            throw new NotFoundHttpException("Page not found");
        }

        $existing = $em->getRepository('AppBundle:ReelLike')
            ->findOneBy(array('reel' => $reel, 'user' => $user));

        if ($existing !== null) {
            $em->remove($existing);
            $reel->setLikes($reel->getLikes() - 1);
            $liked = false;
        } else {
            $like = new ReelLike();
            $like->setReel($reel);
            $like->setUser($user);
            $em->persist($like);
            $reel->setLikes($reel->getLikes() + 1);
            $liked = true;
        }
        $em->flush();

        return new JsonResponse(array(
            'code' => 200,
            'liked' => $liked ? 'true' : 'false',
            'likes' => $reel->getLikes(),
        ));
    }

    /** Bumps the view counter. Deliberately unauthenticated, it is only a metric. */
    public function api_viewAction(Request $request, $reelId, $token)
    {
        $this->assertAppToken($token);
        $em = $this->getDoctrine()->getManager();
        $reel = $em->getRepository('AppBundle:Reel')->find($reelId);
        if ($reel === null) {
            throw new NotFoundHttpException("Page not found");
        }
        $reel->setViews($reel->getViews() + 1);
        $em->flush();
        return new JsonResponse(array('code' => 200, 'views' => $reel->getViews()));
    }

    /** A user removing their own reel. */
    public function api_deleteAction(Request $request, $reelId, $token)
    {
        $this->assertAppToken($token);
        $user = $this->assertUser($request->get('id'), $request->get('key'));

        $em = $this->getDoctrine()->getManager();
        $reel = $em->getRepository('AppBundle:Reel')->find($reelId);
        if ($reel === null) {
            throw new NotFoundHttpException("Page not found");
        }
        if ($reel->getUser()->getId() !== $user->getId()) {
            return $this->error(403, 'That reel belongs to somebody else.');
        }
        $em->remove($reel);
        $em->flush();
        return new JsonResponse(array('code' => 200, 'message' => 'Reel deleted.'));
    }

    // ============================================================ admin panel

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $reels = $em->getRepository('AppBundle:Reel')
            ->findBy(array('review' => false), array('created' => 'DESC'));
        return $this->render('AppBundle:Reel:index.html.twig', array(
            'reels' => $reels,
            'spaces' => $this->get('app.spaces'),
        ));
    }

    public function reviewsAction()
    {
        $em = $this->getDoctrine()->getManager();
        return $this->render('AppBundle:Reel:reviews.html.twig', array(
            'reels' => $em->getRepository('AppBundle:Reel')->findPendingReview(),
            'spaces' => $this->get('app.spaces'),
        ));
    }

    public function approveAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $reel = $em->getRepository('AppBundle:Reel')->find($reelId);
        if ($reel === null) {
            throw new NotFoundHttpException("Page not found");
        }
        $reel->setReview(false);
        $reel->setEnabled(true);
        $em->flush();
        $this->addFlash('success', 'Reel published');
        return $this->redirect($this->generateUrl('app_reel_reviews'));
    }

    public function toggleAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $reel = $em->getRepository('AppBundle:Reel')->find($reelId);
        if ($reel === null) {
            throw new NotFoundHttpException("Page not found");
        }
        $reel->setEnabled(!$reel->getEnabled());
        $em->flush();
        $this->addFlash('success', $reel->getEnabled() ? 'Reel shown' : 'Reel hidden');
        return $this->redirect($this->generateUrl('app_reel_index'));
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $reel = $em->getRepository('AppBundle:Reel')->find($reelId);
        if ($reel === null) {
            throw new NotFoundHttpException("Page not found");
        }
        $em->remove($reel);
        $em->flush();
        $this->addFlash('success', 'Reel deleted');
        return $this->redirect($this->generateUrl('app_reel_index'));
    }

    /** The admin upload page; the browser uploads to Spaces the same way the app does. */
    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        return $this->render('AppBundle:Reel:add.html.twig', array(
            'spaces_ready' => $this->get('app.spaces')->isConfigured(),
            'spaces' => $this->get('app.spaces'),
            'php_limit' => ini_get('upload_max_filesize'),
            'php_post_limit' => ini_get('post_max_size'),
            // Sorted by name so the list can be scanned, and the signed-in admin is
            // preselected - defaulting to whichever user happens to have signed up
            // most recently is a good way to publish a reel as a stranger.
            'users' => $em->getRepository('UserBundle:User')->findBy(array(), array('name' => 'ASC')),
            'current_user_id' => $this->getUser() ? $this->getUser()->getId() : 0,
        ));
    }

    /** Presign for the admin page. Session protected rather than app-token protected. */
    public function admin_upload_urlAction(Request $request)
    {
        $spaces = $this->get('app.spaces');
        if (!$spaces->isConfigured()) {
            return $this->error(503, 'Storage is not configured yet.');
        }
        $type = $request->get('type') === Reel::TYPE_PHOTO ? Reel::TYPE_PHOTO : Reel::TYPE_VIDEO;
        $allowed = $type === Reel::TYPE_PHOTO ? self::$PHOTO_TYPES : self::$VIDEO_TYPES;
        $extension = strtolower(trim((string) $request->get('ext')));
        if (!isset($allowed[$extension])) {
            return $this->error(400, 'Unsupported file type: ' . $extension);
        }
        $userId = (int) $request->get('user');
        return new JsonResponse(array(
            'code' => 200,
            'media' => $spaces->presignPut(
                $spaces->buildKey('reels/' . $userId, $extension),
                $allowed[$extension]),
        ));
    }

    /**
     * Uploads a tiny object and reports exactly what Spaces said.
     *
     * Turns "SignatureDoesNotMatch, now what" into an answer: it names the S3 error
     * code and shows the loaded credentials safely, so a wrong, stale or truncated
     * secret is obvious without reading it off the page.
     */
    public function admin_spaces_checkAction(Request $request)
    {
        $spaces = $this->get('app.spaces');
        $info = $spaces->isConfigured()
            ? $spaces->describeCredentials($this->container->getParameter('spaces_secret'))
            : array();

        if (!$spaces->isConfigured()) {
            return new JsonResponse(array(
                'code' => 503,
                'message' => 'Spaces is not configured. Set spaces_key, spaces_secret and '
                    . 'spaces_bucket in app/config/parameters.yml, then clear app/cache.',
            ));
        }

        $tmp = tempnam(sys_get_temp_dir(), 'spaces');
        file_put_contents($tmp, 'ok');

        // Try both signing styles. If one works the upload path can just use it; if
        // both fail with the same error the credentials are the problem, not the
        // signing, and that is worth stating rather than guessing at.
        $key = $spaces->buildKey('reels/_healthcheck', 'txt');
        $header = $spaces->putFile($key, 'text/plain', $tmp, false);

        $presignedResult = null;
        if ($header !== true) {
            $presignedResult = $spaces->putFile(
                $spaces->buildKey('reels/_healthcheck', 'txt'), 'text/plain', $tmp, true);
        }
        unlink($tmp);

        if ($header === true) {
            // Put the probe object back where it came from; a health check has no
            // business leaving files in the bucket.
            $removed = $spaces->deleteObject($key);
            return new JsonResponse(array(
                'code' => 200,
                'message' => 'Spaces accepted a test upload and it was '
                    . ($removed ? 'deleted again. ' : 'left behind (delete was refused). ')
                    . 'Credentials and signing are good.',
                'credentials' => $info,
            ));
        }
        if ($presignedResult === true) {
            return new JsonResponse(array(
                'code' => 200,
                'message' => 'Spaces accepted a presigned upload but refused header signing. '
                    . 'Credentials are fine; tell me and I will pin the upload path to presigned.',
                'credentials' => $info,
            ));
        }
        $result = $header;

        $hint = '';
        if (strpos($result, 'SignatureDoesNotMatch') !== false) {
            $hint = ' The access key id was recognised but the secret does not match it. '
                . 'Either the two do not belong to the same key pair, or parameters.yml was '
                . 'changed without clearing app/cache (Symfony compiles parameters into the '
                . 'cached container, so an old secret survives an edit).';
        } elseif (strpos($result, 'InvalidAccessKeyId') !== false) {
            $hint = ' That access key id does not exist any more - it was probably rotated.';
        } elseif (strpos($result, 'NoSuchBucket') !== false) {
            $hint = ' The bucket name in spaces_bucket does not exist in this region.';
        }

        return new JsonResponse(array(
            'code' => 502,
            'message' => 'Both signing methods were refused. ' . $result . $hint,
            'credentials' => $info,
        ));
    }

    /**
     * Fallback upload for the admin page: the file comes to PHP, PHP sends it on.
     *
     * Slower and bound by the PHP upload limits, but it needs no CORS rule on the
     * bucket, so the panel keeps working while that is being sorted out.
     */
    public function admin_proxy_uploadAction(Request $request)
    {
        // The caller can only parse JSON, so nothing in here may escape as an
        // exception and become one of Symfony's HTML error pages.
        try {
            $spaces = $this->get('app.spaces');
            if (!$spaces->isConfigured()) {
                return $this->error(503, 'Storage is not configured yet.');
            }

            if (!$request->files->has('file')) {
                // PHP throws the whole body away when it is bigger than post_max_size,
                // leaving no files and no POST fields at all. Say so plainly, because
                // "no file was received" on its own sends people hunting in the wrong
                // place - and note post_max_size caps the request, not just the file.
                $sent = (int) $request->server->get('CONTENT_LENGTH');
                $limit = self::bytes(ini_get('post_max_size'));
                if ($limit > 0 && $sent > $limit) {
                    return $this->error(413, sprintf(
                        'PHP discarded the upload: the request was %s but post_max_size is %s. '
                        . 'Raise post_max_size (and upload_max_filesize, currently %s) in php.ini, '
                        . 'or add the CORS rule so the file goes straight to Spaces instead.',
                        self::human($sent), ini_get('post_max_size'), ini_get('upload_max_filesize')));
                }
                return $this->error(400, 'No file was received by the server.');
            }

            $file = $request->files->get('file');
            if (!$file->isValid()) {
                return $this->error(400, 'Upload failed: ' . $file->getErrorMessage());
            }

            $type = $request->get('type') === Reel::TYPE_PHOTO ? Reel::TYPE_PHOTO : Reel::TYPE_VIDEO;
            $allowed = $type === Reel::TYPE_PHOTO ? self::$PHOTO_TYPES : self::$VIDEO_TYPES;
            $extension = strtolower($file->getClientOriginalExtension());
            if (!isset($allowed[$extension])) {
                return $this->error(400, 'Unsupported file type: .' . $extension
                    . '. Allowed here: ' . implode(', ', array_keys($allowed)) . '.');
            }

            $objectKey = $spaces->buildKey('reels/' . (int) $request->get('user'), $extension);
            $result = $spaces->putFile($objectKey, $allowed[$extension], $file->getPathname());
            if ($result !== true) {
                return $this->error(502, $result);
            }

            return new JsonResponse(array(
                'code' => 200,
                'media' => array(
                    'object_key' => $objectKey,
                    'public_url' => $spaces->publicUrl($objectKey),
                ),
            ));
        } catch (\Exception $e) {
            return $this->error(500, get_class($e) . ': ' . $e->getMessage());
        }
    }

    /** Turns a php.ini shorthand size such as "8M" into bytes. */
    private static function bytes($shorthand)
    {
        $shorthand = trim((string) $shorthand);
        if ($shorthand === '') {
            return 0;
        }
        $value = (int) $shorthand;
        switch (strtolower(substr($shorthand, -1))) {
            case 'g': return $value * 1024 * 1024 * 1024;
            case 'm': return $value * 1024 * 1024;
            case 'k': return $value * 1024;
            default:  return $value;
        }
    }

    private static function human($bytes)
    {
        if ($bytes >= 1048576) {
            return round($bytes / 1048576, 1) . 'M';
        }
        return round($bytes / 1024) . 'K';
    }

    /** Admin reels skip the review queue. */
    public function admin_createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('UserBundle:User')->find((int) $request->get('user'));
        if ($user === null) {
            return $this->error(400, 'Pick an author for the reel.');
        }
        $reel = new Reel();
        $reel->setUser($user);
        $reel->setType($request->get('type'));
        $reel->setObjectkey((string) $request->get('objectkey'));
        $reel->setThumbkey($request->get('thumbkey') ? (string) $request->get('thumbkey') : (string) $request->get('objectkey'));
        $reel->setCaption($this->clean($request->get('caption'), 500));
        $reel->setEnabled(true);
        $reel->setReview(false);
        $em->persist($reel);
        $em->flush();
        return new JsonResponse(array('code' => 200, 'id' => $reel->getId()));
    }

    // ================================================================ helpers

    private function renderReels($reels, $viewerId)
    {
        return $this->render('AppBundle:Reel:api_all.html.php', array(
            'reels' => $reels,
            'spaces' => $this->get('app.spaces'),
            'liked' => $this->likedIds($reels, $viewerId),
        ));
    }

    /**
     * Which of these reels the viewer already liked, as an id => true map.
     * One query for the whole page rather than one per reel.
     */
    private function likedIds($reels, $viewerId)
    {
        $viewerId = (int) $viewerId;
        if ($viewerId <= 0 || count($reels) === 0) {
            return array();
        }
        $ids = array();
        foreach ($reels as $reel) {
            $ids[] = $reel->getId();
        }
        $rows = $this->getDoctrine()->getManager()
            ->createQueryBuilder()
            ->select('IDENTITY(l.reel) AS reel_id')
            ->from('AppBundle:ReelLike', 'l')
            ->where('l.user = :user')
            ->andWhere('l.reel IN (:ids)')
            ->setParameter('user', $viewerId)
            ->setParameter('ids', $ids)
            ->getQuery()
            ->getResult();

        $liked = array();
        foreach ($rows as $row) {
            $liked[(int) $row['reel_id']] = true;
        }
        return $liked;
    }

    private function assertAppToken($token)
    {
        if ($token != $this->container->getParameter('token_app')) {
            throw new NotFoundHttpException("Page not found");
        }
    }

    /** Same user check the pack upload endpoint uses. */
    private function assertUser($id, $key)
    {
        $user = $this->getDoctrine()->getManager()
            ->getRepository('UserBundle:User')->findOneBy(array('id' => $id));
        if ($user === null || sha1($user->getPassword()) != $key) {
            throw new NotFoundHttpException("Page not found");
        }
        return $user;
    }

    private function clean($value, $maxLength)
    {
        $value = trim(strip_tags((string) $value));
        if ($value === '') {
            return null;
        }
        return function_exists('mb_substr')
            ? mb_substr($value, 0, $maxLength)
            : substr($value, 0, $maxLength);
    }

    /**
     * Errors go back as HTTP 200 with the code in the body, matching how the rest of
     * this API already answers.
     *
     * This is not cosmetic: the site sits behind Cloudflare, which treats a 5xx from
     * the origin as a broken backend and serves its own "502 Bad gateway" page
     * instead, throwing away whatever the application was trying to say. Keeping the
     * transport status at 200 means the real message survives the proxy.
     */
    private function error($code, $message)
    {
        return new JsonResponse(array('code' => $code, 'message' => $message));
    }
}

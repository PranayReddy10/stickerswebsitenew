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
    public function api_likeAction(Request $request, $id, $token)
    {
        $this->assertAppToken($token);
        $user = $this->assertUser($request->get('id'), $request->get('key'));

        $em = $this->getDoctrine()->getManager();
        $reel = $em->getRepository('AppBundle:Reel')->find($id);
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
    public function api_viewAction(Request $request, $id, $token)
    {
        $this->assertAppToken($token);
        $em = $this->getDoctrine()->getManager();
        $reel = $em->getRepository('AppBundle:Reel')->find($id);
        if ($reel === null) {
            throw new NotFoundHttpException("Page not found");
        }
        $reel->setViews($reel->getViews() + 1);
        $em->flush();
        return new JsonResponse(array('code' => 200, 'views' => $reel->getViews()));
    }

    /** A user removing their own reel. */
    public function api_deleteAction(Request $request, $id, $token)
    {
        $this->assertAppToken($token);
        $user = $this->assertUser($request->get('id'), $request->get('key'));

        $em = $this->getDoctrine()->getManager();
        $reel = $em->getRepository('AppBundle:Reel')->find($id);
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
        $reel = $em->getRepository('AppBundle:Reel')->find($id);
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
        $reel = $em->getRepository('AppBundle:Reel')->find($id);
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
        $reel = $em->getRepository('AppBundle:Reel')->find($id);
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
            'users' => $em->getRepository('UserBundle:User')->findBy(array(), array('id' => 'DESC')),
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

    private function error($code, $message)
    {
        return new JsonResponse(array('code' => $code, 'message' => $message), $code);
    }
}

<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Subscription;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Subscriptions, as reported by the app.
 *
 * <p>Google Play knows who is paying; it does not know which of your users that
 * is, which device they use, or how many times they have subscribed before. The
 * app reports what Play tells it at every launch, and this keeps one row per
 * purchase so those questions have answers.
 */
class SubscriptionController extends Controller
{
    /**
     * The app reporting what Play said.
     *
     * <p>Called at every launch, so it has to be cheap and it has to be idempotent:
     * the same purchase token is the same row, seen once more.
     */
    public function api_reportAction(Request $request, $token)
    {
        if ($token != $this->container->getParameter('token_app')) {
            throw new NotFoundHttpException("Page not found");
        }

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Subscription');

        $purchaseToken = trim((string) $request->get('token'));
        $device = trim((string) $request->get('device'));
        $state = $request->get('state') === Subscription::STATE_EXPIRED
            ? Subscription::STATE_EXPIRED : Subscription::STATE_ACTIVE;

        // Nothing to hang a row on. An app that cannot name the purchase or the
        // device would otherwise pile up rows that mean nothing.
        if ($purchaseToken === '' && $device === '') {
            return new JsonResponse(array('code' => 400, 'message' => 'Nothing to record.'));
        }

        $subscription = $repository->findByToken($purchaseToken);

        // No token means the app is reporting that a subscription it used to see is
        // gone: close whatever this device last had rather than opening anything.
        if ($subscription === null && $purchaseToken === '') {
            if ($state === Subscription::STATE_EXPIRED) {
                $this->endFor($em, $device);
                return new JsonResponse(array('code' => 200, 'message' => 'Closed.'));
            }
            return new JsonResponse(array('code' => 400, 'message' => 'No purchase to record.'));
        }

        if ($subscription === null) {
            $subscription = new Subscription();
            $subscription->setPurchasetoken($purchaseToken);
            $subscription->setStarted($this->timeFrom($request->get('started')));
            $em->persist($subscription);
            // Play returns the one subscription a device currently has, so a purchase
            // token nobody has seen before means whatever this device reported last is
            // over. Without this a device that resubscribes shows two live rows and
            // the older one never closes.
            $this->endFor($em, $device, $purchaseToken);
        } else {
            $subscription->seen();
        }

        $subscription->setState($state);
        $subscription->setDevice($device === '' ? $subscription->getDevice() : $device);
        $subscription->setProduct($this->text($request->get('product'), 191));
        $subscription->setOrderid($this->text($request->get('order'), 191));
        $subscription->setPlatform($this->text($request->get('platform'), 32) ?: 'google_play');
        $subscription->setRenewing($request->get('renewing') !== '0');
        $subscription->setUser($this->userFrom($em, $request->get('user')));

        $em->flush();

        return new JsonResponse(array('code' => 200, 'message' => 'Recorded.'));
    }

    /**
     * Marks whatever this device last reported as over.
     *
     * @param string $except purchase token to leave alone - the one just reported
     */
    private function endFor($em, $device, $except = null)
    {
        if ($device === '') {
            return;
        }
        $open = $em->getRepository('AppBundle:Subscription')->findBy(
            array('device' => $device, 'state' => Subscription::STATE_ACTIVE));
        foreach ($open as $subscription) {
            if ($except !== null && $subscription->getPurchasetoken() === $except) {
                continue;
            }
            $subscription->setState(Subscription::STATE_EXPIRED);
            $subscription->setUpdated(new \DateTime());
        }
        $em->flush();
    }

    /** The signed in user, when there is one. A subscription without one is normal. */
    private function userFrom($em, $id)
    {
        $id = (int) $id;

        return $id > 0 ? $em->getRepository('UserBundle:User')->find($id) : null;
    }

    private function text($value, $length)
    {
        $value = trim((string) $value);

        return $value === '' ? null : substr($value, 0, $length);
    }

    /** Play reports the purchase time in milliseconds. */
    private function timeFrom($millis)
    {
        $millis = (float) $millis;
        if ($millis <= 0) {
            return null;
        }
        $date = new \DateTime();
        $date->setTimestamp((int) round($millis / 1000));

        return $date;
    }

    // ============================================================ admin panel

    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Subscription');

        $state = $request->query->get('state');
        if (!in_array($state, array(Subscription::STATE_ACTIVE, Subscription::STATE_EXPIRED), true)) {
            $state = null;
        }

        $perDay = $repository->startedPerDay();

        return $this->render('AppBundle:Subscription:index.html.twig', array(
            'pagination' => $this->get('knp_paginator')->paginate(
                $repository->listQuery($state),
                $request->query->getInt('page', 1),
                20
            ),
            'state' => $state,
            'totals' => $repository->totals(),
            'products' => $repository->byProduct(),
            'repeats' => $repository->repeatSubscribers(),
            'per_day' => $perDay,
            'peak' => max(1, max($perDay)),
            'stale_days' => Subscription::STALE_DAYS,
        ));
    }
}

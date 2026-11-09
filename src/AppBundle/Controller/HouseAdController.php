<?php

namespace AppBundle\Controller;

use AppBundle\Entity\HouseAd;
use AppBundle\Form\HouseAdType;
use MediaBundle\Entity\Media;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Your own ads: the last thing the waterfall tries, and the only one that cannot
 * fail to fill.
 *
 * <p>Two jobs in here. The panel side manages the creatives and shows how they
 * are doing; the app side hands them to the phone and takes back the counts.
 */
class HouseAdController extends Controller
{
    /** How long a phone may keep the list before asking again. */
    const CACHE_SECONDS = 1800;

    // ================================================================ panel

    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $ads = $em->getRepository('AppBundle:HouseAd')->all();

        $impressions = 0;
        $clicks = 0;
        $live = 0;
        foreach ($ads as $ad) {
            $impressions += $ad->getImpressions();
            $clicks += $ad->getClicks();
            if ($ad->getEnabled()) {
                $live++;
            }
        }

        // Totalled here, not in the template: a {% set %} inside a Twig for loop
        // does not escape the loop, so counting there would always come out zero.
        $days = $em->getRepository('AppBundle:HouseAdStat')->recentDays(14);
        $peak = 1;
        foreach ($days as $day) {
            if ($day['impressions'] > $peak) {
                $peak = $day['impressions'];
            }
        }

        return $this->render('AppBundle:HouseAd:index.html.twig', array(
            'ads' => $ads,
            'formats' => HouseAd::formats(),
            'totals' => $em->getRepository('AppBundle:HouseAd')->totalsByFormat(),
            'impressions' => $impressions,
            'clicks' => $clicks,
            'ctr' => $impressions > 0 ? round(($clicks / $impressions) * 100, 2) : 0,
            'live' => $live,
            'days' => $days,
            'peak' => $peak,
        ));
    }

    public function addAction(Request $request)
    {
        return $this->edit($request, new HouseAd());
    }

    public function editAction(Request $request, $id)
    {
        $ad = $this->getDoctrine()->getManager()->getRepository('AppBundle:HouseAd')->find($id);
        if ($ad === null) {
            throw new NotFoundHttpException('Page not found');
        }

        return $this->edit($request, $ad);
    }

    private function edit(Request $request, HouseAd $ad)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new HouseAdType(), $ad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($ad->getImagefile() != null) {
                $old = $ad->getImage();
                $media = new Media();
                $media->setFile($ad->getImagefile());
                $media->upload($this->container->getParameter('files_directory'));
                $em->persist($media);
                $em->flush();
                $ad->setImage($media);
                if ($old != null) {
                    $old->delete($this->container->getParameter('files_directory'));
                    $em->remove($old);
                }
            }
            if ($ad->getWeight() === null || $ad->getWeight() < 1) {
                $ad->setWeight(1);
            }
            $em->persist($ad);
            $em->flush();
            $this->addFlash('success', 'Operation has been done successfully');

            return $this->redirect($this->generateUrl('app_housead_index'));
        }

        return $this->render('AppBundle:HouseAd:edit.html.twig', array(
            'ad' => $ad,
            'form' => $form->createView(),
            'sizes' => array(
                HouseAd::FORMAT_BANNER => HouseAd::sizeFor(HouseAd::FORMAT_BANNER),
                HouseAd::FORMAT_MREC => HouseAd::sizeFor(HouseAd::FORMAT_MREC),
                HouseAd::FORMAT_NATIVE => HouseAd::sizeFor(HouseAd::FORMAT_NATIVE),
                HouseAd::FORMAT_INTERSTITIAL => HouseAd::sizeFor(HouseAd::FORMAT_INTERSTITIAL),
                HouseAd::FORMAT_REWARDED => HouseAd::sizeFor(HouseAd::FORMAT_REWARDED),
            ),
        ));
    }

    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $ad = $em->getRepository('AppBundle:HouseAd')->find($id);
        if ($ad === null) {
            throw new NotFoundHttpException('Page not found');
        }

        // The day rows go with it - the table cascades on delete - so say so
        // rather than letting the totals quietly change.
        $image = $ad->getImage();
        $em->remove($ad);
        $em->flush();
        if ($image != null) {
            $image->delete($this->container->getParameter('files_directory'));
            $em->remove($image);
            $em->flush();
        }
        $this->addFlash('success', 'Operation has been done successfully');

        return $this->redirect($this->generateUrl('app_housead_index'));
    }

    /** On or off without opening the ad. */
    public function toggleAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $ad = $em->getRepository('AppBundle:HouseAd')->find($id);
        if ($ad === null) {
            throw new NotFoundHttpException('Page not found');
        }
        $ad->setEnabled(!$ad->getEnabled());
        $em->flush();

        return $this->redirect($this->generateUrl('app_housead_index'));
    }

    // ================================================================== app

    /**
     * The creatives, for the app to keep.
     *
     * <p>Everything the app needs to draw them is in here, so a phone that has
     * this list can fill a slot with no network reachable at all - which is the
     * whole point of the thing being last in the waterfall.
     */
    public function api_listAction(Request $request, $token)
    {
        if ($token != $this->container->getParameter('token_app')) {
            throw new NotFoundHttpException('Page not found');
        }

        $host = $request->getSchemeAndHttpHost();
        $out = array();
        foreach ($this->getDoctrine()->getManager()
                ->getRepository('AppBundle:HouseAd')->servable() as $ad) {
            $image = $ad->getImage();
            $out[] = array(
                'id' => $ad->getId(),
                // Normalised on the way out as well: a row written before the
                // form was fixed still holds a label, and the app matches keys.
                'format' => HouseAd::normaliseFormat($ad->getFormat()),
                'title' => (string) $ad->getTitle(),
                'body' => (string) $ad->getBody(),
                'cta' => $ad->buttonText(),
                'image' => $image === null ? '' : $image->getAbsoluteLink($host),
                'url' => $ad->getUrl(),
                'weight' => max(1, (int) $ad->getWeight()),
            );
        }

        return new JsonResponse(array('cache' => self::CACHE_SECONDS, 'ads' => $out));
    }

    /** "It was shown." */
    public function api_impressionAction(Request $request, $token, $id)
    {
        return $this->count($token, $id, 1, 0);
    }

    /** "It was tapped." */
    public function api_clickAction(Request $request, $token, $id)
    {
        return $this->count($token, $id, 0, 1);
    }

    /**
     * Adds to an ad's totals and to its row for today.
     *
     * <p>Both are bumped in SQL rather than read-then-written: a popular ad is
     * reported by many phones at once, and anything that reads a number into PHP
     * first will lose some of them.
     */
    private function count($token, $id, $impressions, $clicks)
    {
        if ($token != $this->container->getParameter('token_app')) {
            throw new NotFoundHttpException('Page not found');
        }

        $em = $this->getDoctrine()->getManager();
        $ad = $em->getRepository('AppBundle:HouseAd')->find($id);
        if ($ad === null) {
            // An ad deleted since the phone cached it. Nothing to count, and
            // nothing worth an error either.
            return new JsonResponse(array('code' => 200, 'message' => 'gone'));
        }

        $em->getConnection()->executeUpdate(
            'UPDATE house_ad_table SET impressions = impressions + :i, clicks = clicks + :c'
            . ' WHERE id = :id',
            array('i' => (int) $impressions, 'c' => (int) $clicks, 'id' => (int) $id));

        $em->getRepository('AppBundle:HouseAdStat')
            ->record($id, HouseAd::normaliseFormat($ad->getFormat()), $impressions, $clicks);

        return new JsonResponse(array('code' => 200, 'message' => 'counted'));
    }
}

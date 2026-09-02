<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Reel;
use MediaBundle\Entity\Media;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * The public website: the packs and the reels, as pages anybody can open.
 *
 * <p>Everything here already existed as data the app reads over an API. What it
 * had no way of being was a page - so nothing could be shared into a chat with a
 * preview, nothing could be found in a search engine, and somebody sent a link
 * had to install the app before they could see what they had been sent.
 *
 * <p>Read only, and deliberately so: no form here writes anything, and every
 * action ends in an install link rather than a download. The pack files stay
 * behind the app, which is what the app is for.
 */
class SiteController extends Controller
{
    /** Packs on a page of the list. */
    const PER_PAGE = 24;

    /**
     * The site's front page.
     *
     * <p>Shares the root with the panel: an admin who is signed in gets the
     * dashboard they have always had, everybody else - and every crawler - gets
     * the site. One condition, and every dashboard query lives on the other side
     * of it.
     */
    public function homeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $setting = $this->siteSetting($em);

        return $this->render('AppBundle:Site:home.html.twig', array(
            'setting' => $setting,
            'packs' => $em->createQuery(
                'SELECT p FROM AppBundle:Pack p WHERE p.review = false AND p.enabled = true'
                . ' ORDER BY p.downloads DESC')->setMaxResults(12)->getResult(),
            'fresh' => $em->createQuery(
                'SELECT p FROM AppBundle:Pack p WHERE p.review = false AND p.enabled = true'
                . ' ORDER BY p.created DESC')->setMaxResults(6)->getResult(),
            'reels' => $this->visibleReels($em, 8),
            'categories' => $em->getRepository('AppBundle:Category')
                ->findBy(array(), array('position' => 'ASC')),
            'spaces' => $this->get('app.spaces'),
        ));
    }

    /** Every pack, newest first, or one category of them. */
    public function packsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $setting = $this->siteSetting($em);

        $category = null;
        if ($request->query->get('category')) {
            $category = $em->getRepository('AppBundle:Category')
                ->find((int) $request->query->get('category'));
        }

        $dql = 'SELECT p FROM AppBundle:Pack p'
            . ($category === null ? '' : ' JOIN p.categories c')
            . ' WHERE p.review = false AND p.enabled = true'
            . ($category === null ? '' : ' AND c.id = :category')
            . ' ORDER BY p.created DESC';
        $query = $em->createQuery($dql);
        if ($category !== null) {
            $query->setParameter('category', $category->getId());
        }

        return $this->render('AppBundle:Site:packs.html.twig', array(
            'setting' => $setting,
            'category' => $category,
            'categories' => $em->getRepository('AppBundle:Category')
                ->findBy(array(), array('position' => 'ASC')),
            'pagination' => $this->get('knp_paginator')->paginate(
                $query, $request->query->getInt('page', 1), self::PER_PAGE),
        ));
    }

    /**
     * One pack: its stickers, who made it, and the way to get it.
     *
     * <p>The stickers are shown, not offered. Adding a pack to WhatsApp is
     * something only the app can do, so the page ends at the store.
     */
    public function packAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $setting = $this->siteSetting($em);

        $pack = $em->getRepository('AppBundle:Pack')->find($id);
        if ($pack === null || $pack->getReview() || !$pack->getEnabled()) {
            throw new NotFoundHttpException('Page not found');
        }

        return $this->render('AppBundle:Site:pack.html.twig', array(
            'setting' => $setting,
            'pack' => $pack,
            'more' => $em->createQuery(
                'SELECT p FROM AppBundle:Pack p WHERE p.review = false AND p.enabled = true'
                . ' AND p.id <> :id ORDER BY p.downloads DESC')
                ->setParameter('id', $pack->getId())->setMaxResults(6)->getResult(),
        ));
    }

    /** Every reel that is live, newest first. */
    public function reelsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $setting = $this->siteSetting($em);

        $query = $em->createQuery(
            'SELECT r FROM AppBundle:Reel r WHERE r.review = false AND r.enabled = true'
            . ' ORDER BY r.created DESC');

        return $this->render('AppBundle:Site:reels.html.twig', array(
            'setting' => $setting,
            'pagination' => $this->get('knp_paginator')->paginate(
                $query, $request->query->getInt('page', 1), 24),
            'spaces' => $this->get('app.spaces'),
        ));
    }

    /**
     * A sitemap of everything a search engine should know about.
     *
     * <p>Built on the fly rather than written to disk: packs and reels come and
     * go, and a file on disk would be a second thing to keep true.
     */
    public function sitemapAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $setting = $em->getRepository('AppBundle:Settings')->findOneBy(array());

        $urls = array();
        $host = $request->getSchemeAndHttpHost();

        if ($setting === null || $setting->isSiteEnabled()) {
            $urls[] = array('loc' => $host . $this->generateUrl('app_site_home'),
                'priority' => '1.0', 'freq' => 'daily');
            $urls[] = array('loc' => $host . $this->generateUrl('app_site_packs'),
                'priority' => '0.9', 'freq' => 'daily');
            $urls[] = array('loc' => $host . $this->generateUrl('app_site_reels'),
                'priority' => '0.8', 'freq' => 'daily');

            foreach ($em->createQuery(
                'SELECT p.id, p.created FROM AppBundle:Pack p'
                . ' WHERE p.review = false AND p.enabled = true ORDER BY p.created DESC')
                ->setMaxResults(5000)->getResult() as $row) {
                $urls[] = array(
                    'loc' => $host . $this->generateUrl('app_site_pack', array('id' => $row['id'])),
                    'lastmod' => $row['created']->format('Y-m-d'),
                    'priority' => '0.7', 'freq' => 'weekly');
            }

            foreach ($em->createQuery(
                'SELECT r.id, r.created FROM AppBundle:Reel r'
                . ' WHERE r.review = false AND r.enabled = true ORDER BY r.created DESC')
                ->setMaxResults(5000)->getResult() as $row) {
                $urls[] = array(
                    'loc' => $host . $this->generateUrl('app_site_reel', array('id' => $row['id'])),
                    'lastmod' => $row['created']->format('Y-m-d'),
                    'priority' => '0.6', 'freq' => 'weekly');
            }
        }

        $response = $this->render('AppBundle:Site:sitemap.xml.twig', array('urls' => $urls));
        $response->headers->set('Content-Type', 'application/xml; charset=UTF-8');

        return $response;
    }

    /** robots.txt, pointing at the sitemap and keeping crawlers out of the panel. */
    public function robotsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $setting = $em->getRepository('AppBundle:Settings')->findOneBy(array());
        $open = $setting === null || $setting->isSiteEnabled();

        $lines = array('User-agent: *');
        if ($open) {
            // The panel is not for crawling, and neither are the endpoints the app
            // talks to. Everything else is fair game.
            foreach (array('/admin', '/settings.html', '/ads.html', '/api/', '/users/',
                '/pack/', '/reel/', '/support/', '/subscriptions/', '/slide/', '/category/',
                '/version/', '/tags.html', '/login', '/resetting') as $path) {
                $lines[] = 'Disallow: ' . $path;
            }
            $lines[] = 'Sitemap: ' . $request->getSchemeAndHttpHost()
                . $this->generateUrl('app_site_sitemap');
        } else {
            $lines[] = 'Disallow: /';
        }

        $response = new Response(implode("\n", $lines) . "\n");
        $response->headers->set('Content-Type', 'text/plain; charset=UTF-8');

        return $response;
    }

    /** Old share links keep working, and point at the page that replaced them. */
    public function sharePackAction($id)
    {
        return $this->redirect($this->generateUrl('app_site_pack', array('id' => $id)), 301);
    }

    // =============================================================== policies

    /**
     * The privacy policy, the delete account policy and the terms.
     *
     * <p>Deliberately not behind the site switch, and deliberately not behind the
     * panel login: Play checks the privacy address from the store listing, and an
     * app that lets people make an account has to say publicly how they close it.
     * A policy page that answers 404 because the website was switched off would
     * take the store listing down with it.
     */
    public function privacyAction(Request $request)
    {
        return $this->policy('privacy');
    }

    public function termsAction(Request $request)
    {
        return $this->policy('terms');
    }

    public function deleteAccountAction(Request $request)
    {
        return $this->policy('delete');
    }

    /** One page, three documents. */
    private function policy($which)
    {
        $em = $this->getDoctrine()->getManager();
        $setting = $em->getRepository('AppBundle:Settings')->findOneBy(array());
        if ($setting === null) {
            throw new NotFoundHttpException('Page not found');
        }

        $documents = array(
            'privacy' => array(
                'title' => 'Privacy policy',
                'body' => $setting->getPrivacypolicy(),
                'summary' => 'What is collected, what it is used for, and what is not.',
            ),
            'terms' => array(
                'title' => 'Terms and conditions',
                'body' => $setting->getTerms(),
                'summary' => 'The terms you agree to by using the app.',
            ),
            'delete' => array(
                'title' => 'Deleting your account',
                'body' => $setting->getDeleteaccount(),
                'summary' => 'How to close your account, and what happens to what you posted.',
            ),
        );

        return $this->render('AppBundle:Site:policy.html.twig', array(
            'setting' => $setting,
            'which' => $which,
            'document' => $documents[$which],
            'documents' => $documents,
        ));
    }

    // ================================================================ helpers

    /**
     * The settings row, or a 404 when the site has been switched off.
     *
     * <p>Off means off: a page that answered with an empty layout would still be
     * indexed, and would still be a page somebody could land on.
     */
    private function siteSetting($em)
    {
        $setting = $em->getRepository('AppBundle:Settings')->findOneBy(array());
        if ($setting !== null && !$setting->isSiteEnabled()) {
            throw new NotFoundHttpException('Page not found');
        }

        return $setting;
    }

    private function visibleReels($em, $limit)
    {
        return $em->createQuery(
            'SELECT r FROM AppBundle:Reel r WHERE r.review = false AND r.enabled = true'
            . ' ORDER BY r.created DESC')->setMaxResults($limit)->getResult();
    }
}

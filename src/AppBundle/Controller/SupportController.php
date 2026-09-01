<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use AppBundle\Entity\Support;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SupportController extends Controller
{
    public function api_addAction(Request $request,$token)
    {
        if ($token!=$this->container->getParameter('token_app')) {
            throw new NotFoundHttpException("Page not found");  
        }
        $email = $request->get("email");
        $subject = $request->get("name");
        $message = $request->get("message");

        $em         = $this->getDoctrine()->getManager();
        $support    = new Support();
        $support->setEmail($email);
        $support->setSubject($subject);
        $support->setMessage($message);

        // What the message is about. The app says so outright; app versions already
        // on people's phones do not, so the text is read instead - either way the
        // row is filed, and the panel never has to guess.
        $kind = $request->get("kind");
        $target = (int) $request->get("target");
        if (!in_array($kind, Support::kinds(), true)) {
            $guess = Support::classify($message);
            $kind = $guess[0];
            if (!$target) {
                $target = $guess[1];
            }
        }
        $support->setKind($kind);
        $support->setTargetid($kind === Support::KIND_CONTACT ? null : ($target ?: null));

        $em->persist($support);
        $em->flush();
        $code="200";
        $message="Votre message a bien été envoyé";
        $error=array(
            "code"=>$code,
            "message"=>$message,
            "values"=>array()
        );  
        header('Content-Type: application/json'); 
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent=$serializer->serialize($error, 'json');
        return new Response($jsonContent);
    }

    /**
     * The messages list: everything people send from the app, in one place but no
     * longer in one heap.
     *
     * <p>Reports and plain messages used to be indistinguishable - every row showed
     * a name and a date, and the only way to tell a reported pack from somebody
     * saying hello was to open it. Each row now carries what it is and what it is
     * about, and the headings above the table narrow the list to one kind.
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $this->fileOldMessages($em);

        $kind = $request->query->get('kind');
        if (!in_array($kind, Support::kinds(), true)) {
            $kind = null;
        }

        $dql = 'SELECT s FROM AppBundle:Support s'
            . ($kind === null ? '' : ' WHERE s.kind = :kind')
            . ' ORDER BY s.created DESC';
        $query = $em->createQuery($dql);
        if ($kind !== null) {
            $query->setParameter('kind', $kind);
        }

        $pagination = $this->get('knp_paginator')->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('AppBundle:Support:index.html.twig', array(
            'pagination' => $pagination,
            'kind' => $kind,
            'counts' => $this->countsByKind($em),
            'labels' => Support::labels(),
            'targets' => $this->resolveTargets($em, $pagination),
            'spaces' => $this->get('app.spaces'),
        ));
    }

    /**
     * Gives a heading to messages that arrived before there were any.
     *
     * <p>Reading the kind out of the text on every page load would work, but then the
     * headings could not be counted or filtered in SQL. This writes the answer back
     * once; after the first visit there is nothing left to do and the query costs
     * nothing.
     */
    private function fileOldMessages($em)
    {
        $unfiled = $em->createQuery(
            'SELECT s FROM AppBundle:Support s WHERE s.kind IS NULL')->getResult();
        if (empty($unfiled)) {
            return;
        }
        foreach ($unfiled as $support) {
            $guess = Support::classify($support->getMessage());
            $support->setKind($guess[0]);
            $support->setTargetid($guess[1]);
        }
        $em->flush();
    }

    /** How many messages of each kind, for the headings above the table. */
    private function countsByKind($em)
    {
        $counts = array('all' => 0);
        foreach (Support::kinds() as $kind) {
            $counts[$kind] = 0;
        }
        $rows = $em->createQuery(
            'SELECT s.kind AS kind, COUNT(s.id) AS total FROM AppBundle:Support s GROUP BY s.kind')
            ->getResult();
        foreach ($rows as $row) {
            $kind = in_array($row['kind'], Support::kinds(), true)
                ? $row['kind'] : Support::KIND_CONTACT;
            $counts[$kind] += (int) $row['total'];
            $counts['all'] += (int) $row['total'];
        }
        return $counts;
    }

    /**
     * The packs, users and reels the messages on this page are about.
     *
     * <p>Looked up in one query each rather than one per row, and keyed by kind and
     * id so the template can say what was reported - or that it is already gone.
     */
    private function resolveTargets($em, $messages)
    {
        $ids = array();
        foreach (Support::kinds() as $kind) {
            $ids[$kind] = array();
        }
        foreach ($messages as $support) {
            $id = $support->getTargetid();
            if ($id && isset($ids[$support->getKind()])) {
                $ids[$support->getKind()][$id] = $id;
            }
        }

        $repositories = array(
            Support::KIND_PACK => 'AppBundle:Pack',
            Support::KIND_USER => 'UserBundle:User',
            Support::KIND_REEL => 'AppBundle:Reel',
        );

        $targets = array();
        foreach ($repositories as $kind => $repository) {
            $targets[$kind] = array();
            if (empty($ids[$kind])) {
                continue;
            }
            foreach ($em->getRepository($repository)->findBy(array('id' => array_values($ids[$kind]))) as $entity) {
                $targets[$kind][$entity->getId()] = $entity;
            }
        }
        return $targets;
    }

    public function viewAction(Request $request,$id)
    {
        $em         = $this->getDoctrine()->getManager();
        $support    = $em->getRepository("AppBundle:Support")->find($id);
        if ($support==null) {
            throw new NotFoundHttpException("Page not found");
        }
        return $this->render('AppBundle:Support:view.html.twig', array(
            "support" => $support,
            "targets" => $this->resolveTargets($em, array($support)),
            "spaces" => $this->get('app.spaces'),
        ));
    }

    public function deleteAction(Request $request,$id)
    {
        $em         = $this->getDoctrine()->getManager();
        $support    = $em->getRepository('AppBundle:Support')->find($id);
        if ($support==null) {
            throw new NotFoundHttpException("Page not found");
        }
        $form=$this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->add('Yes', 'submit')
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em->remove($support);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success','Operation has been done successfully');
            return $this->redirect($this->generateUrl('app_support_index'));
        }
        return $this->render("AppBundle:Support:delete.html.twig",array("form"=>$form->createView()));
    }
}

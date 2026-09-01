<?php

namespace AppBundle\Controller;

require_once __DIR__ . '/../../../app/config/firebase_auth.php';

use AppBundle\Entity\Device;
use AppBundle\Form\SettingsType;
use AppBundle\Form\AdsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class HomeController extends Controller {
	public function api_deviceAction($tkn, $token) {
		if ($token != $this->container->getParameter('token_app')) {
			throw new NotFoundHttpException("Page not found");
		}
		$code = "200";
		$message = "";
		$errors = array();
		$em = $this->getDoctrine()->getManager();
		$d = $em->getRepository('AppBundle:Device')->findOneBy(array("token" => $tkn));
		if ($d == null) {
			$device = new Device();
			$device->setToken($tkn);
			$em->persist($device);
			$em->flush();
			$message = "Deivce added";
		} else {
			// The app calls this every time the home screen opens, so it is already
			// an "app opened" ping - now it is written down, which is what lets the
			// panel say how many people were active today without asking phones for
			// anything new.
			$d->open();
			$em->flush();
			$message = "Deivce Exist";
		}

		$error = array(
			"code" => $code,
			"message" => $message,
			"values" => $errors,
		);
		$encoders = array(new XmlEncoder(), new JsonEncoder());
		$normalizers = array(new ObjectNormalizer());
		$serializer = new Serializer($normalizers, $encoders);
		$jsonContent = $serializer->serialize($error, 'json');
		return new Response($jsonContent);
	}

	public function deletetagAction(Request $request, $id) {
		$em = $this->getDoctrine()->getManager();
		$support = $em->getRepository('AppBundle:Tag')->find($id);
		if ($support == null) {
			throw new NotFoundHttpException("Page not found");
		}
		$form = $this->createFormBuilder(array('id' => $id))
			->add('id', 'hidden')
			->add('Yes', 'submit')
			->getForm();
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$em->remove($support);
			$em->flush();
			$request->getSession()->getFlashBag()->add('success', 'Operation has been done successfully');
			return $this->redirect($this->generateUrl('app_home_tags'));
		}
		return $this->render("AppBundle:Home:delete_tag.html.twig", array("form" => $form->createView()));
	}
	    public function adsAction(Request $request) {
	        $em = $this->getDoctrine()->getManager();
	        $setting = $em->getRepository("AppBundle:Settings")->findOneBy(array(), array());
	        $form = $this->createForm(new AdsType(), $setting);
	        $form->handleRequest($request);
	        if ($form->isSubmitted() && $form->isValid()) {
	            $em->persist($setting);
	            $em->flush();
	            $this->addFlash('success', 'Operation has been done successfully');
	        }
	        return $this->render("AppBundle:Home:ads.html.twig", array("setting" => $setting, "form" => $form->createView()));
	    } 
	public function indexAction() {
		$em = $this->getDoctrine()->getManager();
		$supports = $em->getRepository("AppBundle:Support")->count();
		$devices = $em->getRepository("AppBundle:Device")->count();
		$slides = $em->getRepository("AppBundle:Slide")->count();
		$packs = $em->getRepository("AppBundle:Pack")->count();
		$downloads = $em->getRepository("AppBundle:Pack")->downloads();
		$reviews = $em->getRepository("AppBundle:Pack")->countReviews();
		$categories = $em->getRepository("AppBundle:Category")->count();
		$stickers = $em->getRepository("AppBundle:Sticker")->count();
		$versions = $em->getRepository("AppBundle:Version")->count();
		$tags = $em->getRepository("AppBundle:Tag")->count();
		$searchs = $em->getRepository("AppBundle:Tag")->Searchs();
		$users = $em->getRepository("UserBundle:User")->count();

		// Reels have their own numbers, and none of them were on this page before:
		// how many are live, how many are still waiting for a moderator, what they
		// have been watched and liked, which ones people actually watch, and how
		// many arrive on a given day.
		$reelRepository = $em->getRepository("AppBundle:Reel");
		$reels = $reelRepository->countVisible();
		$reelsPending = $reelRepository->countPending();
		$reelTotals = $reelRepository->totals();
		$topReels = $reelRepository->findMostWatched(5);
		$reelsPerDay = $reelRepository->postedPerDay(14);
		// The tallest bar, worked out here: a value set inside a Twig loop does not
		// survive the loop, so the template cannot find its own maximum.
		$reelsPeak = $reelsPerDay ? max(max($reelsPerDay), 1) : 1;

		// Who is paying, as the app last heard it from Play.
		$subscriptions = $em->getRepository("AppBundle:Subscription")->countLive();

		// How busy today was. The app registers for notifications every time the
		// home screen opens, so this is a real count of people who opened the app -
		// devices, not sessions, and only those seen since this began being recorded.
		$deviceRepository = $em->getRepository("AppBundle:Device");
		$activity = $deviceRepository->activity();
		$activePerDay = $deviceRepository->activePerDay(14);
		$activePeak = $activePerDay ? max(max($activePerDay), 1) : 1;

		return $this->render('AppBundle:Home:index.html.twig', array(
			"activity" => $activity,
			"activePerDay" => $activePerDay,
			"activePeak" => $activePeak,
			"subscriptions" => $subscriptions,
			"reels" => $reels,
			"reelsPending" => $reelsPending,
			"reelViews" => $reelTotals['views'],
			"reelLikes" => $reelTotals['likes'],
			"topReels" => $topReels,
			"reelsPerDay" => $reelsPerDay,
			"reelsPeak" => $reelsPeak,
			"spaces" => $this->get('app.spaces'),
			"searchs" => $searchs,
			"tags" => $tags,
			"downloads" => $downloads,
			"devices" => $devices,
			"packs" => $packs,
			"slides" => $slides,
			"categories" => $categories,
			"stickers" => $stickers,
			"reviews" => $reviews,
			"users" => $users,
			"versions" => $versions,
			"supports" => $supports,
		));
	}

	public function notifCategoryAction(Request $request) {
		memory_get_peak_usage();
		$imagineCacheManager = $this->get('liip_imagine.cache.manager');

		$em = $this->getDoctrine()->getManager();
		$categories = $em->getRepository("AppBundle:Category")->findAll();
    $default_title = "";
    $default_message = "";
    $default_icon = "";
    $default_image = "";
    $category = null;
    $id = $request->query->get("id");
    if($request->query->has("id")){
        $category = $em->getRepository('AppBundle:Category')->find($id);
        $imagineCacheManager = $this->get('liip_imagine.cache.manager');
        $default_title = $category->getTitle();
        $default_message =  $category->getTitle();
        $default_icon = $imagineCacheManager->getBrowserPath($category->getMedia()->getLink(), 'category_thumb_api');
        $default_image =$imagineCacheManager->getBrowserPath($category->getMedia()->getLink(), 'category_thumb_api');
        $default_id = ""; 
    }

		$defaultData = array(
                        "title"=>$default_title,
                        "message"=>$default_message,
                        "icon"=>$default_icon,
                        "category"=>$category,
                      );
		$form = $this->createFormBuilder($defaultData)
			->setMethod('POST')
			->add('title', TextType::class)
			->add('message', TextareaType::class)
			->add('category', 'entity', array('class' => 'AppBundle:Category'))
			->add('icon', UrlType::class, array("label" => "Large Icon", "required" => false))
			->add('image', UrlType::class, array("label" => "Big Picture", "required" => false))
			->add('send', SubmitType::class, array("label" => "Send notification"))
			->getForm();

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			// data is an array with "name", "email", and "message" keys
			$data = $form->getData();

			$category_selected = $em->getRepository("AppBundle:Category")->find($data["category"]);

			$message = array(
				"type" => "category",
				"id" => $category_selected->getId(),
				"title_category" => $category_selected->getTitle(),
				"pack_category" => $imagineCacheManager->getBrowserPath($category_selected->getMedia()->getLink(), 'category_thumb_api'),
				"title" => $data["title"],
				"message" => $data["message"],
				"image" => $data["image"],
				"icon" => $data["icon"],
			);

			$setting = $em->getRepository("AppBundle:Settings")->findOneBy(array(), array());
			$key = $setting->getFirebasekey();
			$message_pack = $this->send_notification(null, $message, $key);

			$this->addFlash('success', 'Operation has been done successfully ');

		}
		return $this->render('AppBundle:Home:notif_category.html.twig', array(
			"form" => $form->createView(),
		));
	}

	public function notifPackAction(Request $request) {
		$imagineCacheManager = $this->get('liip_imagine.cache.manager');
		$em = $this->getDoctrine()->getManager();

    $default_title = "";
    $default_message = "";
    $default_icon = "";
    $default_image = "";
    $pack = null;
    $id = $request->query->get("id");
    if($request->query->has("id")){
        $pack = $em->getRepository('AppBundle:Pack')->find($id);
        if ($pack) {
          $imagineCacheManager = $this->get('liip_imagine.cache.manager');
          $default_title = $pack->getName();
          $default_message =  $pack->getName();
          $default_icon = $imagineCacheManager->getBrowserPath($pack->getImage()->getLink(), 'tray_image');
          $default_image =$imagineCacheManager->getBrowserPath($pack->getImage()->getLink(), 'tray_image');
        }
    }

    $defaultData = array(
                        "title"=>$default_title,
                        "message"=>$default_message,
                        "icon"=>$default_icon,
                        "object"=>$pack,
                      );
		$form = $this->createFormBuilder($defaultData)
			->setMethod('POST')
			->add('title', TextType::class)
			->add('message', TextareaType::class)
			->add('object', 'entity', array('class' => 'AppBundle:Pack'))
			->add('icon', UrlType::class, array("label" => "Large Icon","required"=>false))
			->add('image', UrlType::class, array("label" => "Big Picture","required"=>false))
			->add('send', SubmitType::class, array("label" => "Send notification"))
			->getForm();
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$data = $form->getData();
			$pack_selected = $em->getRepository("AppBundle:Pack")->find($data["object"]);

			$message = array(
				"type" => "pack",
				"id" => $pack_selected->getId(),
				"title" => $data["title"],
				"message" => $data["message"],
				"image" => $data["image"],
				"icon" => $data["icon"],
			);
			$setting = $em->getRepository("AppBundle:Settings")->findOneBy(array(), array());
			$key = $setting->getFirebasekey();
			$message_image = $this->send_notification(null, $message, $key);
			$this->addFlash('success', 'Operation has been done successfully ');
		}
		return $this->render('AppBundle:Home:notif_pack.html.twig', array(
			"form" => $form->createView(),
		));
	}

	public function notifUrlAction(Request $request) {

		memory_get_peak_usage();
		$imagineCacheManager = $this->get('liip_imagine.cache.manager');

		$em = $this->getDoctrine()->getManager();

		$defaultData = array();
		$form = $this->createFormBuilder($defaultData)
			->setMethod('GET')
			->add('title', TextType::class)
			->add('message', TextareaType::class)
			->add('url', UrlType::class, array("label" => "Url"))
			->add('icon', UrlType::class, array("label" => "Large Icon","required"=>false))
			->add('image', UrlType::class, array("label" => "Big Picture","required"=>false))
			->add('send', SubmitType::class, array("label" => "Send notification"))
			->getForm();

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$data = $form->getData();
			$message = array(
				"type" => "link",
				"id" => strlen($data["url"]),
				"link" => $data["url"],
				"title" => $data["title"],
				"message" => $data["message"],
				"image" => $data["image"],
				"icon" => $data["icon"],
			);
			$setting = $em->getRepository("AppBundle:Settings")->findOneBy(array(), array());
			$key = $setting->getFirebasekey();
			$message_image = $this->send_notification(null, $message, $key);

			$this->addFlash('success', 'Operation has been done successfully ');

		}
		return $this->render('AppBundle:Home:notif_url.html.twig', array(
			"form" => $form->createView(),
		));
	}

	public function notifUserpackAction(Request $request) {
		memory_get_peak_usage();
		$imagineCacheManager = $this->get('liip_imagine.cache.manager');
		$pack_id = $request->query->get("pack_id");
		$em = $this->getDoctrine()->getManager();

		$defaultData = array();
		$form = $this->createFormBuilder($defaultData)
			->setMethod('GET')
			->add('title', TextType::class)
			->add('object', HiddenType::class, array("attr" => array("value" => $pack_id)))
			->add('message', TextareaType::class)
			->add('icon', UrlType::class, array("label" => "Large Icon"))
			->add('image', UrlType::class, array('required' => false, "label" => "Big Picture"))
			->add('send', SubmitType::class, array("label" => "Send notification"))
			->getForm();
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			// data is an array with "name", "email", and "message" keys
			$data = $form->getData();
			$data = $form->getData();
			$pack_selected = $em->getRepository("AppBundle:Pack")->find($data["object"]);
			$user = $pack_selected->getUser();

			$devices = $em->getRepository('AppBundle:Device')->findAll();
			if ($user == null) {
				throw new NotFoundHttpException("Page not found");
			}
			$tokens = array();

			$tokens[] = $user->getToken();

			$message = array(
				"type" => "pack",
				"id" => $pack_selected->getId(),
				"title" => $data["title"],
				"message" => $data["message"],
				"image" => $data["image"],
				"icon" => $data["icon"],
			);

			$setting = $em->getRepository("AppBundle:Settings")->findOneBy(array(), array());
			$key = $setting->getFirebasekey();
			$message_image = $this->send_notificationToken($tokens, $message, $key);
			$this->addFlash('success', 'Operation has been done successfully ');
			return $this->redirect($this->generateUrl('app_pack_index'));
		} else {
			$pack = $em->getRepository("AppBundle:Pack")->find($pack_id);
		}
		return $this->render('AppBundle:Home:notif_user_pack.html.twig', array(
			"form" => $form->createView(),
			'pack' => $pack,
		));
	}

	public function privacypolicyAction() {
		$em = $this->getDoctrine()->getManager();
		$setting = $em->getRepository("AppBundle:Settings")->findOneBy(array(), array());
		return $this->render("AppBundle:Home:privacypolicy.html.twig", array("setting" => $setting));
	}

   function send_notification($tokens, $message, $key = null) {

        $accessToken = getFirebaseAccessToken();
        $projectId = getFirebaseProjectId();

        $url = "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send";

        $payload = [
            "message" => [
                "topic" => "StickersAppTopic",
                "data"  => $message,
                "android" => [
                    "priority" => "HIGH"
                ]
            ]
        ];

        $headers = [
            "Authorization: Bearer {$accessToken}",
            "Content-Type: application/json; UTF-8"
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

   function send_notificationToken($tokens, $message, $key = null) {

        $accessToken = getFirebaseAccessToken();
        $projectId = getFirebaseProjectId();

        $url = "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send";

        $headers = [
            "Authorization: Bearer {$accessToken}",
            "Content-Type: application/json; UTF-8"
        ];

        foreach ($tokens as $token) {

            $payload = [
                "message" => [
                    "token" => $token,
                    "data"  => $message,
                    "android" => [
                        "priority" => "HIGH"
                    ]
                ]
            ];

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

            curl_exec($ch);
            curl_close($ch);
        }

        return true;
    }

	public function settingsAction(Request $request) {
		$em = $this->getDoctrine()->getManager();
		$setting = $em->getRepository("AppBundle:Settings")->findOneBy(array(), array());
		$form = $this->createForm(new SettingsType(), $setting);
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			if ($setting->getFile() != null) {
				$media = $setting->getMedia();

				$media->setFile($setting->getFile());
				$media->delete($this->container->getParameter('files_directory'));
				$media->upload($this->container->getParameter('files_directory'));
				$em->persist($media);
				$em->flush();
			}
			$em->persist($setting);
			$em->flush();
			$this->addFlash('success', 'Operation has been done successfully');
		}
		return $this->render("AppBundle:Home:settings.html.twig", array("setting" => $setting, "form" => $form->createView()));
	}

	public function tagsAction(Request $request) {
		$em = $this->getDoctrine()->getManager();
		$q = "  ";
		if ($request->query->has("q") and $request->query->get("q") != "") {
			$q .= " AND  w.title like '%" . $request->query->get("q") . "%'";
		}
		$dql = "SELECT t FROM AppBundle:Tag t ORDER BY t.search desc ";
		$query = $em->createQuery($dql);
		$paginator = $this->get('knp_paginator');
		$tags = $paginator->paginate(
			$query,
			$request->query->getInt('page', 1),
			12
		);
		$tags_list = $em->getRepository('AppBundle:Tag')->findAll();
		$tags_count = sizeof($tags_list);
		return $this->render('AppBundle:Home:tags.html.twig', array("tags" => $tags, "tags_count" => $tags_count));
	}
}
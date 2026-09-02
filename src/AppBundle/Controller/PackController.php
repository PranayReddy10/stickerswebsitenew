<?php
namespace AppBundle\Controller;
require_once __DIR__ . '/../../../app/config/firebase_auth.php';
use AppBundle\Entity\Pack;
use AppBundle\Entity\Rate;
use AppBundle\Entity\Sticker;
use AppBundle\Entity\Tag;
use AppBundle\Form\EditPackType;
use AppBundle\Form\PackType;
use AppBundle\Form\ReviewPackType;
use MediaBundle\Entity\Media;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class PackController extends Controller {
	public function addAction(Request $request) {
		$pack = new Pack();
		$storage = $this->get('app.media_storage');
		$form = $this->createForm(new PackType($storage->spacesAvailable()), $pack);
		$em = $this->getDoctrine()->getManager();
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			// Whichever button was pressed, but never a Space that is not configured.
			$target = $storage->resolveTarget($form->get('storage')->getData());
			if ($pack->getFile() != null) {
				if ($pack->getFiles() != null) {
					// The tray image first: if storage refuses it there is no half made
					// pack to clean up, only a form to send back with the reason on it.
					try {
						$media = $storage->store($pack->getFile(), $target, 'packs/tray');
					} catch (\RuntimeException $e) {
						$form->get('file')->addError(new FormError($e->getMessage()));
						return $this->render("AppBundle:Pack:add.html.twig", array(
							"form" => $form->createView(),
							"spaces_ready" => $storage->spacesAvailable(),
						));
					}
					$em->persist($media);
					$em->flush();
					$pack->setImage($media);
					$pack->setUser($this->getUser());
					$tags_list = explode(",", $pack->getTags());
					foreach ($tags_list as $key => $value) {
						$tag = $em->getRepository("AppBundle:Tag")->findOneBy(array("name" => strtolower($value)));
						if ($tag == null) {
							$tag = new Tag();
							$tag->setName(strtolower($value));
							$em->persist($tag);
							$em->flush();
							$pack->addTagslist($tag);
						} else {
							$pack->addTagslist($tag);
						}
					}
					$em->persist($pack);
					$em->flush();
					$all = 0;
					$valide = 0;
					$pos = 1;
					$refused = array();
					foreach ($pack->getFiles() as $file) {
						if ($valide<30) {
							$all++;
							$type = $file->getMimeType();
							if ($type == "image/png" || $type == "image/webp") {

								$sticker = new Sticker();
								$sticker->setFile($file);

								// One sticker the Space will not take must not lose the rest of
								// the pack: it is skipped and named in the message at the end.
								try {
									$media_sticker = $storage->store($sticker->getFile(), $target, 'packs/stickers');
								} catch (\RuntimeException $e) {
									$refused[] = $file->getClientOriginalName() . ' (' . $e->getMessage() . ')';
									continue;
								}
								$em->persist($media_sticker);
								$em->flush();

								$sticker->setEmojis(base64_encode("😀"));
								$sticker->setMedia($media_sticker);
								$sticker->setPack($pack);
								$sticker->setSize($sticker->getFile()->getClientSize());
								$sticker->setPosition($pos);
								$em->persist($sticker);
								$em->flush();
								$valide++;
								$pos++;
							}
						}
					}
					$em->flush();
					sleep(2);
					if (sizeof($refused) > 0) {
						$this->addFlash('error', 'These stickers were not stored: ' . implode(', ', $refused));
					}
					$this->addFlash('success', 'Operation has been done successfully');
					return $this->redirect($this->generateUrl('app_pack_sizer', array("id" => $pack->getId())));
				} else {
					$error = new FormError("This value should not be blank");
					$form->get('files')->addError($error);
				}
			} else {
				$error = new FormError("This value should not be blank");
				$form->get('file')->addError($error);
			}

		}
		return $this->render("AppBundle:Pack:add.html.twig", array(
			"form" => $form->createView(),
			"spaces_ready" => $storage->spacesAvailable(),
		));
	}
	public function api_add_downloadAction(Request $request, $token) {
		if ($token != $this->container->getParameter('token_app')) {
			throw new NotFoundHttpException("Page not found");
		}
		$id = $request->get("id");
		$em = $this->getDoctrine()->getManager();
		$pack = $em->getRepository("AppBundle:Pack")->find($id);
		$pack->setDownloads($pack->getDownloads() + 1);
		$em->flush();
		$encoders = array(new XmlEncoder(), new JsonEncoder());
		$normalizers = array(new ObjectNormalizer());
		$serializer = new Serializer($normalizers, $encoders);
		$jsonContent = $serializer->serialize($pack->getDownloads(), 'json');
		return new Response($jsonContent);
	}
	public function api_add_rateAction($user, $pack, $value, $token) {
		if ($token != $this->container->getParameter('token_app')) {
			throw new NotFoundHttpException("Page not found");
		}
		$em = $this->getDoctrine()->getManager();
		$a = $em->getRepository('AppBundle:Pack')->find($pack);
		$u = $em->getRepository("UserBundle:User")->find($user);
		$code = "200";
		$message = "";
		$errors = array();

		if ($u != null and $a != null) {

			$rate = $em->getRepository('AppBundle:Rate')->findOneBy(array("user" => $u, "pack" => $a));
			if ($rate == null) {
				$rate_obj = new Rate();
				$rate_obj->setValue($value);
				$rate_obj->setReview("");
				$rate_obj->setPack($a);
				$rate_obj->setUser($u);
				$em->persist($rate_obj);
				$em->flush();
				$message = "Your Ratting has been added";
				if ($u->getId() != $a->getUser()->getId()) {
					$stars = "";
					for ($i = 0; $i < $value; $i++) {
						$stars .= "⭐️";
					}
					$tokens[] = $a->getUser()->getToken();

					$messageNotif = array(
						"type" => "pack",
						"id" => $a->getId(),
						"title" => $u->getName() . " Rate " . $a->getName(),
						"message" => $value . " " . $stars . " Stars",

					);
					$setting = $em->getRepository("AppBundle:Settings")->findOneBy(array(), array());
					$key = $setting->getFirebasekey();
					$message_status = $this->send_notificationToken($tokens, $messageNotif, $key);
				}
			} else {
				$rate->setValue($value);
				$em->flush();
				$message = "Your Ratting has been edit";
				if ($u->getId() != $a->getUser()->getId()) {
					$stars = "";
					for ($i = 0; $i < $value; $i++) {
						$stars .= "⭐️";
					}
					$tokens[] = $a->getUser()->getToken();

					$messageNotif = array(
						"type" => "pack",
						"id" => $a->getId(),
						"title" => $u->getName() . "Edit Rate " . $a->getName(),
						"message" => $value . " " . $stars . " Stars",

					);
					$setting = $em->getRepository("AppBundle:Settings")->findOneBy(array(), array());
					$key = $setting->getFirebasekey();
					$message_status = $this->send_notificationToken($tokens, $messageNotif, $key);
				}
			}
		} else {
			$code = "500";
			$message = "Sorry, your rate could not be added at this time";
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

	public function api_add_sadAction(Request $request, $token) {
		if ($token != $this->container->getParameter('token_app')) {
			throw new NotFoundHttpException("Page not found");
		}
		$id = $request->get("id");
		$em = $this->getDoctrine()->getManager();
		$pack = $em->getRepository("AppBundle:Pack")->find($id);
		if ($pack == null) {
			throw new NotFoundHttpException("Page not found");
		}
		$pack->setSad($pack->getSad() + 1);
		$em->flush();
		$encoders = array(new XmlEncoder(), new JsonEncoder());
		$normalizers = array(new ObjectNormalizer());
		$serializer = new Serializer($normalizers, $encoders);
		$jsonContent = $serializer->serialize($pack->getSad(), 'json');
		return new Response($jsonContent);
	}

	public function api_add_woowAction(Request $request, $token) {
		if ($token != $this->container->getParameter('token_app')) {
			throw new NotFoundHttpException("Page not found");
		}
		$id = $request->get("id");
		$em = $this->getDoctrine()->getManager();
		$pack = $em->getRepository("AppBundle:Pack")->find($id);
		if ($pack == null) {
			throw new NotFoundHttpException("Page not found");
		}
		$pack->setWoow($pack->getWoow() + 1);
		$em->flush();
		$encoders = array(new XmlEncoder(), new JsonEncoder());
		$normalizers = array(new ObjectNormalizer());
		$serializer = new Serializer($normalizers, $encoders);
		$jsonContent = $serializer->serialize($pack->getWoow(), 'json');
		return new Response($jsonContent);
	}

	public function api_allAction(Request $request, $page, $order, $token) {
		if ($token != $this->container->getParameter('token_app')) {
			throw new NotFoundHttpException("Page not found");
		}
		$nombre = 6;
		$em = $this->getDoctrine()->getManager();
		$imagineCacheManager = $this->get('liip_imagine.cache.manager');
		$repository = $em->getRepository('AppBundle:Pack');

		$query = $repository->createQueryBuilder('p')
			->where("p.enabled = true")
			->addOrderBy('p.' . $order, 'DESC')
			->addOrderBy('p.id', 'asc')
			->setFirstResult($nombre * $page)
			->setMaxResults($nombre)
			->getQuery();
		$packs = $query->getResult();
		return $this->render('AppBundle:Pack:api_all.html.php', array("packs" => $packs));
	}

	public function api_by_categoryAction(Request $request, $page, $order, $category, $token) {
		if ($token != $this->container->getParameter('token_app')) {
			throw new NotFoundHttpException("Page not found");
		}
		$nombre = 30;
		$em = $this->getDoctrine()->getManager();
		$imagineCacheManager = $this->get('liip_imagine.cache.manager');
		$repository = $em->getRepository('AppBundle:Pack');

		$query = $repository->createQueryBuilder('p')
			->leftJoin('p.categories', 'c')
			->where('c.id = :category', "p.enabled = true")
			->setParameter('category', $category)
			->addOrderBy('p.' . $order, 'DESC')
			->addOrderBy('p.id', 'asc')
			->setFirstResult($nombre * $page)
			->setMaxResults($nombre)
			->getQuery();

		$packs = $query->getResult();
		return $this->render('AppBundle:Pack:api_all.html.php', array("packs" => $packs));
	}

	public function api_by_followAction(Request $request, $page, $user, $token) {
		if ($token != $this->container->getParameter('token_app')) {
			throw new NotFoundHttpException("Page not found");
		}
		$nombre = 30;
		$em = $this->getDoctrine()->getManager();
		$imagineCacheManager = $this->get('liip_imagine.cache.manager');
		$repository = $em->getRepository('AppBundle:Pack');
		$query = $repository->createQueryBuilder('p')
			->leftJoin('p.user', 'u')
			->leftJoin('u.followers', 'f')
			->where('f.id = ' . $user, "p.enabled = true")
			->addOrderBy('p.created', 'DESC')
			->addOrderBy('p.id', 'asc')
			->setFirstResult($nombre * $page)
			->setMaxResults($nombre)
			->getQuery();

		$packs = $query->getResult();
		return $this->render('AppBundle:Pack:api_all.html.php', array("packs" => $packs));
	}

	public function api_by_idAction(Request $request, $id) {
		$em = $this->getDoctrine()->getManager();
		$pack = $em->getRepository("AppBundle:Pack")->find($id);
		if ($pack == null) {
			throw new NotFoundHttpException("Page not found");
		}
		return $this->render("AppBundle:Pack:api_one.html.php", array("pack" => $pack));
	}

	public function api_by_meAction(Request $request, $page, $user, $token) {
		if ($token != $this->container->getParameter('token_app')) {
			throw new NotFoundHttpException("Page not found");
		}
		$nombre = 30;
		$em = $this->getDoctrine()->getManager();
		$imagineCacheManager = $this->get('liip_imagine.cache.manager');
		$repository = $em->getRepository('AppBundle:Pack');
		$query = $repository->createQueryBuilder('p')
			->where('p.user = :user')
			->setParameter('user', $user)
			->addOrderBy('p.created', 'DESC')
			->addOrderBy('p.id', 'asc')
			->setFirstResult($nombre * $page)
			->setMaxResults($nombre)
			->getQuery();
		$packs = $query->getResult();
		return $this->render('AppBundle:Pack:api_all.html.php', array("packs" => $packs));
	}

	public function api_by_queryAction(Request $request, $page, $query, $token) {
		if ($token != $this->container->getParameter('token_app')) {
			throw new NotFoundHttpException("Page not found");
		}
		$nombre = 30;
		$em = $this->getDoctrine()->getManager();
		$imagineCacheManager = $this->get('liip_imagine.cache.manager');
		$repository = $em->getRepository('AppBundle:Pack');

		$tags_list = explode(" ", $query);
		foreach ($tags_list as $key => $value) {
			$tag = $em->getRepository("AppBundle:Tag")->findOneBy(array("name" => $value));
			if ($tag != null) {
				$tag->setSearch($tag->getSearch() + 1);
				$em->flush();
			} else {
				$newtag = new Tag();
				$newtag->setName($value);
				$newtag->setSearch(1);
				$em->persist($newtag);
				$em->flush();
			}
		}

		$query_dql = $repository->createQueryBuilder('p')
			->where("p.enabled = true", "LOWER(p.name) like LOWER('%" . $query . "%') OR LOWER(p.tags) like LOWER('%" . $query . "%') ")
			->addOrderBy('p.downloads', 'DESC')
			->addOrderBy('p.id', 'asc')
			->setFirstResult($nombre * $page)
			->setMaxResults($nombre)
			->getQuery();
		$packs = $query_dql->getResult();

		return $this->render('AppBundle:Pack:api_all.html.php', array("packs" => $packs));
	}

	public function api_by_randomAction(Request $request, $token) {
		if ($token != $this->container->getParameter('token_app')) {
			throw new NotFoundHttpException("Page not found");
		}

		$nombre = 30;
		$em = $this->getDoctrine()->getManager();
		$imagineCacheManager = $this->get('liip_imagine.cache.manager');
		$repository = $em->getRepository('AppBundle:Pack');

		$max = sizeof($repository->createQueryBuilder('g')
				->where("g.enabled = true")
				->getQuery()->getResult());

		$query = $repository->createQueryBuilder('g')
			->where("g.enabled = true", "g.id >= :rand")
			->orderBy('g.created', 'DESC')
			->setParameter('rand', rand(0, $max))
			->setMaxResults($nombre)
			->orderBy('g.downloads', 'DESC')
			->getQuery();

		$packs = $query->getResult();
		return $this->render('AppBundle:Pack:api_all.html.php', array("packs" => $packs));
	}

	public function api_by_userAction(Request $request, $page, $order, $user, $token) {
		if ($token != $this->container->getParameter('token_app')) {
			throw new NotFoundHttpException("Page not found");
		}
		$nombre = 30;
		$em = $this->getDoctrine()->getManager();
		$imagineCacheManager = $this->get('liip_imagine.cache.manager');
		$repository = $em->getRepository('AppBundle:Pack');

		$query = $repository->createQueryBuilder('p')
			->where('p.user = :user', "p.enabled = true")
			->setParameter('user', $user)
			->addOrderBy('p.' . $order, 'DESC')
			->addOrderBy('p.id', 'asc')
			->setFirstResult($nombre * $page)
			->setMaxResults($nombre)
			->getQuery();

		$packs = $query->getResult();
		return $this->render('AppBundle:Pack:api_all.html.php', array("packs" => $packs));
	}

	public function api_deleteAction(Request $request, $token) {
		if ($token != $this->container->getParameter('token_app')) {
			throw new NotFoundHttpException("Page not found");
		}
		$user = $request->get("user");
		$id = $request->get("pack");
		$key = $request->get("key");

		$code = 200;
		$message = "";
		$errors = array();

		$em = $this->getDoctrine()->getManager();
		$user = $em->getRepository('UserBundle:User')->find($user);
		$pack = $em->getRepository('AppBundle:Pack')->find($id);
		if ($user != null and $pack != null) {
			if (sha1($user->getPassword()) == $key && $user->getId() == $pack->getUser()->getId()) {
				foreach ($pack->getStickers() as $key => $sticker) {
					$media = $sticker->getMedia();
					$em->remove($sticker);
					$em->flush();
					if ($media != null) {
						$this->get('app.media_storage')->delete($media);
						$em->remove($media);
						$em->flush();
					}
				}
				$media = $pack->getImage();
				$em->remove($pack);
				$em->flush();
				if ($media != null) {
					$this->get('app.media_storage')->delete($media);
					$em->remove($media);
					$em->flush();
				}
				$code = 200;
				$message = "The pack has been deleted successfully";
			} else {
				$code = 500;
				$message = "Request denied please check data usage (IK)";
			}

		} else {
			$code = 500;
			$message = "Request denied please check data usage (NU)";
		}
		$error = array(
			"code" => $code,
			"message" => $message,
			"values" => array(),
		);
		$encoders = array(new XmlEncoder(), new JsonEncoder());
		$normalizers = array(new ObjectNormalizer());
		$serializer = new Serializer($normalizers, $encoders);
		$jsonContent = $serializer->serialize($error, 'json');
		return new Response($jsonContent);
	}


	public function api_get_rateAction($user = null, $pack, $token) {
		if ($token != $this->container->getParameter('token_app')) {
			throw new NotFoundHttpException("Page not found");
		}
		$em = $this->getDoctrine()->getManager();
		$a = $em->getRepository('AppBundle:Pack')->find($pack);
		$u = $em->getRepository("UserBundle:User")->find($user);
		$code = "200";
		$message = "";
		$errors = array();

		if ($a != null) {
			$rates_1 = $em->getRepository('AppBundle:Rate')->findBy(array("pack" => $a, "value" => 1));
			$rates_2 = $em->getRepository('AppBundle:Rate')->findBy(array("pack" => $a, "value" => 2));
			$rates_3 = $em->getRepository('AppBundle:Rate')->findBy(array("pack" => $a, "value" => 3));
			$rates_4 = $em->getRepository('AppBundle:Rate')->findBy(array("pack" => $a, "value" => 4));
			$rates_5 = $em->getRepository('AppBundle:Rate')->findBy(array("pack" => $a, "value" => 5));
			$rates = $em->getRepository('AppBundle:Rate')->findBy(array("pack" => $a));
			$rate = null;
			if ($u != null) {
				$rate = $em->getRepository('AppBundle:Rate')->findOneBy(array("user" => $u, "pack" => $a));
			}
			if ($rate == null) {
				$code = "202";
			} else {
				$message = $rate->getValue();
			}

			$errors[] = array("name" => "1", "value" => sizeof($rates_1));
			$errors[] = array("name" => "2", "value" => sizeof($rates_2));
			$errors[] = array("name" => "3", "value" => sizeof($rates_3));
			$errors[] = array("name" => "4", "value" => sizeof($rates_4));
			$errors[] = array("name" => "5", "value" => sizeof($rates_5));
			$total = 0;
			$count = 0;
			foreach ($rates as $key => $r) {
				$total += $r->getValue();
				$count++;
			}
			$v = 0;
			if ($count != 0) {
				$v = $total / $count;
			}
			$v2 = number_format((float) $v, 1, '.', '');
			$errors[] = array("name" => "rate", "value" => $v2);

		} else {
			$code = "500";
			$message = "Sorry, your rate could not be added at this time";
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

	public function api_myAction(Request $request, $page, $user, $token) {
		if ($token != $this->container->getParameter('token_app')) {
			throw new NotFoundHttpException("Page not found");
		}
		$nombre = 30;
		$em = $this->getDoctrine()->getManager();
		$imagineCacheManager = $this->get('liip_imagine.cache.manager');
		$repository = $em->getRepository('AppBundle:Pack');
		$query = $repository->createQueryBuilder('p')
			->leftJoin('p.user', 'c')
			->where('c.id = :user')
			->setParameter('user', $user)
			->addOrderBy('p.created', 'DESC')
			->addOrderBy('p.id', 'asc')
			->setFirstResult($nombre * $page)
			->setMaxResults($nombre)
			->getQuery();

		$packs = $query->getResult();
		return $this->render('AppBundle:Pack:api_all.html.php', array("packs" => $packs));
	}

	public function api_uploadAction(Request $request, $token) {

		$id = str_replace('"', '', $request->get("id"));
		$key = str_replace('"', '', $request->get("key"));
		$name = str_replace('"', '', $request->get("name"));
		$publisher = str_replace('"', '', $request->get("publisher"));
		$size = str_replace('"', '', $request->get("size"));
		$publisher_website = str_replace('"', '', $request->get("website"));
		$publisher_email = str_replace('"', '', $request->get("email"));
		$privacy_policy_website = str_replace('"', '', $request->get("privacy"));
		$license_agreement_website = str_replace('"', '', $request->get("license"));

		$categories_ids = str_replace('"', '', $request->get("categories"));
		$categories_list = explode("_", $categories_ids);

		$code = "200";
		$message = "Ok";
		$values = array();
		if ($token != $this->container->getParameter('token_app')) {
			throw new NotFoundHttpException("Page not found");
		}
		$em = $this->getDoctrine()->getManager();
		$user = $em->getRepository('UserBundle:User')->findOneBy(array("id" => $id));
		if ($user == null) {
			throw new NotFoundHttpException("Page not found");
		}
		if (sha1($user->getPassword()) != $key) {
			throw new NotFoundHttpException("Page not found");
		}
		/*if ($this->getRequest()->files->has('uploaded_file_sticker')==null) {
		throw new NotFoundHttpException("Page not found");
		}*/
		if ($user) {
			if ($this->getRequest()->files->has('uploaded_file')) {
				$file = $this->getRequest()->files->get('uploaded_file');
				$media = new Media();
				$media->setFile($file);
				$media->upload($this->container->getParameter('files_directory'));
				$em->persist($media);
				$em->flush();

				$pack = new Pack();

				foreach ($categories_list as $key => $id_category) {
					$category_obj = $em->getRepository('AppBundle:Category')->find($id_category);
					if ($category_obj) {
						$pack->addCategory($category_obj);
					}
				}

				$pack->setPublisherwebsite($publisher_website);
				$pack->setPublisheremail($publisher_email);
				$pack->setPrivacypolicywebsite($privacy_policy_website);
				$pack->setLicenseagreementwebsite($license_agreement_website);
				$pack->setDownloads(0);
				if ($user->getTrusted()) {
					$pack->setEnabled(true);
					$pack->setReview(false);
				}else{
					$pack->setEnabled(false);
					$pack->setReview(true);			
				}		
				$pack->setPremium(false);
				$pack->setName($name);
				$pack->setPublisher($publisher);
				$pack->setUser($user);
				$pack->setImage($media);
				$em->persist($pack);
				$em->flush();

				$all = 0;
				$valide = 0;
				$pos = 1;
				$sizefiles = 0;
				for ($i = 0; $i < $size; $i++) {
					$file = $this->getRequest()->files->get('sticker_' . $i);
					$all++;
					$type = $file->getMimeType();
					if ($type == "image/png" || $type == "image/webp") {
						$sticker = new Sticker();
						$sticker->setFile($file);
						$media_sticker = new Media();
						$media_sticker->setFile($sticker->getFile());
						$media_sticker->upload($this->container->getParameter('files_directory'));
						$em->persist($media_sticker);
						$em->flush();
						$sticker->setEmojis(base64_encode("😀"));
						$sticker->setMedia($media_sticker);
						$sticker->setPack($pack);
						$sticker->setSize($sticker->getFile()->getClientSize());
						$sticker->setPosition($pos);
						$em->persist($sticker);
						$em->flush();
						$valide++;
						$pos++;
						$sizefiles += $sticker->getFile()->getClientSize();
					}
				}
				$em->flush();
				$pack->setSize($sizefiles);
				$em->persist($pack);
				$em->flush();
				if ($user->getTrusted()) {
					$tokens[] = $user->getToken();
					$messageNotif = array(
						"type" => "pack",
						"id" => $pack->getId(),
						"title" => "👍👍 Pack approved ❤️❤️",
						"message" => "😀😀 Congratulation you Pack has been approved ❤️❤️",
					);
					$setting = $em->getRepository("AppBundle:Settings")->findOneBy(array(), array());
					$key = $setting->getFirebasekey();
					$this->send_notificationToken($tokens, $messageNotif, $key);
				}

			}
		}
		$error = array(
			"code" => $code,
			"message" => $message,
			"values" => $values,
		);
		$encoders = array(new XmlEncoder(), new JsonEncoder());
		$normalizers = array(new ObjectNormalizer());
		$serializer = new Serializer($normalizers, $encoders);
		$jsonContent = $serializer->serialize($error, 'json');
		return new Response($jsonContent);
	}

	public function deleteAction($id, Request $request) {
		$em = $this->getDoctrine()->getManager();

		$pack = $em->getRepository("AppBundle:Pack")->find($id);
		if ($pack == null) {
			throw new NotFoundHttpException("Page not found");
		}
		$form = $this->createFormBuilder(array('id' => $id))
			->add('id', 'hidden')
			->add('Yes', 'submit')
			->getForm();
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			foreach ($pack->getStickers() as $key => $sticker) {
				$media = $sticker->getMedia();
				$em->remove($sticker);
				$em->flush();

				if ($media != null) {
					$this->get('app.media_storage')->delete($media);
					$em->remove($media);
					$em->flush();
				}
			}
			$media = $pack->getImage();
			$em->remove($pack);
			$em->flush();

			if ($media != null) {
				$this->get('app.media_storage')->delete($media);
				$em->remove($media);
				$em->flush();
			}
			$this->addFlash('success', 'Operation has been done successfully');
			return $this->redirect($this->generateUrl('app_pack_index'));
		}
		return $this->render('AppBundle:Pack:delete.html.twig', array("form" => $form->createView()));
	}

	public function editAction(Request $request, $id) {
		$em = $this->getDoctrine()->getManager();
		$pack = $em->getRepository("AppBundle:Pack")->findOneBy(array("id" => $id, "review" => false));
		if ($pack == null) {
			throw new NotFoundHttpException("Page not found");
		}
		$tags = "";
		foreach ($pack->getTagslist() as $key => $value) {
			if ($key == sizeof($pack->getTagslist()) - 1) {
				$tags .= $value->getName();
			} else {
				$tags .= $value->getName() . ",";
			}
		}
		$pack->setTags($tags);
		$form = $this->createForm(new EditPackType(), $pack);
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$pack->setTagslist(array());
			$em->persist($pack);
			$em->flush();

			$tags_list = explode(",", $pack->getTags());
			foreach ($tags_list as $k => $v) {
				$tags_list[$k] = strtolower($v);
			}
			$tags_list = array_unique($tags_list);

			foreach ($tags_list as $key => $value) {
				$tag = $em->getRepository("AppBundle:Tag")->findOneBy(array("name" => strtolower($value)));
				if ($tag == null) {
					$tag = new Tag();
					$tag->setName(strtolower($value));
					$em->persist($tag);
					$em->flush();
					$pack->addTagslist($tag);
				} else {
					$pack->addTagslist($tag);
				}
			}

			if ($pack->getFile() != null) {
				$media_old = $pack->getImage();
				$storage = $this->get('app.media_storage');
				// A new tray image goes wherever the pack's pictures already live, so
				// one pack never ends up split across the server and the Space.
				try {
					$media = $storage->store($pack->getFile(), $storage->targetFor($media_old), 'packs/tray');
				} catch (\RuntimeException $e) {
					$this->addFlash('error', 'The pack image was not stored: ' . $e->getMessage());
					return $this->redirect($this->generateUrl('app_pack_edit', array("id" => $pack->getId())));
				}
				$media->setEnabled(true);
				$em->persist($media);
				$em->flush();

				$pack->setImage($media);
				$em->flush();

				$storage->delete($media_old);
				$em->remove($media_old);
				$em->flush();
			}
			$em->persist($pack);
			$em->flush();
			$this->addFlash('success', 'Operation has been done successfully');
			return $this->redirect($this->generateUrl('app_pack_sizer', array("id" => $pack->getId())));
		}
		return $this->render("AppBundle:Pack:edit.html.twig", array("form" => $form->createView()));
	}

	/**
	 * The packs list.
	 *
	 * <p>It showed a tray image and ten stickers per pack and nothing else - not how
	 * many stickers were in it, not what it had been downloaded, not whether it was
	 * premium, animated or switched off. The headings and the numbers here are what
	 * make it a list you can work from.
	 */
	public function indexAction(Request $request) {

		$em = $this->getDoctrine()->getManager();
		$q = "  ";
		if ($request->query->has("q") and $request->query->get("q") != "") {
			$q .= " AND  p.name like '%" . $request->query->get("q") . "%'";
		}

		// Whichever heading is open. Anything else is everything.
		$show = $request->query->get('show');
		$filters = array(
			'premium' => ' AND p.premium = true ',
			'animated' => ' AND p.animated = true ',
			'hidden' => ' AND p.enabled = false ',
		);
		if (!isset($filters[$show])) {
			$show = null;
		}

		$dql = "SELECT p FROM AppBundle:Pack p  WHERE p.review = false " . $q
			. ($show === null ? '' : $filters[$show]) . " ORDER BY p.created desc ";
		$query = $em->createQuery($dql);
		$paginator = $this->get('knp_paginator');
		$packs = $paginator->paginate(
			$query,
			$request->query->getInt('page', 1),
			12
		);

		return $this->render('AppBundle:Pack:index.html.twig', array(
			"packs" => $packs,
			"show" => $show,
			"count" => $this->packCount($em),
			"counts" => array(
				'all' => $this->packCount($em),
				'premium' => $this->packCount($em, ' AND p.premium = true '),
				'animated' => $this->packCount($em, ' AND p.animated = true '),
				'hidden' => $this->packCount($em, ' AND p.enabled = false '),
			),
			"totals" => array(
				'downloads' => $em->getRepository('AppBundle:Pack')->downloads(),
				'stickers' => (int) $em->createQuery(
					'SELECT COUNT(s.id) FROM AppBundle:Sticker s')->getSingleScalarResult(),
				'review' => $em->getRepository('AppBundle:Pack')->countReviews(),
			),
		));
	}

	/** Published packs matching an extra condition, or all of them. */
	private function packCount($em, $condition = '') {
		return (int) $em->createQuery(
			'SELECT COUNT(p.id) FROM AppBundle:Pack p WHERE p.review = false ' . $condition)
			->getSingleScalarResult();
	}

	public function reviewAction(Request $request, $id) {
		$em = $this->getDoctrine()->getManager();
		$pack = $em->getRepository("AppBundle:Pack")->findOneBy(array("id" => $id, "review" => true));
		if ($pack == null) {
			throw new NotFoundHttpException("Page not found");
		}
		$form = $this->createForm(new ReviewPackType(), $pack);
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$pack->setReview(false);
			$pack->setEnabled(true);
			$pack->setCreated(new \DateTime());
			$em->persist($pack);
			$em->flush();
			$this->addFlash('success', 'Operation has been done successfully');
			return $this->redirect($this->generateUrl('app_home_notif_user_pack', array("pack_id" => $pack->getId())));
		}
		return $this->render("AppBundle:Pack:review.html.twig", array("pack" => $pack, "form" => $form->createView()));
	}

	public function reviewsAction(Request $request) {

		$em = $this->getDoctrine()->getManager();
		$q = "  ";
		if ($request->query->has("q") and $request->query->get("q") != "") {
			$q .= " AND  p.name like '%" . $request->query->get("q") . "%'";
		}
		$dql = "SELECT p FROM AppBundle:Pack p  WHERE p.review = true " . $q . "  ORDER BY p.created desc ";
		$query = $em->createQuery($dql);
		$paginator = $this->get('knp_paginator');
		$packs = $paginator->paginate(
			$query,
			$request->query->getInt('page', 1),
			12
		);
		$pack_list = $em->getRepository('AppBundle:Pack')->findBy(array("review" => true));
		$count = sizeof($pack_list);
		return $this->render('AppBundle:Pack:reviews.html.twig', array("packs" => $packs, "count" => $count));
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

	public function shareAction(Request $request, $id) {
		$em = $this->getDoctrine()->getManager();
		$setting = $em->getRepository("AppBundle:Settings")->findOneBy(array(), array());
		$pack = $em->getRepository("AppBundle:Pack")->find($id);
		if ($pack == null) {
			throw new NotFoundHttpException("Page not found");
		}
		return $this->render("AppBundle:Pack:share.html.twig", array("setting" => $setting, "pack" => $pack));
	}

	public function sizePack($pack, $em) {
		$size = 0;
		foreach ($pack->getStickers() as $key => $sticker) {
			$size += $sticker->getSize();
		}
		$pack->setSize($size);
		$em->flush();
	}

	public function sizerAction($id, Request $request) {
		$em = $this->getDoctrine()->getManager();
		$pack = $em->getRepository("AppBundle:Pack")->find($id);
		$imagineCacheManager = $this->get('liip_imagine.cache.manager');
		foreach ($pack->getStickers() as $key => $sticker) {
			// Warms the thumbnail cache. A sticker in the Space has nothing to warm.
			if (!$sticker->getMedia()->isRemote()) {
				$s["image"] = $imagineCacheManager->getBrowserPath($sticker->getMedia()->getLink(), 'category_thumb_api');
			}
		}
		if ($pack == null) {
			throw new NotFoundHttpException("Page not found");
		}
		$this->sizePack($pack, $em);
		return $this->redirect($this->generateUrl('app_pack_view', array("id" => $id)));
	}

	public function stickersAction($id, Request $request) {
		$em = $this->getDoctrine()->getManager();
		$pack = $em->getRepository("AppBundle:Pack")->find($id);
		if ($pack == null) {
			throw new NotFoundHttpException("Page not found");
		}
		$stickers = $em->getRepository('AppBundle:Sticker')->findBy(array("pack" => $pack), array("position" => "asc"));
		$count = sizeof($stickers);
		return $this->render('AppBundle:Pack:stickers.html.twig', array("pack" => $pack, "stickers" => $stickers, "count" => $count));
	}

	public function viewAction(Request $request, $id) {
		$em = $this->getDoctrine()->getManager();
		$pack = $em->getRepository("AppBundle:Pack")->find($id);
		$stickers = $pack->getStickers();
		$count = sizeof($pack->getStickers());
		if ($pack == null) {
			throw new NotFoundHttpException("Page not found");
		}

		$rates_1 = $em->getRepository('AppBundle:Rate')->findBy(array("pack" => $pack, "value" => 1));
		$rates_2 = $em->getRepository('AppBundle:Rate')->findBy(array("pack" => $pack, "value" => 2));
		$rates_3 = $em->getRepository('AppBundle:Rate')->findBy(array("pack" => $pack, "value" => 3));
		$rates_4 = $em->getRepository('AppBundle:Rate')->findBy(array("pack" => $pack, "value" => 4));
		$rates_5 = $em->getRepository('AppBundle:Rate')->findBy(array("pack" => $pack, "value" => 5));
		$rates = $em->getRepository('AppBundle:Rate')->findBy(array("pack" => $pack));

		$ratings["rate_1"] = sizeof($rates_1);
		$ratings["rate_2"] = sizeof($rates_2);
		$ratings["rate_3"] = sizeof($rates_3);
		$ratings["rate_4"] = sizeof($rates_4);
		$ratings["rate_5"] = sizeof($rates_5);

		$t = sizeof($rates_1) + sizeof($rates_2) + sizeof($rates_3) + sizeof($rates_4) + sizeof($rates_5);
		if ($t == 0) {
			$t = 1;
		}
		$values["rate_1"] = (sizeof($rates_1) * 100) / $t;
		$values["rate_2"] = (sizeof($rates_2) * 100) / $t;
		$values["rate_3"] = (sizeof($rates_3) * 100) / $t;
		$values["rate_4"] = (sizeof($rates_4) * 100) / $t;
		$values["rate_5"] = (sizeof($rates_5) * 100) / $t;

		$total = 0;
		$count = 0;
		foreach ($rates as $key => $r) {
			$total += $r->getValue();
			$count++;
		}
		$v = 0;
		if ($count != 0) {
			$v = $total / $count;
		}
		$rating = $v;
		return $this->render("AppBundle:Pack:view.html.twig", array("stickers" => $stickers, "rating" => $rating, "ratings" => $ratings, "values" => $values, "count" => $count, "pack" => $pack));
	}
}
?>
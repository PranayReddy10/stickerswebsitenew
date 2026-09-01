<?php
namespace UserBundle\Controller;
require_once __DIR__ . '/../../../app/config/firebase_auth.php';
use MediaBundle\Entity\Media as Media;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use UserBundle\Entity\User;
use UserBundle\Form\UserType;

class UserController extends Controller {
	public function api_change_passwordAction($id, $password, $new_password, $token) {
		if ($token != $this->container->getParameter('token_app')) {
			throw new NotFoundHttpException("Page not found");
		}
		$code = "200";
		$message = "";
		$errors = array();
		$em = $this->getDoctrine()->getManager();
		$user = $em->getRepository('UserBundle:User')->findOneBy(array("id" => $id));
		if ($user->hasRole("ROLE_ADMIN")) {
			throw new NotFoundHttpException("Page not found");
		}
		if ($user->getType() != "email") {
			throw new NotFoundHttpException("Page not found");
		}
		if ($user) {
			$encoder_service = $this->get('security.encoder_factory');
			$encoder = $encoder_service->getEncoder($user);
			if ($encoder->isPasswordValid($user->getPassword(), $password, $user->getSalt())) {

				if (strlen($new_password) < 6) {
					$code = 500;
					$errors["password"] = "cette valeur est trop courte";
				} else {
					$newPasswordEncoded = $encoder->encodePassword($new_password, $user->getSalt());
					$user->setPassword($newPasswordEncoded);
					$em->persist($user);
					$em->flush();
					$code = 200;
					$message = "Password has been changed successfully";
					$errors[] = array("name" => "id", "value" => $user->getId());
					$errors[] = array("name" => "name", "value" => $user->getName());
					$errors[] = array("name" => "type", "value" => $user->getType());
					$errors[] = array("name" => "username", "value" => $user->getUsername());
					$errors[] = array("name" => "salt", "value" => $user->getSalt());
					$errors[] = array("name" => "token", "value" => sha1($user->getPassword()));
				}
			} else {
				$code = 500;
				$message = "Current password is incorrect";
			}
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

	public function api_checkAction($id, $key, $token) {
		$code = "500";
		$message = "";
		$errors = array();
		if ($token != $this->container->getParameter('token_app')) {
			$code = 500;
		}

		$em = $this->getDoctrine()->getManager();
		$user = $em->getRepository('UserBundle:User')->findOneBy(array("id" => $id));

		if ($user) {
			if ($user->isEnabled()) {
				if ($key == sha1($user->getPassword())) {
					$code = 200;
				} else {
					$code = 500;
				}
			} else {
				$code = 500;
			}
			if ($user->hasRole("ROLE_ADMIN")) {
				$code = 500;
			}
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

	public function api_editAction(Request $request, $token) {
		if ($token != $this->container->getParameter('token_app')) {
			throw new NotFoundHttpException("Page not found");
		}
		$email = str_replace('"',"",$request->get("email"));
		$facebook = str_replace('"', "",  $request->get("facebook"));
		$instagram =str_replace('"', "",   $request->get("instagram"));
		$twitter = str_replace('"', "",  $request->get("twitter"));
		$name = str_replace('"', "",  $request->get("name"));
		$user = str_replace('"', "",  $request->get("user"));
		$key = str_replace('"', "",  $request->get("key"));

		$code = "200";
		$message = "";
		$values = array();

		$em = $this->getDoctrine()->getManager();

		$user = $em->getRepository('UserBundle:User')->find($user);

		if (!$user) {
			throw new NotFoundHttpException("Page not found");
		}
		if (sha1($user->getPassword()) == $key) {
			
                	
                	if($this->getRequest()->files->get('uploaded_file')){
	 		      $media= new Media();
	                    $media->setFile($this->getRequest()->files->get('uploaded_file'));
	                    $media->upload($this->container->getParameter('files_directory'));
	                    $image = $media->getLink();
	                    $old_image =   $user->getOriginalImage();
	                    $user->setImage($image);
	                    @unlink($old_image);

                    	}

			$user->setFacebook($facebook);
			$user->setTwitter($twitter);
			$user->setInstagram($instagram);
			$user->setEmailo($email);
			$user->setName($name);
			$em->flush();
			$code = 200;
			$message = "Your infos has been successfully edit";
		}


		$values[] = array("name" => "name", "value" => $user->getName());
		$values[] = array("name" => "url", "value" => $user->getImage());

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

	public function api_edit_nameAction($id, $name, $key, $token) {
		if ($token != $this->container->getParameter('token_app')) {
			throw new NotFoundHttpException("Page not found");
		}

		$code = "200";
		$message = "";
		$errors = array();
		$em = $this->getDoctrine()->getManager();
		$user = $em->getRepository('UserBundle:User')->findOneBy(array("id" => $id));
		if ($user->hasRole("ROLE_ADMIN")) {
			throw new NotFoundHttpException("Page not found");
		}
		if (sha1($user->getPassword()) != $key) {
			throw new NotFoundHttpException("Page not found");
		}
		if ($user) {
			$user->setName($name);
			$em->flush();
			$message = "Your information has been edit ";
			$code = "200";
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

	public function api_followAction(Request $request, $user, $follower, $key_, $token) {
		if ($token != $this->container->getParameter('token_app')) {
			throw new NotFoundHttpException("Page not found");
		}
		$code = 200;
		$message = "";
		$errors = array();

		$em = $this->getDoctrine()->getManager();

		$user = $em->getRepository('UserBundle:User')->find($user);
		$follower = $em->getRepository('UserBundle:User')->find($follower);

		if ($user != null and $follower != null) {
			$followers = $user->getFollowers();
			$exists = false;
			foreach ($followers as $key => $f) {
				if ($f->getId() == $follower->getId()) {
					$exists = true;
				}
			}
			if (sha1($follower->getPassword()) == $key_) {
				if ($exists) {
					$user->removeFollower($follower);
					$em->flush();
					$code = 202;
					$message = "You Unfollowing " . $user->getName();
				} else {
					$user->addFollower($follower);
					$em->flush();
					$code = 200;
					$message = "You following " . $user->getName();
					$messageNotif = array(
						"type" => "user",
						"id" => $follower->getId(),
						"name_user" => $follower->getName(),
						"image_user" => $follower->getImage(),
						"trusted_user" => $follower->getTrusted(),
						"title" => $follower->getName() . " Started follwing you ",
						"message" => "New follower here",
						"icon" => $follower->getImage(),
					);

					$setting = $em->getRepository("AppBundle:Settings")->findOneBy(array(), array());
					$key = $setting->getFirebasekey();

					$tokens[] = $user->getToken();
					$message_status = $this->send_notificationToken($tokens, $messageNotif, $key);
				}
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

	public function api_follow_checkAction(Request $request, $user, $follower, $key_, $token) {
		if ($token != $this->container->getParameter('token_app')) {
			throw new NotFoundHttpException("Page not found");
		}
		$code = 200;
		$message = "";
		$errors = array();

		$em = $this->getDoctrine()->getManager();

		$user = $em->getRepository('UserBundle:User')->find($user);
		$follower = $em->getRepository('UserBundle:User')->find($follower);

		if ($user != null and $follower != null) {
			$followers = $user->getFollowers();
			$exists = false;
			foreach ($followers as $key => $f) {
				if ($f->getId() == $follower->getId()) {
					$exists = true;
				}
			}
			if (sha1($follower->getPassword()) == $key_) {
				if ($exists) {
					$code = 200;
					$message = "You Following " . $user->getName();
				} else {
					$code = 202;
					$message = "You Unfollowing " . $user->getName();
				}
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

	public function api_followersAction(Request $request, $user, $token) {
		if ($token != $this->container->getParameter('token_app')) {
			throw new NotFoundHttpException("Page not found");
		}
		$em = $this->getDoctrine()->getManager();
		$user = $em->getRepository('UserBundle:User')->find($user);
		if ($user == null) {
			throw new NotFoundHttpException("Page not found");
		}
		$followers = array();
		foreach ($user->getFollowers() as $key => $f) {
			$a["id"] = $f->getId();
			$a["name"] = $f->getName();
			$a["image"] = $f->getImage();
			$a["trusted"] = $f->getTrusted();
			$followers[] = $a;
		}
		$encoders = array(new XmlEncoder(), new JsonEncoder());
		$normalizers = array(new ObjectNormalizer());
		$serializer = new Serializer($normalizers, $encoders);
		$jsonContent = $serializer->serialize($followers, 'json');
		return new Response($jsonContent);

	}

	public function api_followingsAction(Request $request, $user, $token) {
		if ($token != $this->container->getParameter('token_app')) {
			throw new NotFoundHttpException("Page not found");
		}
		$em = $this->getDoctrine()->getManager();
		$user = $em->getRepository('UserBundle:User')->find($user);
		if ($user == null) {
			throw new NotFoundHttpException("Page not found");
		}
		$users = array();
		foreach ($user->getUsers() as $key => $e) {
			$b["id"] = $e->getId();
			$b["name"] = $e->getName();
			$b["image"] = $e->getImage();
			$b["trusted"] = $e->getTrusted();
			$users[] = $b;
		}
		$encoders = array(new XmlEncoder(), new JsonEncoder());
		$normalizers = array(new ObjectNormalizer());
		$serializer = new Serializer($normalizers, $encoders);
		$jsonContent = $serializer->serialize($users, 'json');
		return new Response($jsonContent);

	}

	public function api_followingstopAction(Request $request, $user, $token) {
		if ($token != $this->container->getParameter('token_app')) {
			throw new NotFoundHttpException("Page not found");
		}
		if ($token != $this->container->getParameter('token_app')) {
			throw new NotFoundHttpException("Page not found");
		}
		$em = $this->getDoctrine()->getManager();
		$user = $em->getRepository('UserBundle:User')->find($user);
		if ($user == null) {
			throw new NotFoundHttpException("Page not found");
		}
		$users = array();
		foreach ($user->getUsers() as $key => $e) {
			if (sizeof($e->getPacks()) > 0) {
				$b["id"] = $e->getId();
				$b["name"] = $e->getName();
				$b["image"] = $e->getImage();
				$last_pack = $em->getRepository('AppBundle:Pack')->findOneBy(array("enabled" => true, "user" => $e), array("created" => "desc"));
				if ($last_pack != null) {
					$b["pack"] = $last_pack;
					$users[] = $b;
				}

			}
		}
		return $this->render('UserBundle:User:api_export.html.php', array("users" => $users));
	}

	public function api_getAction(Request $request, $user, $me, $token) {
		if ($token != $this->container->getParameter('token_app')) {
			throw new NotFoundHttpException("Page not found");
		}
		$code = 200;
		$message = "";
		$values = array();

		$em = $this->getDoctrine()->getManager();
		$user = $em->getRepository('UserBundle:User')->find($user);
		if ($user == null) {
			throw new NotFoundHttpException("Page not found");
		}

		if ($me != -1) {
			$me = $em->getRepository('UserBundle:User')->find($me);
			if ($me) {
				$followers = $user->getFollowers();
				$exists = false;
				foreach ($followers as $key => $f) {
					if ($f->getId() == $me->getId()) {
						$exists = true;
					}
				}
				if ($exists) {
					$values[] = array("name" => "follow", "value" => "true");
				} else {
					$values[] = array("name" => "follow", "value" => "false");
				}
			} else {
				$values[] = array("name" => "follow", "value" => "false");
			}
		} else {
			$values[] = array("name" => "follow", "value" => "false");
		}
		$followers = $user->getFollowers();
		$followings = $user->getUsers();
		$pack = $user->getPacks();
		$trusted=   $user->getTrusted() ? "true" : "false" ;
		$values[] = array("name" => "followers", "value" => sizeof($followers));
		$values[] = array("name" => "followings", "value" => sizeof($followings));
		$values[] = array("name" => "packs", "value" => sizeof($pack));
		$values[] = array("name" => "trusted", "value"=>$trusted);
		$values[] = array("name" => "facebook", "value" => $user->getFacebook());
		$values[] = array("name" => "twitter", "value" => $user->getTwitter());
		$values[] = array("name" => "instagram", "value" => $user->getInstagram());
		$values[] = array("name" => "email", "value" => $user->getEmailo());

		$value = array(
			"code" => $code,
			"message" => $message,
			"values" => $values,
		);
		$encoders = array(new XmlEncoder(), new JsonEncoder());
		$normalizers = array(new ObjectNormalizer());
		$serializer = new Serializer($normalizers, $encoders);
		$jsonContent = $serializer->serialize($value, 'json');
		return new Response($jsonContent);

	}

	/**
	 * Sign in with the address and password in the body rather than the path. An email
	 * address and a password have to survive URL encoding on the way through the old
	 * route, and a password in a path ends up in the access log; this does neither.
	 */
	public function api_signinAction(Request $request, $token) {
		if ($token != $this->container->getParameter('token_app')) {
			throw new NotFoundHttpException("Page not found");
		}
		try {
			return $this->signIn($request->get("username"), $request->get("password"));
		} catch (\Exception $e) {
			// Answer with the reason rather than a 500: the app can only show a status
			// code, and Cloudflare replaces a 5xx from here with a page of its own.
			error_log("api_signin failed: " . $e->getMessage());
			$error = array(
				"code"    => 500,
				"message" => "Sign in failed: " . $e->getMessage(),
				"values"  => array(),
			);
			$encoders = array(new XmlEncoder(), new JsonEncoder());
			$normalizers = array(new ObjectNormalizer());
			$serializer = new Serializer($normalizers, $encoders);
			return new Response($serializer->serialize($error, 'json'));
		}
	}

	public function api_loginAction($username, $password, $token) {
		if ($token != $this->container->getParameter('token_app')) {
			throw new NotFoundHttpException("Page not found");
		}
		return $this->signIn($username, $password);
	}

	/**
	 * The picture to hand back with an account.
	 *
	 * Accounts made through a provider or with an email address carry the URL directly,
	 * which is what register returns; only an avatar uploaded through the panel needs
	 * Imagine. Wrapped, because a filter that is not configured throws, and losing a
	 * picture must never cost somebody their sign in.
	 */
	private function profilePictureUrl($user) {
		$image = $user->getImage();
		if ($image !== null && trim($image) !== '') {
			return $image;
		}
		try {
			$imagineCacheManager = $this->get('liip_imagine.cache.manager');
			$link = $user->getMedia() === null
				? "img/default_male.png"
				: $user->getMedia()->getLink();
			return $imagineCacheManager->getBrowserPath($link, 'profile_picture');
		} catch (\Exception $e) {
			return "";
		}
	}

	/** Shared by both sign in routes. */
	private function signIn($username, $password) {
		$code = "200";
		$message = "";
		$errors = array();
		$em = $this->getDoctrine()->getManager();
		$user = $em->getRepository('UserBundle:User')->findOneBy(array("username" => $username));

		if ($user) {
			$encoder_service = $this->get('security.encoder_factory');
			$encoder = $encoder_service->getEncoder($user);
			if ($encoder->isPasswordValid($user->getPassword(), $password, $user->getSalt()) and !$user->hasRole("ROLE_ADMIN")) {
				if ($user->isEnabled() == true) {
					$code = 200;
					$message = "You have successfully logged in";
					$errors[] = array("name" => "id", "value" => $user->getId());
					$errors[] = array("name" => "name", "value" => $user->getName());
					$errors[] = array("name" => "type", "value" => $user->getType());
					$errors[] = array("name" => "username", "value" => $user->getUsername());
					$errors[] = array("name" => "salt", "value" => $user->getSalt());
					$errors[] = array("name" => "token", "value" => sha1($user->getPassword()));
					$errors[] = array("name" => "url", "value" => $this->profilePictureUrl($user));
				} else {
					$message = "Your account has been disabled by an administrator";
					$code = 500;
				}
			} else {
				$code = 500;
				$message = "Invalid email address or password ";
			}

		} else {
			$code = 500;
			$message = "Invalid email address or password ";
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

	public function api_registerAction(Request $request, $token) {
		if ($token != $this->container->getParameter('token_app')) {
			throw new NotFoundHttpException("Page not found");
		}
		$username = $request->get("username");
		$password = $request->get("password");
		$name = $request->get("name");
		$type = $request->get("type");
		$image = $request->get("image");

		$code = "200";
		$message = "";
		$errors = array();
		$em = $this->getDoctrine()->getManager();
		$u = $em->getRepository('UserBundle:User')->findOneByUsername($username);
		if ($u != null) {
			if ($u->getType() == "email") {
				$code = 500;
				$message = "this email address already exists";
				$errors[] = array("name" => "username", "value" => "this email address already exists");
			} else {
				$code = 200;
				$message = "You have successfully logged in";
				$u->setImage($image);
				$em->flush();
				$errors[] = array("name" => "id", "value" => $u->getId());
				$errors[] = array("name" => "name", "value" => $u->getName());
				$errors[] = array("name" => "username", "value" => $u->getUsername());
				$errors[] = array("name" => "salt", "value" => $u->getSalt());
				$errors[] = array("name" => "type", "value" => $u->getType());
				$errors[] = array("name" => "token", "value" => sha1($u->getPassword()));
				$errors[] = array("name" => "url", "value" => $u->getImage());
				$errors[] = array("name" => "enabled", "value" => $u->isEnabled());
			}
		} else {
			$user = new User();
			if (count($errors) == 0) {
				$user->setUsername($username);
				$user->setPlainPassword($password);
				$user->setEmail($username);
				$user->setEnabled(true);
				$user->setName($name);
				$user->setType($type);
				$user->setImage($image);
				$em->persist($user);
				$em->flush();
				$code = 200;
				$message = "You have successfully registered";
				$errors[] = array("name" => "id", "value" => $user->getId());
				$errors[] = array("name" => "name", "value" => $user->getName());
				$errors[] = array("name" => "username", "value" => $user->getUsername());
				$errors[] = array("name" => "salt", "value" => $user->getSalt());
				$errors[] = array("name" => "type", "value" => $user->getType());
				$errors[] = array("name" => "token", "value" => sha1($user->getPassword()));
				$errors[] = array("name" => "url", "value" => $user->getImage());
				$errors[] = array("name" => "enabled", "value" => $user->isEnabled());
			} else {
				$code = 500;
				$message = "validation error";
			}
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

	public function api_tokenAction(Request $request, $token) {
		if ($token != $this->container->getParameter('token_app')) {
			throw new NotFoundHttpException("Page not found");
		}
		$token_f = $request->get("token_f");
		$user = $request->get("user");
		$key = $request->get("key");
        	$name=$request->get("name");

		$code = "200";
		$message = "";
		$errors = array();

		$em = $this->getDoctrine()->getManager();

		$user = $em->getRepository('UserBundle:User')->find($user);

		if (!$user) {
			throw new NotFoundHttpException("Page not found");
		}
		if (sha1($user->getPassword()) == $key) {
			if ($name!=null) {
				$user->setName($name);
			}
			$user->setToken($token_f);
			$em->flush();
			$code = 200;
			$message = "Your infos has been successfully edit";
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

	public function api_uploadAction(Request $request, $id, $key, $token) {
		$code = "200";
		$message = "Ok";
		$values = array();
		if ($token != $this->container->getParameter('token_app')) {
			throw new NotFoundHttpException("Page not found");
		}
		$em = $this->getDoctrine()->getManager();
		$user = $em->getRepository('UserBundle:User')->findOneBy(array("id" => $id));
		if ($user->hasRole("ROLE_ADMIN")) {
			throw new NotFoundHttpException("Page not found");
		}
		if (sha1($user->getPassword()) != $key) {
			throw new NotFoundHttpException("Page not found");
		}
		if ($user) {
			if ($this->getRequest()->files->has('uploaded_file')) {
				$old_media = $user->getMedia();
				$media = new Media();
				$media->setFile($this->getRequest()->files->get('uploaded_file'));
				$media->upload($this->container->getParameter('files_directory'));
				$media->setEnabled(true);
				$em->persist($media);
				$em->flush();
				$user->setMedia($media);
				if ($old_media != null) {
					$old_media->delete($this->container->getParameter('files_directory'));
					$em->remove($old_media);
					$em->flush();
				}
				$em->flush();
				$imagineCacheManager = $this->get('liip_imagine.cache.manager');
				$values[] = array("name" => "url", "value" => $imagineCacheManager->getBrowserPath($media->getLink(), 'profile_picture'));
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

	public function commentAction(Request $request, $id) {
		$em = $this->getDoctrine()->getManager();
		$user = $em->getRepository("UserBundle:User")->find($id);
		if ($user == null) {
			throw new NotFoundHttpException("Page not found");
		}
		if ($user->hasRole("ROLE_ADMIN")) {
			throw new NotFoundHttpException("Page not found");
		}

		$dql = "SELECT c FROM AppBundle:Comment c  WHERE c.user = " . $user->getId();
		$query = $em->createQuery($dql);
		$paginator = $this->get('knp_paginator');
		$pagination = $paginator->paginate(
			$query,
			$request->query->getInt('page', 1),
			7
		);

		return $this->render(
			'UserBundle:User:comment.html.twig', array(
				'pagination' => $pagination,
				'user' => $user,
			)
		);
	}

	public function commentsAction(Request $request, $id) {
		$em = $this->getDoctrine()->getManager();
		$user = $em->getRepository("UserBundle:User")->find($id);
		if ($user == null) {
			throw new NotFoundHttpException("Page not found");
		}
		if ($user->hasRole("ROLE_ADMIN")) {
			throw new NotFoundHttpException("Page not found");
		}

		$dql = "SELECT c FROM AppBundle:Comment c  WHERE c.user = " . $user->getId();
		$query = $em->createQuery($dql);
		$paginator = $this->get('knp_paginator');
		$pagination = $paginator->paginate(
			$query,
			$request->query->getInt('page', 1),
			10
		);
		return $this->render(
			'UserBundle:User:comments.html.twig', array(
				'user' => $user,
				"pagination" => $pagination,
			)
		);
	}

	public function deleteAction($id, Request $request) {
		$em = $this->getDoctrine()->getManager();
		$user = $em->getRepository("UserBundle:User")->find($id);
		if ($user == null) {
			throw new NotFoundHttpException("Page not found");
		}
		$form = $this->createFormBuilder(array('id' => $id))
			->add('id', 'hidden')
			->add('Yes', 'submit', array("label" => "Yes , delete !"))
			->getForm();
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$em->remove($user);
			$em->flush();
			$this->addFlash('success', 'Operation has been done successfully');
			return $this->redirect($this->generateUrl('user_user_index'));
		}
		return $this->render('UserBundle:User:delete.html.twig', array("form" => $form->createView()));
	}

	public function editAction(Request $request, $id) {
		$em = $this->getDoctrine()->getManager();
		$user = $em->getRepository("UserBundle:User")->find($id);
		if ($user == null) {
			throw new NotFoundHttpException("Page not found");
		}
		if ($user->hasRole("ROLE_ADMIN")) {
			throw new NotFoundHttpException("Page not found");
		}

		$form = $this->createForm(new UserType(), $user);
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$em->flush();
			$request->getSession()->getFlashBag()->add('success', 'Operation has been done successfully');
			return $this->redirect($this->generateUrl('user_user_index'));
		}
		return $this->render(
			'UserBundle:User:edit.html.twig', array(
				"form" => $form->createView(),
				'user' => $user,
			)
		);
	}

	public function followersAction(Request $request, $id) {
		$em = $this->getDoctrine()->getManager();
		$user = $em->getRepository("UserBundle:User")->find($id);
		if ($user == null) {
			throw new NotFoundHttpException("Page not found");
		}
		if ($user->hasRole("ROLE_ADMIN")) {
			throw new NotFoundHttpException("Page not found");
		}
		return $this->render(
			'UserBundle:User:followers.html.twig', array(
				"user" => $user,
			)
		);
	}

	public function followingsAction(Request $request, $id) {
		$em = $this->getDoctrine()->getManager();
		$user = $em->getRepository("UserBundle:User")->find($id);
		if ($user == null) {
			throw new NotFoundHttpException("Page not found");
		}
		if ($user->hasRole("ROLE_ADMIN")) {
			throw new NotFoundHttpException("Page not found");
		}
		return $this->render(
			'UserBundle:User:followings.html.twig', array(
				"user" => $user,
			)
		);
	}

	public function indexAction(Request $request) {
		$em = $this->getDoctrine()->getManager();
		$users = $em->getRepository("UserBundle:User")->findAll();

		$q = " AND ( 1=1 ) ";
		if ($request->query->has("q") and $request->query->get("q") != "") {
			$q .= " AND ( u.name like '%" . $request->query->get("q") . "%' or u.username like '%" . $request->query->get("q") . "%') ";
		}
		$dql = "SELECT u FROM UserBundle:User u  WHERE (NOT u.roles LIKE '%ROLE_ADMIN%')   " . $q . " ";
		$query = $em->createQuery($dql);
		$paginator = $this->get('knp_paginator');
		$pagination = $paginator->paginate(
			$query,
			$request->query->getInt('page', 1),
			10
		);
		return $this->render("UserBundle:User:index.html.twig", array(
			'pagination' => $pagination,
			"users" => $users,
		));
	}

	/**
	 * One person's page.
	 *
	 * <p>The route has always been in the menu and in every link that names a user,
	 * but the action behind it was never written - clicking a name raised "not
	 * callable". This is that page: who they are, what they have made, what it has
	 * been worth, and the way into everything else about them.
	 */
	public function viewAction(Request $request, $id) {
		$em = $this->getDoctrine()->getManager();
		$user = $em->getRepository("UserBundle:User")->find($id);
		if ($user == null) {
			throw new NotFoundHttpException("Page not found");
		}

		$packs = $em->createQuery(
			"SELECT COUNT(p.id) AS total, COALESCE(SUM(p.downloads), 0) AS downloads"
			. " FROM AppBundle:Pack p WHERE p.user = :user")
			->setParameter('user', $user)->getSingleResult();

		$reels = $em->createQuery(
			"SELECT COUNT(r.id) AS total, COALESCE(SUM(r.views), 0) AS views,"
			. " COALESCE(SUM(r.likes), 0) AS likes"
			. " FROM AppBundle:Reel r WHERE r.user = :user")
			->setParameter('user', $user)->getSingleResult();

		$subscriptions = $em->getRepository('AppBundle:Subscription')
			->findBy(array('user' => $user), array('updated' => 'DESC'));
		$live = 0;
		foreach ($subscriptions as $subscription) {
			if ($subscription->getLive()) {
				$live++;
			}
		}

		return $this->render('UserBundle:User:view.html.twig', array(
			'user' => $user,
			'packs' => array('total' => (int) $packs['total'], 'downloads' => (int) $packs['downloads']),
			'reels' => array(
				'total' => (int) $reels['total'],
				'views' => (int) $reels['views'],
				'likes' => (int) $reels['likes'],
			),
			// A handful of each, newest first: enough to recognise somebody by their
			// work without turning the page into a second list screen.
			'recentPacks' => $em->createQuery(
				"SELECT p FROM AppBundle:Pack p WHERE p.user = :user ORDER BY p.created DESC")
				->setParameter('user', $user)->setMaxResults(6)->getResult(),
			'recentReels' => $em->createQuery(
				"SELECT r FROM AppBundle:Reel r WHERE r.user = :user ORDER BY r.created DESC")
				->setParameter('user', $user)->setMaxResults(6)->getResult(),
			'subscriptions' => $subscriptions,
			// Counted here: a value set inside a Twig loop does not survive the loop.
			'liveSubscriptions' => $live,
			'spaces' => $this->get('app.spaces'),
		));
	}

	public function packsAction(Request $request, $id) {
		$em = $this->getDoctrine()->getManager();
		$user = $em->getRepository("UserBundle:User")->find($id);
		if ($user == null) {
			throw new NotFoundHttpException("Page not found");
		}
		if ($user->hasRole("ROLE_ADMIN")) {
			throw new NotFoundHttpException("Page not found");
		}

		$dql = "SELECT w FROM AppBundle:Pack w  WHERE w.user = " . $user->getId() . " ORDER BY w.created desc";
		$query = $em->createQuery($dql);
		$paginator = $this->get('knp_paginator');
		$pagination = $paginator->paginate(
			$query,
			$request->query->getInt('page', 1),
			9
		);
		return $this->render(
			'UserBundle:User:packs.html.twig', array(
				"pagination" => $pagination,
				"user" => $user,
			)
		);
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
}

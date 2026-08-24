<?php 
namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Version;
use AppBundle\Form\VersionType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
class VersionController extends Controller
{

    public function addAction(Request $request)
    {
        $version= new Version();
        $form = $this->createForm(new VersionType(),$version);
        $em=$this->getDoctrine()->getManager();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($version);
            $em->flush();
            $this->addFlash('success', 'Operation has been done successfully');
            return $this->redirect($this->generateUrl('app_version_index'));
        }
        return $this->render("AppBundle:Version:add.html.twig",array("form"=>$form->createView()));
    }


    public function api_checkAction(Request $request,$code,$token)
    {
        if ($token!=$this->container->getParameter('token_app')) {
            throw new NotFoundHttpException("Page not found");  
        }
        $em=$this->getDoctrine()->getManager();
        $version =   $em->getRepository("AppBundle:Version")->findOneBy(array("code"=>$code,"enabled"=>true));
        $response=array();
        $code="200";
        $message="";
        $errors=array();
        if ($version==null) {
            $versions =  $em->getRepository("AppBundle:Version")->findBy(array("enabled"=>true),array("code"=>"asc"));
            $a=null;
            foreach ($versions as $key => $value) {
                $a=$value;
            }
            if ($a==null) {
                $code="200";
                $response["name"]="update";
                $response["value"]="App on update";
            }else{
                $code="202";
                $response["name"]="update";
                $response["value"]="New version available ".$a->getTitle() ." please update your application";
                $message = $a->getFeatures();
            }
        }else{
            $code="200";
            $response["name"]="update";
            $response["value"]="App on update";
        }

        $response_user["name"] = "user";
        $response_user["value"] = "200";




        $errors[]=$response;
        $errors[]=$response_user;



        $errors[]=$response;


        $settings =   $em->getRepository("AppBundle:Settings")->findOneBy(array());

        // Every ad setting the app understands. The app stores any ADMIN_* name it
        // receives, so adding a row here is enough to roll out a new network or a new
        // waterfall order without shipping a new build.
        $ads = array(
            "ADMIN_PUBLISHER_ID"              => $settings->getPublisherid(),
            "ADMIN_APP_ID"                    => $settings->getAppid(),

            // Global behaviour of the waterfall.
            "ADMIN_UNITY_GAME_ID"             => $settings->getUnitygameid(),
            "ADMIN_AD_TIMEOUT"                => $settings->getAdtimeout(),
            "ADMIN_AD_FALLBACK"               => $settings->getAdfallback(),

            // Banner.
            "ADMIN_BANNER_TYPE"               => $settings->getBannertype(),
            "ADMIN_BANNER_ORDER"              => $settings->getBannerorder(),
            "ADMIN_BANNER_ADMOB_ID"           => $settings->getBanneradmobid(),
            "ADMIN_BANNER_MAX_ID"             => $settings->getBannermaxid(),
            "ADMIN_BANNER_APPLOVIN_ID"        => $settings->getBannerapplovinid(),
            "ADMIN_BANNER_FACEBOOK_ID"        => $settings->getBannerfacebookid(),
            "ADMIN_BANNER_UNITY_ID"           => $settings->getBannerunityid(),

            // Native, plus how many packs sit between two in feed ads.
            "ADMIN_NATIVE_TYPE"               => $settings->getNativetype(),
            "ADMIN_NATIVE_ORDER"              => $settings->getNativeorder(),
            "ADMIN_NATIVE_ADMOB_ID"           => $settings->getNativeadmobid(),
            "ADMIN_NATIVE_MAX_ID"             => $settings->getNativemaxid(),
            "ADMIN_NATIVE_FACEBOOK_ID"        => $settings->getNativefacebookid(),
            "ADMIN_NATIVE_BANNER_FACEBOOK_ID" => $settings->getNativebannerfacebookid(),
            "ADMIN_NATIVE_LINES"              => $settings->getNativeitem(),

            // Interstitial.
            "ADMIN_INTERSTITIAL_TYPE"         => $settings->getInterstitialtype(),
            "ADMIN_INTERSTITIAL_ORDER"        => $settings->getInterstitialorder(),
            "ADMIN_INTERSTITIAL_ADMOB_ID"     => $settings->getInterstitialadmobid(),
            "ADMIN_INTERSTITIAL_MAX_ID"       => $settings->getInterstitialmaxid(),
            "ADMIN_INTERSTITIAL_APPLOVIN_ID"  => $settings->getInterstitialapplovinid(),
            "ADMIN_INTERSTITIAL_FACEBOOK_ID"  => $settings->getInterstitialfacebookid(),
            "ADMIN_INTERSTITIAL_UNITY_ID"     => $settings->getInterstitialunityid(),
            "ADMIN_INTERSTITIAL_CLICKS"       => $settings->getInterstitialclick(),

            // Rewarded.
            "ADMIN_REWARDED_AD_TYPE"          => $settings->getRewardedtype(),
            "ADMIN_REWARDED_ORDER"            => $settings->getRewardedorder(),
            "ADMIN_REWARDED_ADMOB_ID"         => $settings->getRewardedadmobid(),
            "ADMIN_REWARDED_MAX_ID"           => $settings->getRewardedmaxid(),
            "ADMIN_REWARDED_APPLOVIN_ID"      => $settings->getRewardedapplovinid(),
            "ADMIN_REWARDED_FACEBOOK_ID"      => $settings->getRewardedfacebookid(),
            "ADMIN_REWARDED_UNITY_ID"         => $settings->getRewardedunityid(),

            // Ad shown when a free pack is added to WhatsApp / Telegram / Signal.
            "ADMIN_DOWNLOAD_AD_TYPE"          => $settings->getDownloadadtype(),
        );

        foreach ($ads as $name => $value) {
            $errors[] = array("name" => $name, "value" => (string) $value);
        }

        $error=array(
                "code"=>$code,
                "message"=>$message,
                "values"=>$errors,
                );
        header('Content-Type: application/json'); 
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent=$serializer->serialize($error, 'json');
        return new Response($jsonContent);  
    }
    public function indexAction()
    {
	    $em=$this->getDoctrine()->getManager();
        $versions=$em->getRepository('AppBundle:Version')->findBy(array(),array("code"=>"asc"));
	    return $this->render('AppBundle:Version:index.html.twig',array("versions"=>$versions));    
	}
  

    public function deleteAction($id,Request $request){
        $em=$this->getDoctrine()->getManager();

        $version = $em->getRepository("AppBundle:Version")->find($id);
        if($version==null){
            throw new NotFoundHttpException("Page not found");
        }

        $form=$this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->add('Yes', 'submit')
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            
            //if (sizeof($version->getAlbums())==0) {
                $em->remove($version);
                $em->flush();


                $this->addFlash('success', 'Operation has been done successfully');
            //}else{
             //   $this->addFlash('danger', 'Operation has been cancelled ,Your album not empty');   
            //}
            return $this->redirect($this->generateUrl('app_version_index'));
        }
        return $this->render('AppBundle:Version:delete.html.twig',array("form"=>$form->createView()));
    }
    public function editAction(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $version=$em->getRepository("AppBundle:Version")->find($id);
        if ($version==null) {
            throw new NotFoundHttpException("Page not found");
        }
        $form = $this->createForm(new VersionType(),$version);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($version);
            $em->flush();
            $this->addFlash('success', 'Operation has been done successfully');
            return $this->redirect($this->generateUrl('app_version_index'));
 
        }
        return $this->render("AppBundle:Version:edit.html.twig",array("form"=>$form->createView()));
    }
}
?>
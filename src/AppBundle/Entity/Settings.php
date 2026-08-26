<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use MediaBundle\Entity\Media;
/**
 * Settings
 *
 * @ORM\Table(name="settings_table")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SettingsRepository")
 */
class Settings 
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="appname", type="string", length=255 , nullable = true)
     */
    private $appname;

    /**
     * @var string
     *
     * @ORM\Column(name="appdescription", type="text", nullable = true)
     */
    private $appdescription;

    /**
     * @var string
     *
     * @ORM\Column(name="googleplay", type="text", nullable = true)
     */
    private $googleplay;

    /**
     * @var string
     *
     * @ORM\Column(name="privacypolicy", type="text", nullable = true)
     */
    private $privacypolicy;

    /**
     * @var string
     *
     * @ORM\Column(name="firebasekey", type="string", length=255 , nullable = true)
     */
    private $firebasekey;

    /**
     * @var string
     *
     * @ORM\Column(name="publisherid", type="string", length=255 , nullable = true)
     */
    private $publisherid;


    /**
     * @var string
     *
     * @ORM\Column(name="appid", type="string", length=255 , nullable = true)
     */
    private $appid;

    /**
     * @var string
     *
     * @ORM\Column(name="rewardedadmobid", type="string", length=255 , nullable = true)
     */
    private $rewardedadmobid;

    /**
     * @var string
     *
     * @ORM\Column(name="banneradmobid", type="string", length=255 , nullable = true)
     */
    private $banneradmobid;


    /**
     * @var string
     *
     * @ORM\Column(name="bannerfacebookid", type="string", length=255 , nullable = true)
     */
    private $bannerfacebookid;

    /**
     * @var string
     *
     * @ORM\Column(name="nativebannerfacebookid", type="string", length=255 , nullable = true)
     */
    private $nativebannerfacebookid;

    /**
     * @var string
     *
     * @ORM\Column(name="bannertype", type="string", length=255 , nullable = true)
     */
    private $bannertype;

    /**
     * @var string
     *
     * @ORM\Column(name="nativeadmobid", type="string", length=255 , nullable = true)
     */
    private $nativeadmobid;

    /**
     * @var string
     *
     * @ORM\Column(name="nativefacebookid", type="string", length=255 , nullable = true)
     */
    private $nativefacebookid;

    /**
     * @var string
     *
     * @ORM\Column(name="nativeitem",  type="integer",  length=255 , nullable = true)
     */
    private $nativeitem;


    /**
     * @var string
     *
     * @ORM\Column(name="nativetype", type="string", length=255 , nullable = true)
     */
    private $nativetype;

    /**
     * @var string
     *
     * @ORM\Column(name="interstitialadmobid", type="string", length=255 , nullable = true)
     */
    private $interstitialadmobid;

    /**
     * @var string
     *
     * @ORM\Column(name="interstitialfacebookid", type="string", length=255 , nullable = true)
     */
    private $interstitialfacebookid;


     /**
     * @var string
     *
     * @ORM\Column(name="interstitialtype", type="string", length=255 , nullable = true)
     */
    private $interstitialtype;

     /**
     * @var string
     *
     * @ORM\Column(name="interstitialclick", type="integer", length=255 , nullable = true)
     */
    private $interstitialclick;

    /**
     * Rewarded waterfall primary network
     *
     * @var string
     *
     * @ORM\Column(name="rewardedtype", type="string", length=255 , nullable = true)
     */
    private $rewardedtype;

    /**
     * AppLovin MAX banner unit id
     *
     * @var string
     *
     * @ORM\Column(name="bannermaxid", type="string", length=255 , nullable = true)
     */
    private $bannermaxid;

    /**
     * AppLovin direct banner zone id
     *
     * @var string
     *
     * @ORM\Column(name="bannerapplovinid", type="string", length=255 , nullable = true)
     */
    private $bannerapplovinid;

    /**
     * Unity Ads banner placement id
     *
     * @var string
     *
     * @ORM\Column(name="bannerunityid", type="string", length=255 , nullable = true)
     */
    private $bannerunityid;

    /**
     * Banner waterfall order, e.g. ADMOB,MAX,FACEBOOK,UNITY
     *
     * @var string
     *
     * @ORM\Column(name="bannerorder", type="string", length=255 , nullable = true)
     */
    private $bannerorder;

    /**
     * AppLovin MAX native unit id
     *
     * @var string
     *
     * @ORM\Column(name="nativemaxid", type="string", length=255 , nullable = true)
     */
    private $nativemaxid;

    /**
     * Native waterfall order
     *
     * @var string
     *
     * @ORM\Column(name="nativeorder", type="string", length=255 , nullable = true)
     */
    private $nativeorder;

    /**
     * AppLovin MAX interstitial unit id
     *
     * @var string
     *
     * @ORM\Column(name="interstitialmaxid", type="string", length=255 , nullable = true)
     */
    private $interstitialmaxid;

    /**
     * AppLovin direct interstitial zone id
     *
     * @var string
     *
     * @ORM\Column(name="interstitialapplovinid", type="string", length=255 , nullable = true)
     */
    private $interstitialapplovinid;

    /**
     * Unity Ads interstitial placement id
     *
     * @var string
     *
     * @ORM\Column(name="interstitialunityid", type="string", length=255 , nullable = true)
     */
    private $interstitialunityid;

    /**
     * Interstitial waterfall order
     *
     * @var string
     *
     * @ORM\Column(name="interstitialorder", type="string", length=255 , nullable = true)
     */
    private $interstitialorder;

    /**
     * AppLovin MAX rewarded unit id
     *
     * @var string
     *
     * @ORM\Column(name="rewardedmaxid", type="string", length=255 , nullable = true)
     */
    private $rewardedmaxid;

    /**
     * AppLovin direct rewarded zone id
     *
     * @var string
     *
     * @ORM\Column(name="rewardedapplovinid", type="string", length=255 , nullable = true)
     */
    private $rewardedapplovinid;

    /**
     * Meta Audience Network rewarded placement id
     *
     * @var string
     *
     * @ORM\Column(name="rewardedfacebookid", type="string", length=255 , nullable = true)
     */
    private $rewardedfacebookid;

    /**
     * Unity Ads rewarded placement id
     *
     * @var string
     *
     * @ORM\Column(name="rewardedunityid", type="string", length=255 , nullable = true)
     */
    private $rewardedunityid;

    /**
     * Rewarded waterfall order
     *
     * @var string
     *
     * @ORM\Column(name="rewardedorder", type="string", length=255 , nullable = true)
     */
    private $rewardedorder;

    /**
     * Unity Ads game id
     *
     * @var string
     *
     * @ORM\Column(name="unitygameid", type="string", length=255 , nullable = true)
     */
    private $unitygameid;

    /**
     * TRUE to try every configured network, FALSE for the listed ones only
     *
     * @var string
     *
     * @ORM\Column(name="adfallback", type="string", length=255 , nullable = true)
     */
    private $adfallback;

    /**
     * Seconds to wait for one network before moving to the next
     *
     * @var integer
     *
     * @ORM\Column(name="adtimeout", type="integer" , nullable = true)
     */
    private $adtimeout;

    /**
     * Liftoff Monetize (Vungle) App id
     *
     * @var string
     *
     * @ORM\Column(name="vungleappid", type="string", length=255 , nullable = true)
     */
    private $vungleappid;

    /**
     * InMobi Account id
     *
     * @var string
     *
     * @ORM\Column(name="inmobiaccountid", type="string", length=255 , nullable = true)
     */
    private $inmobiaccountid;

    /**
     * Vungle banner placement id
     *
     * @var string
     *
     * @ORM\Column(name="bannervungleid", type="string", length=255 , nullable = true)
     */
    private $bannervungleid;

    /**
     * InMobi banner placement id
     *
     * @var string
     *
     * @ORM\Column(name="bannerinmobiid", type="string", length=255 , nullable = true)
     */
    private $bannerinmobiid;

    /**
     * Vungle interstitial placement id
     *
     * @var string
     *
     * @ORM\Column(name="interstitialvungleid", type="string", length=255 , nullable = true)
     */
    private $interstitialvungleid;

    /**
     * InMobi interstitial placement id
     *
     * @var string
     *
     * @ORM\Column(name="interstitialinmobiid", type="string", length=255 , nullable = true)
     */
    private $interstitialinmobiid;

    /**
     * Vungle rewarded placement id
     *
     * @var string
     *
     * @ORM\Column(name="rewardedvungleid", type="string", length=255 , nullable = true)
     */
    private $rewardedvungleid;

    /**
     * InMobi rewarded placement id
     *
     * @var string
     *
     * @ORM\Column(name="rewardedinmobiid", type="string", length=255 , nullable = true)
     */
    private $rewardedinmobiid;

    /**
     * Vungle native placement id.
     *
     * @var string
     *
     * @ORM\Column(name="nativevungleid", type="string", length=255 , nullable = true)
     */
    private $nativevungleid;

    /**
     * InMobi native placement id.
     *
     * @var string
     *
     * @ORM\Column(name="nativeinmobiid", type="string", length=255 , nullable = true)
     */
    private $nativeinmobiid;

    /**
     * FALSE hides reels in the app: no Reels tab in the bottom bar and no reels
     * anywhere else. Empty counts as on, so an existing install is unchanged.
     *
     * @var string
     *
     * @ORM\Column(name="reelsenabled", type="string", length=255 , nullable = true)
     */
    private $reelsenabled;

    /**
     * TRUE to offer email and password sign up and sign in in the app, FALSE to leave
     * only the social and phone buttons.
     *
     * @var string
     *
     * @ORM\Column(name="manuallogin", type="string", length=255 , nullable = true)
     */
    private $manuallogin;

    /**
     * TRUE to publish reels from the app straight away, FALSE to hold them in the
     * review queue first.
     *
     * @var string
     *
     * @ORM\Column(name="reelsautopublish", type="string", length=255 , nullable = true)
     */
    private $reelsautopublish;

    /**
     * Reels between two native ads in the Reels feed. Falls back to nativeitem when
     * empty, so the reels feed can be tuned without changing the pack lists.
     *
     * @var integer
     *
     * @ORM\Column(name="reelsnativeitem", type="integer", nullable = true)
     */
    private $reelsnativeitem;

    /**
     * @Assert\File(mimeTypes={"image/jpeg","image/png" },maxSize="40M")
     */
    private $file;
     /**
     * @ORM\ManyToOne(targetEntity="MediaBundle\Entity\Media")
     * @ORM\JoinColumn(name="media_id", referencedColumnName="id")
     * @ORM\JoinColumn(nullable=false)
     */
    private $media;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set appname
     *
     * @param string $appname
     * @return Settings
     */
    public function setAppname($appname)
    {
        $this->appname = $appname;

        return $this;
    }

    /**
     * Get appname
     *
     * @return string 
     */
    public function getAppname()
    {
        return $this->appname;
    }

    /**
     * Set appdescription
     *
     * @param string $appdescription
     * @return Settings
     */
    public function setAppdescription($appdescription)
    {
        $this->appdescription = $appdescription;

        return $this;
    }

    /**
     * Get appdescription
     *
     * @return string 
     */
    public function getAppdescription()
    {
        return $this->appdescription;
    }

    /**
     * Set googleplay
     *
     * @param string $googleplay
     * @return Settings
     */
    public function setGoogleplay($googleplay)
    {
        $this->googleplay = $googleplay;

        return $this;
    }

    /**
     * Get googleplay
     *
     * @return string 
     */
    public function getGoogleplay()
    {
        return $this->googleplay;
    }

    /**
     * Set privacypolicy
     *
     * @param string $privacypolicy
     * @return Settings
     */
    public function setPrivacypolicy($privacypolicy)
    {
        $this->privacypolicy = $privacypolicy;

        return $this;
    }

    /**
     * Get privacypolicy
     *
     * @return string 
     */
    public function getPrivacypolicy()
    {
        return $this->privacypolicy;
    }

    /**
     * Set firebasekey
     *
     * @param string $firebasekey
     * @return Settings
     */
    public function setFirebasekey($firebasekey)
    {
        $this->firebasekey = $firebasekey;

        return $this;
    }

    /**
     * Get firebasekey
     *
     * @return string 
     */
    public function getFirebasekey()
    {
        return $this->firebasekey;
    }

    public function getFile()
    {
        return $this->file;
    }
    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }
    /**
     * Set media
     *
     * @param string $media
     * @return image
     */
    public function setMedia(Media $media)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return string 
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
    * Get banneradmobid
    * @return  
    */
    public function getBanneradmobid()
    {
        return $this->banneradmobid;
    }
    
    /**
    * Set banneradmobid
    * @return $this
    */
    public function setBanneradmobid($banneradmobid)
    {
        $this->banneradmobid = $banneradmobid;
        return $this;
    }

    /**
    * Get bannerfacebookid
    * @return  
    */
    public function getBannerfacebookid()
    {
        return $this->bannerfacebookid;
    }
    
    /**
    * Set bannerfacebookid
    * @return $this
    */
    public function setBannerfacebookid($bannerfacebookid)
    {
        $this->bannerfacebookid = $bannerfacebookid;
        return $this;
    }

    /**
    * Get nativefacebookid
    * @return  
    */
    public function getNativefacebookid()
    {
        return $this->nativefacebookid;
    }
    
    /**
    * Set nativefacebookid
    * @return $this
    */
    public function setNativefacebookid($nativefacebookid)
    {
        $this->nativefacebookid = $nativefacebookid;
        return $this;
    }

    /**
    * Get nativeadmobid
    * @return  
    */
    public function getNativeadmobid()
    {
        return $this->nativeadmobid;
    }
    
    /**
    * Set nativeadmobid
    * @return $this
    */
    public function setNativeadmobid($nativeadmobid)
    {
        $this->nativeadmobid = $nativeadmobid;
        return $this;
    }

    /**
    * Get interstitialfacebookid
    * @return  
    */
    public function getInterstitialfacebookid()
    {
        return $this->interstitialfacebookid;
    }
    
    /**
    * Set interstitialfacebookid
    * @return $this
    */
    public function setInterstitialfacebookid($interstitialfacebookid)
    {
        $this->interstitialfacebookid = $interstitialfacebookid;
        return $this;
    }

    /**
    * Get interstitialadmobid
    * @return  
    */
    public function getInterstitialadmobid()
    {
        return $this->interstitialadmobid;
    }
    
    /**
    * Set interstitialadmobid
    * @return $this
    */
    public function setInterstitialadmobid($interstitialadmobid)
    {
        $this->interstitialadmobid = $interstitialadmobid;
        return $this;
    }

    /**
    * Get bannertype
    * @return  
    */
    public function getBannertype()
    {
        return $this->bannertype;
    }
    
    /**
    * Set bannertype
    * @return $this
    */
    public function setBannertype($bannertype)
    {
        $this->bannertype = $bannertype;
        return $this;
    }

    /**
    * Get interstitialtype
    * @return  
    */
    public function getInterstitialtype()
    {
        return $this->interstitialtype;
    }
    
    /**
    * Set interstitialtype
    * @return $this
    */
    public function setInterstitialtype($interstitialtype)
    {
        $this->interstitialtype = $interstitialtype;
        return $this;
    }

    /**
    * Get nativetype
    * @return  
    */
    public function getNativetype()
    {
        return $this->nativetype;
    }
    
    /**
    * Set nativetype
    * @return $this
    */
    public function setNativetype($nativetype)
    {
        $this->nativetype = $nativetype;
        return $this;
    }

    /**
    * Get interstitialclick
    * @return  
    */
    public function getInterstitialclick()
    {
        return $this->interstitialclick;
    }
    
    /**
    * Set interstitialclick
    * @return $this
    */
    public function setInterstitialclick($interstitialclick)
    {
        $this->interstitialclick = $interstitialclick;
        return $this;
    }

    /**
    * Get nativeitem
    * @return  
    */
    public function getNativeitem()
    {
        return $this->nativeitem;
    }
    
    /**
    * Set nativeitem
    * @return $this
    */
    public function setNativeitem($nativeitem)
    {
        $this->nativeitem = $nativeitem;
        return $this;
    }

    /**
    * Get rewardedadmobid
    * @return  
    */
    public function getRewardedadmobid()
    {
        return $this->rewardedadmobid;
    }
    
    /**
    * Set rewardedadmobid
    * @return $this
    */
    public function setRewardedadmobid($rewardedadmobid)
    {
        $this->rewardedadmobid = $rewardedadmobid;
        return $this;
    }

    /**
    * Get nativebannerfacebookid
    * @return  
    */
    public function getNativebannerfacebookid()
    {
        return $this->nativebannerfacebookid;
    }
    
    /**
    * Set nativebannerfacebookid
    * @return $this
    */
    public function setNativebannerfacebookid($nativebannerfacebookid)
    {
        $this->nativebannerfacebookid = $nativebannerfacebookid;
        return $this;
    }

    /**
    * Get publisherid
    * @return  
    */
    public function getPublisherid()
    {
        return $this->publisherid;
    }
    
    /**
    * Set publisherid
    * @return $this
    */
    public function setPublisherid($publisherid)
    {
        $this->publisherid = $publisherid;
        return $this;
    }

    /**
    * Get appid
    * @return  
    */
    public function getAppid()
    {
        return $this->appid;
    }
    
    /**
    * Set appid
    * @return $this
    */
    public function setAppid($appid)
    {
        $this->appid = $appid;
        return $this;
    }

    /**
    * Get rewardedtype - Rewarded waterfall primary network
    */
    public function getRewardedtype()
    {
        return $this->rewardedtype;
    }

    /**
    * Set rewardedtype
    * @return $this
    */
    public function setRewardedtype($rewardedtype)
    {
        $this->rewardedtype = $rewardedtype;
        return $this;
    }

    /**
    * Get bannermaxid - AppLovin MAX banner unit id
    */
    public function getBannermaxid()
    {
        return $this->bannermaxid;
    }

    /**
    * Set bannermaxid
    * @return $this
    */
    public function setBannermaxid($bannermaxid)
    {
        $this->bannermaxid = $bannermaxid;
        return $this;
    }

    /**
    * Get bannerapplovinid - AppLovin direct banner zone id
    */
    public function getBannerapplovinid()
    {
        return $this->bannerapplovinid;
    }

    /**
    * Set bannerapplovinid
    * @return $this
    */
    public function setBannerapplovinid($bannerapplovinid)
    {
        $this->bannerapplovinid = $bannerapplovinid;
        return $this;
    }

    /**
    * Get bannerunityid - Unity Ads banner placement id
    */
    public function getBannerunityid()
    {
        return $this->bannerunityid;
    }

    /**
    * Set bannerunityid
    * @return $this
    */
    public function setBannerunityid($bannerunityid)
    {
        $this->bannerunityid = $bannerunityid;
        return $this;
    }

    /**
    * Get bannerorder - Banner waterfall order, e.g. ADMOB,MAX,FACEBOOK,UNITY
    */
    public function getBannerorder()
    {
        return $this->bannerorder;
    }

    /**
    * Set bannerorder
    * @return $this
    */
    public function setBannerorder($bannerorder)
    {
        $this->bannerorder = $bannerorder;
        return $this;
    }

    /**
    * Get nativemaxid - AppLovin MAX native unit id
    */
    public function getNativemaxid()
    {
        return $this->nativemaxid;
    }

    /**
    * Set nativemaxid
    * @return $this
    */
    public function setNativemaxid($nativemaxid)
    {
        $this->nativemaxid = $nativemaxid;
        return $this;
    }

    /**
    * Get nativeorder - Native waterfall order
    */
    public function getNativeorder()
    {
        return $this->nativeorder;
    }

    /**
    * Set nativeorder
    * @return $this
    */
    public function setNativeorder($nativeorder)
    {
        $this->nativeorder = $nativeorder;
        return $this;
    }

    /**
    * Get interstitialmaxid - AppLovin MAX interstitial unit id
    */
    public function getInterstitialmaxid()
    {
        return $this->interstitialmaxid;
    }

    /**
    * Set interstitialmaxid
    * @return $this
    */
    public function setInterstitialmaxid($interstitialmaxid)
    {
        $this->interstitialmaxid = $interstitialmaxid;
        return $this;
    }

    /**
    * Get interstitialapplovinid - AppLovin direct interstitial zone id
    */
    public function getInterstitialapplovinid()
    {
        return $this->interstitialapplovinid;
    }

    /**
    * Set interstitialapplovinid
    * @return $this
    */
    public function setInterstitialapplovinid($interstitialapplovinid)
    {
        $this->interstitialapplovinid = $interstitialapplovinid;
        return $this;
    }

    /**
    * Get interstitialunityid - Unity Ads interstitial placement id
    */
    public function getInterstitialunityid()
    {
        return $this->interstitialunityid;
    }

    /**
    * Set interstitialunityid
    * @return $this
    */
    public function setInterstitialunityid($interstitialunityid)
    {
        $this->interstitialunityid = $interstitialunityid;
        return $this;
    }

    /**
    * Get interstitialorder - Interstitial waterfall order
    */
    public function getInterstitialorder()
    {
        return $this->interstitialorder;
    }

    /**
    * Set interstitialorder
    * @return $this
    */
    public function setInterstitialorder($interstitialorder)
    {
        $this->interstitialorder = $interstitialorder;
        return $this;
    }

    /**
    * Get rewardedmaxid - AppLovin MAX rewarded unit id
    */
    public function getRewardedmaxid()
    {
        return $this->rewardedmaxid;
    }

    /**
    * Set rewardedmaxid
    * @return $this
    */
    public function setRewardedmaxid($rewardedmaxid)
    {
        $this->rewardedmaxid = $rewardedmaxid;
        return $this;
    }

    /**
    * Get rewardedapplovinid - AppLovin direct rewarded zone id
    */
    public function getRewardedapplovinid()
    {
        return $this->rewardedapplovinid;
    }

    /**
    * Set rewardedapplovinid
    * @return $this
    */
    public function setRewardedapplovinid($rewardedapplovinid)
    {
        $this->rewardedapplovinid = $rewardedapplovinid;
        return $this;
    }

    /**
    * Get rewardedfacebookid - Meta Audience Network rewarded placement id
    */
    public function getRewardedfacebookid()
    {
        return $this->rewardedfacebookid;
    }

    /**
    * Set rewardedfacebookid
    * @return $this
    */
    public function setRewardedfacebookid($rewardedfacebookid)
    {
        $this->rewardedfacebookid = $rewardedfacebookid;
        return $this;
    }

    /**
    * Get rewardedunityid - Unity Ads rewarded placement id
    */
    public function getRewardedunityid()
    {
        return $this->rewardedunityid;
    }

    /**
    * Set rewardedunityid
    * @return $this
    */
    public function setRewardedunityid($rewardedunityid)
    {
        $this->rewardedunityid = $rewardedunityid;
        return $this;
    }

    /**
    * Get rewardedorder - Rewarded waterfall order
    */
    public function getRewardedorder()
    {
        return $this->rewardedorder;
    }

    /**
    * Set rewardedorder
    * @return $this
    */
    public function setRewardedorder($rewardedorder)
    {
        $this->rewardedorder = $rewardedorder;
        return $this;
    }

    /**
    * Get unitygameid - Unity Ads game id
    */
    public function getUnitygameid()
    {
        return $this->unitygameid;
    }

    /**
    * Set unitygameid
    * @return $this
    */
    public function setUnitygameid($unitygameid)
    {
        $this->unitygameid = $unitygameid;
        return $this;
    }

    /**
    * Get adfallback - TRUE to try every configured network, FALSE for the listed ones only
    */
    public function getAdfallback()
    {
        return $this->adfallback;
    }

    /**
    * Set adfallback
    * @return $this
    */
    public function setAdfallback($adfallback)
    {
        $this->adfallback = $adfallback;
        return $this;
    }

    /**
    * Get adtimeout - Seconds to wait for one network before moving to the next
    */
    public function getAdtimeout()
    {
        return $this->adtimeout;
    }

    /**
    * Set adtimeout
    * @return $this
    */
    public function setAdtimeout($adtimeout)
    {
        $this->adtimeout = $adtimeout;
        return $this;
    }

    /**
    * Get vungleappid - Liftoff Monetize (Vungle) App id
    */
    public function getVungleappid()
    {
        return $this->vungleappid;
    }

    /**
    * Set vungleappid
    * @return $this
    */
    public function setVungleappid($vungleappid)
    {
        $this->vungleappid = $vungleappid;
        return $this;
    }

    /**
    * Get inmobiaccountid - InMobi Account id
    */
    public function getInmobiaccountid()
    {
        return $this->inmobiaccountid;
    }

    /**
    * Set inmobiaccountid
    * @return $this
    */
    public function setInmobiaccountid($inmobiaccountid)
    {
        $this->inmobiaccountid = $inmobiaccountid;
        return $this;
    }

    /**
    * Get bannervungleid - Vungle banner placement id
    */
    public function getBannervungleid()
    {
        return $this->bannervungleid;
    }

    /**
    * Set bannervungleid
    * @return $this
    */
    public function setBannervungleid($bannervungleid)
    {
        $this->bannervungleid = $bannervungleid;
        return $this;
    }

    /**
    * Get bannerinmobiid - InMobi banner placement id
    */
    public function getBannerinmobiid()
    {
        return $this->bannerinmobiid;
    }

    /**
    * Set bannerinmobiid
    * @return $this
    */
    public function setBannerinmobiid($bannerinmobiid)
    {
        $this->bannerinmobiid = $bannerinmobiid;
        return $this;
    }

    /**
    * Get interstitialvungleid - Vungle interstitial placement id
    */
    public function getInterstitialvungleid()
    {
        return $this->interstitialvungleid;
    }

    /**
    * Set interstitialvungleid
    * @return $this
    */
    public function setInterstitialvungleid($interstitialvungleid)
    {
        $this->interstitialvungleid = $interstitialvungleid;
        return $this;
    }

    /**
    * Get interstitialinmobiid - InMobi interstitial placement id
    */
    public function getInterstitialinmobiid()
    {
        return $this->interstitialinmobiid;
    }

    /**
    * Set interstitialinmobiid
    * @return $this
    */
    public function setInterstitialinmobiid($interstitialinmobiid)
    {
        $this->interstitialinmobiid = $interstitialinmobiid;
        return $this;
    }

    /**
    * Get rewardedvungleid - Vungle rewarded placement id
    */
    public function getRewardedvungleid()
    {
        return $this->rewardedvungleid;
    }

    /**
    * Set rewardedvungleid
    * @return $this
    */
    public function setRewardedvungleid($rewardedvungleid)
    {
        $this->rewardedvungleid = $rewardedvungleid;
        return $this;
    }

    /**
    * Get rewardedinmobiid - InMobi rewarded placement id
    */
    public function getRewardedinmobiid()
    {
        return $this->rewardedinmobiid;
    }

    /**
    * Set rewardedinmobiid
    * @return $this
    */
    public function setRewardedinmobiid($rewardedinmobiid)
    {
        $this->rewardedinmobiid = $rewardedinmobiid;
        return $this;
    }

    /**
    * Get nativevungleid
    */
    public function getNativevungleid()
    {
        return $this->nativevungleid;
    }

    /**
    * Set nativevungleid
    * @return $this
    */
    public function setNativevungleid($nativevungleid)
    {
        $this->nativevungleid = $nativevungleid;
        return $this;
    }

    /**
    * Get nativeinmobiid
    */
    public function getNativeinmobiid()
    {
        return $this->nativeinmobiid;
    }

    /**
    * Set nativeinmobiid
    * @return $this
    */
    public function setNativeinmobiid($nativeinmobiid)
    {
        $this->nativeinmobiid = $nativeinmobiid;
        return $this;
    }

    /**
    * Get reelsenabled - whether the app shows reels at all
    */
    public function getReelsenabled()
    {
        return $this->reelsenabled;
    }

    /**
    * Set reelsenabled
    * @return $this
    */
    public function setReelsenabled($reelsenabled)
    {
        $this->reelsenabled = $reelsenabled;
        return $this;
    }

    /**
    * Get manuallogin - email and password accounts offered in the app
    */
    public function getManuallogin()
    {
        return $this->manuallogin;
    }

    /**
    * Set manuallogin
    * @return $this
    */
    public function setManuallogin($manuallogin)
    {
        $this->manuallogin = $manuallogin;
        return $this;
    }

    /**
    * Get reelsautopublish
    */
    public function getReelsautopublish()
    {
        return $this->reelsautopublish;
    }

    /**
    * Set reelsautopublish
    * @return $this
    */
    public function setReelsautopublish($reelsautopublish)
    {
        $this->reelsautopublish = $reelsautopublish;
        return $this;
    }

    /** True when reels from the app should skip the review queue. */
    public function getReelsautopublishValue()
    {
        return strtoupper((string) $this->reelsautopublish) === 'TRUE';
    }

    /**
    * Get reelsnativeitem
    */
    public function getReelsnativeitem()
    {
        return $this->reelsnativeitem;
    }

    /**
    * Set reelsnativeitem
    * @return $this
    */
    public function setReelsnativeitem($reelsnativeitem)
    {
        $this->reelsnativeitem = $reelsnativeitem;
        return $this;
    }
}

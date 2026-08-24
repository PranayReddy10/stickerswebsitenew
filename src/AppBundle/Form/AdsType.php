<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AdsType extends AbstractType
{
    /**
     * Networks that can serve a full screen or banner placement.
     */
    private static function networkChoices($disabledLabel)
    {
        return array(
            "FALSE"    => $disabledLabel,
            "ADMOB"    => "Google AdMob",
            "MAX"      => "AppLovin MAX",
            "APPLOVIN" => "AppLovin (direct)",
            "FACEBOOK" => "Meta Audience Network",
            "UNITY"    => "Unity Ads",
        );
    }

    /**
     * Native ads are only offered by AdMob, MAX and Meta.
     */
    private static function nativeNetworkChoices()
    {
        return array(
            "FALSE"    => "Disable Native Ads",
            "ADMOB"    => "Google AdMob",
            "MAX"      => "AppLovin MAX",
            "FACEBOOK" => "Meta Audience Network",
        );
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // ------------------------------------------------------------ global
        $builder->add('publisherid', null, array("label" => "AdMob Publisher id", "required" => false));
        $builder->add('appid', null, array("label" => "AdMob App id", "required" => false));
        $builder->add('unitygameid', null, array(
            "label"    => "Unity Ads Game id",
            "required" => false,
            "attr"     => array("placeholder" => "Leave empty to disable Unity Ads completely"),
        ));
        $builder->add('adtimeout', null, array(
            "label"    => "Seconds to wait for a network before trying the next one",
            "required" => false,
            "attr"     => array("placeholder" => "10"),
        ));
        $builder->add('adfallback', ChoiceType::class, array(
            "label"    => "Automatic fallback",
            "required" => false,
            'choices'  => array(
                "TRUE"  => "Try every network that has an id (recommended)",
                "FALSE" => "Only use the networks listed in the order field",
            ),
        ));

        // ------------------------------------------------------------ banner
        $builder->add('bannertype', ChoiceType::class, array(
            "label"    => "Banner Ad Type",
            "required" => false,
            'choices'  => self::networkChoices("Disable Banner Ads"),
        ));
        $builder->add('banneradmobid', null, array("label" => "Banner - AdMob unit id", "required" => false));
        $builder->add('bannermaxid', null, array("label" => "Banner - AppLovin MAX unit id", "required" => false));
        $builder->add('bannerapplovinid', null, array("label" => "Banner - AppLovin zone id", "required" => false));
        $builder->add('bannerfacebookid', null, array("label" => "Banner - Meta placement id", "required" => false));
        $builder->add('bannerunityid', null, array("label" => "Banner - Unity placement id", "required" => false));
        $builder->add('bannerorder', null, array(
            "label"    => "Banner waterfall order",
            "required" => false,
            "attr"     => array("placeholder" => "ADMOB,MAX,FACEBOOK,UNITY"),
        ));

        // ------------------------------------------------------------ native
        $builder->add('nativetype', ChoiceType::class, array(
            "label"    => "Native Ad Type",
            "required" => false,
            'choices'  => self::nativeNetworkChoices(),
        ));
        $builder->add('nativeadmobid', null, array("label" => "Native - AdMob unit id", "required" => false));
        $builder->add('nativemaxid', null, array("label" => "Native - AppLovin MAX unit id", "required" => false));
        $builder->add('nativefacebookid', null, array("label" => "Native - Meta placement id", "required" => false));
        $builder->add('nativebannerfacebookid', null, array("label" => "Native banner - Meta placement id", "required" => false));
        $builder->add('nativeorder', null, array(
            "label"    => "Native waterfall order",
            "required" => false,
            "attr"     => array("placeholder" => "ADMOB,MAX,FACEBOOK"),
        ));
        $builder->add('nativeitem', null, array(
            "label"    => "Packs between two native ads in the lists",
            "required" => false,
            "attr"     => array("placeholder" => "3", "min" => 1),
        ));

        // ------------------------------------------------------ interstitial
        $builder->add('interstitialtype', ChoiceType::class, array(
            "label"    => "Interstitial (full screen) Ad Type",
            "required" => false,
            'choices'  => self::networkChoices("Disable Interstitial Ads"),
        ));
        $builder->add('interstitialadmobid', null, array("label" => "Interstitial - AdMob unit id", "required" => false));
        $builder->add('interstitialmaxid', null, array("label" => "Interstitial - AppLovin MAX unit id", "required" => false));
        $builder->add('interstitialapplovinid', null, array("label" => "Interstitial - AppLovin zone id", "required" => false));
        $builder->add('interstitialfacebookid', null, array("label" => "Interstitial - Meta placement id", "required" => false));
        $builder->add('interstitialunityid', null, array("label" => "Interstitial - Unity placement id", "required" => false));
        $builder->add('interstitialorder', null, array(
            "label"    => "Interstitial waterfall order",
            "required" => false,
            "attr"     => array("placeholder" => "ADMOB,MAX,FACEBOOK,UNITY"),
        ));
        $builder->add('interstitialclick', null, array(
            "label"    => "Clicks between two interstitials",
            "required" => false,
            "attr"     => array("placeholder" => "3", "min" => 0),
        ));

        // ---------------------------------------------------------- rewarded
        $builder->add('rewardedtype', ChoiceType::class, array(
            "label"    => "Rewarded Ad Type",
            "required" => false,
            'choices'  => self::networkChoices("Disable Rewarded Ads"),
        ));
        $builder->add('rewardedadmobid', null, array("label" => "Rewarded - AdMob unit id", "required" => false));
        $builder->add('rewardedmaxid', null, array("label" => "Rewarded - AppLovin MAX unit id", "required" => false));
        $builder->add('rewardedapplovinid', null, array("label" => "Rewarded - AppLovin zone id", "required" => false));
        $builder->add('rewardedfacebookid', null, array("label" => "Rewarded - Meta placement id", "required" => false));
        $builder->add('rewardedunityid', null, array("label" => "Rewarded - Unity placement id", "required" => false));
        $builder->add('rewardedorder', null, array(
            "label"    => "Rewarded waterfall order",
            "required" => false,
            "attr"     => array("placeholder" => "ADMOB,MAX,FACEBOOK,UNITY"),
        ));

        // ------------------------------------------------- download placement
        $builder->add('downloadadtype', ChoiceType::class, array(
            "label"    => "Ad shown when a free pack is added to WhatsApp / Telegram / Signal",
            "required" => false,
            'choices'  => array(
                "FALSE"        => "No ad",
                "INTERSTITIAL" => "Full screen ad, pack is added either way",
                "REWARDED"     => "Rewarded video, the user has to watch it to get the pack",
            ),
        ));

        $builder->add('save', 'submit', array("label" => "SAVE"));
    }

    public function getName()
    {
        return 'Ads';
    }
}

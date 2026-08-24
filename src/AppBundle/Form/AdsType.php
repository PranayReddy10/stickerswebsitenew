<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
class AdsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder->add('publisherid',null,array("label"=>" Publisher id"));
        $builder->add('appid',null,array("label"=>" App id"));

        $builder->add('bannerfacebookid',ChoiceType::class, array(
                "label"=>"Rewarded Ad Type",
                'choices' => array(
                   "FALSE"=> "Disable Ad Rewarded",
                     "ADMOB"=>"Google AdMob Ad Rewarded" ,
                    "MAX"=>"AppLovin Max Ad Rewarded" ,
                    "APPLOVIN"=>"AppLovin Ad Rewarded" ,
                     "IS" => "ironSource Ad Rewarded" 
                )));

        $builder->add('rewardedadmobid',null,array("label"=>" Rewarded ID "));
        $builder->add('banneradmobid',null,array("label"=>" Banner ID "));
        $builder->add('bannertype',ChoiceType::class, array(
                "label"=>"Banner Ad Type",
                'choices' => array(
                    "FALSE" => "Disable Ad Banner",
                    "ADMOB" => "Google AdMob Ad Banner",
                    "MAX" => "AppLovin Max Ad Banner",
                    "APPLOVIN" => "AppLovin Ad Banner",
                    "IS" => "ironSource Ad Banner" 
                )));
        $builder->add('nativeadmobid',null,array("label"=>" Native ID "));
        $builder->add('nativetype',ChoiceType::class, array(
                "label"=>"Native Ad Type",
                'choices' => array(
                    "FALSE" => "Disable Ad Native",
                    "ADMOB" => "Google AdMob Ad Native",
                    "MAX" => "AppLovin Max  Ad Native"
                )));
        $builder->add('nativeitem',null,array("label"=>"Native Ad Type "));
        $builder->add('interstitialadmobid',null,array("label"=>" Interstitial ID "));
        $builder->add('interstitialtype',ChoiceType::class, array(
                "label"=>"Interstitial Ad Type",
                'choices' => array(
                    "FALSE" => "Disable Ad Interstitial",
                    "ADMOB" => "Google AdMob Ad Interstitial",
                    "MAX" => "AppLovin Max Ad Interstitial",
                    "APPLOVIN" => "AppLovin Ad Interstitial",
                    "IS" => "ironSource Ad Interstitial" 
                )));    
        $builder->add('interstitialclick',null,array("label"=>"Interstitial Ad Type "));

        $builder->add('save', 'submit',array("label"=>"SAVE"));
    }
    public function getName()
    {
        return 'Ads';
    }
}
?>


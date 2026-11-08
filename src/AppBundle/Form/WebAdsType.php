<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Ads on the public website: the network's code, or your own banner.
 */
class WebAdsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('webadsenabled', ChoiceType::class, array(
            "label" => "Ads on the website",
            "required" => false,
            'choices' => array(
                "TRUE" => "On - the pack and reel pages can carry ads",
                "FALSE" => "Off - nothing is rendered, whatever is saved below",
            ),
        ));

        $builder->add('webadshead', TextareaType::class, array(
            "label" => "Code for the page head",
            "required" => false,
            "attr" => array(
                "rows" => 4,
                "placeholder" => "The loader script your ad network gave you, if it has one",
            ),
        ));

        $builder->add('webadstop', TextareaType::class, array(
            "label" => "Above the grid",
            "required" => false,
            "attr" => array("rows" => 4, "placeholder" => "Leave empty to use your own banner here"),
        ));

        $builder->add('webadsfeed', TextareaType::class, array(
            "label" => "Inside the grid",
            "required" => false,
            "attr" => array("rows" => 4, "placeholder" => "Leave empty to use your own banner here"),
        ));

        $builder->add('webadsbottom', TextareaType::class, array(
            "label" => "Below the grid",
            "required" => false,
            "attr" => array("rows" => 4, "placeholder" => "Leave empty to use your own banner here"),
        ));

        $builder->add('webadsevery', IntegerType::class, array(
            "label" => "Packs or reels between in-grid ads",
            "required" => false,
            "attr" => array("placeholder" => "8"),
        ));

        $builder->add('webadsbannerfile', 'file', array(
            "label" => "",
            "required" => false,
        ));

        $builder->add('webadsreelbannerfile', 'file', array(
            "label" => "",
            "required" => false,
        ));

        $builder->add('webadsbannerurl', TextType::class, array(
            "label" => "Where the banner goes",
            "required" => false,
            "attr" => array("placeholder" => "https://example.com/"),
        ));

        $builder->add('webadsbannertext', TextType::class, array(
            "label" => "Line under the banner",
            "required" => false,
            "attr" => array("placeholder" => "Optional"),
        ));

        $builder->add('save', 'submit', array("label" => "SAVE"));
    }

    public function getName()
    {
        return 'webads';
    }
}

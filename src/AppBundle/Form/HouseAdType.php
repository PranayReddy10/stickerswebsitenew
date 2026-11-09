<?php

namespace AppBundle\Form;

use AppBundle\Entity\HouseAd;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/** One ad of your own. */
class HouseAdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('format', ChoiceType::class, array(
            "label" => "Where it goes",
            "choices" => array_flip(HouseAd::formats()),
        ));
        $builder->add('title', TextType::class, array(
            "label" => "Headline",
            "required" => false,
            "attr" => array("placeholder" => "Needed for a native ad; ignored by the others"),
        ));
        $builder->add('body', TextType::class, array(
            "label" => "Line under it",
            "required" => false,
        ));
        $builder->add('cta', TextType::class, array(
            "label" => "Button",
            "required" => false,
            "attr" => array("placeholder" => "Open"),
        ));
        $builder->add('imagefile', 'file', array(
            "label" => "",
            "required" => false,
        ));
        $builder->add('url', TextType::class, array(
            "label" => "Where tapping it goes",
            "required" => false,
            "attr" => array("placeholder" => "https://play.google.com/store/apps/details?id=..."),
        ));
        $builder->add('weight', IntegerType::class, array(
            "label" => "Share of the slots",
            "required" => false,
        ));
        // Guessed from the entity, the way every other form here does booleans.
        $builder->add('enabled', null, array("label" => "Live", "required" => false));
        $builder->add('save', 'submit', array("label" => "SAVE"));
    }

    public function getName()
    {
        return 'housead';
    }
}

<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * The website's own name, description and logo.
 *
 * <p>Separate from the app's: an app is called "Kissing Stickers", a page in a
 * search result wants "Kissing Stickers - free WhatsApp sticker packs". Both
 * fall back to the app's own when left empty, so a site works without touching
 * any of this.
 */
class SiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('sitename', null, array(
            "label" => "Site name",
            "required" => false,
        ));
        $builder->add('sitedescription', null, array(
            "label" => "Description",
            "required" => false,
        ));
        $builder->add('sitekeywords', null, array(
            "label" => "Keywords",
            "required" => false,
        ));
        $builder->add('siteenabled', ChoiceType::class, array(
            "label" => "The website",
            "required" => false,
            'choices' => array(
                "TRUE" => "On - packs and reels have pages anyone can open",
                "FALSE" => "Off - everything outside the panel answers 404",
            ),
        ));
        $builder->add('logofile', 'file', array(
            "label" => "",
            "required" => false,
        ));
        $builder->add('save', 'submit', array("label" => "SAVE"));
    }

    public function getName()
    {
        return 'Site';
    }
}

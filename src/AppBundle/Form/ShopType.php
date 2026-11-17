<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * The shop: whether it is on, whether the app shows a button, and how to reach it.
 */
class ShopType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('shopenabled', ChoiceType::class, array(
            "label" => "The shop",
            "required" => false,
            'choices' => array(
                "TRUE" => "On - the app and the website can use the shop",
                "FALSE" => "Off - nothing about the shop reaches anybody",
            ),
        ));
        $builder->add('shopbutton', ChoiceType::class, array(
            "label" => "Shop button in the app",
            "required" => false,
            'choices' => array(
                "TRUE" => "Show it in the app's menu",
                "FALSE" => "Hide it",
            ),
        ));
        $builder->add('shopname', null, array(
            "label" => "What the button says",
            "required" => false,
        ));
        $builder->add('shopurl', null, array(
            "label" => "Shop website",
            "required" => false,
        ));
        $builder->add('shopapiurl', null, array(
            "label" => "Products endpoint",
            "required" => false,
        ));
        // Not rendered back into the page: a key that is printed into HTML is a key
        // in every browser cache and every screen share. Empty leaves it unchanged.
        $builder->add('shopapikey', PasswordType::class, array(
            "label" => "API key",
            "required" => false,
            "always_empty" => true,
            "mapped" => false,
        ));
        $builder->add('save', 'submit', array("label" => "SAVE"));
    }

    public function getName()
    {
        return 'Shop';
    }
}

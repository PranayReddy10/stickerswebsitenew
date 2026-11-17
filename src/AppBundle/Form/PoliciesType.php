<?php

namespace AppBundle\Form;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * The three documents an app has to be able to point at.
 *
 * <p>Each one is a page anybody can open without the app, which is the point:
 * Play asks for the privacy policy and, for any app with accounts, an address
 * where somebody can find out how to delete theirs.
 */
class PoliciesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        foreach (array('privacypolicy', 'deleteaccount', 'terms') as $field) {
            $builder->add($field, CKEditorType::class, array(
                'label' => '',
                'required' => false,
                'config_name' => 'user_config',
            ));
        }
        $builder->add('save', 'submit', array('label' => 'SAVE'));
    }

    public function getName()
    {
        return 'Policies';
    }
}

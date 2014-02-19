<?php

namespace VICTORVIS\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ResettingFormType as BaseType;

class ResettingFormType extends BaseType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        
        $builder->add('plainPassword', 'repeated', array(
            'type' => 'password',
            'options' => array('attr' => array('class' => 'form-control'), 'translation_domain' => 'FOSUserBundle'),
            'first_options' => array('label' => 'form.new_password'),
            'second_options' => array('label' => 'form.new_password_confirmation'),
            'invalid_message' => 'fos_user.password.mismatch',
        ));
    }

    public function getName()
    {
        return 'victorvis_user_resetting';
    }
}

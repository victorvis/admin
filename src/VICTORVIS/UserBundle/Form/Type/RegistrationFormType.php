<?php

namespace VICTORVIS\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('firstName', 'text', array('label' => 'form.firstName', 'translation_domain' => 'FOSUserBundle'));
        $builder->add('surname', 'text', array('label' => 'form.surname', 'translation_domain' => 'FOSUserBundle'));
        $builder->add('cep', null, array('required' => false, 'label' => 'form.cep', 'translation_domain' => 'FOSUserBundle'));
        $builder->add('birthdate', 'birthday', array(
            'required' => false,
            'format' => 'dd MMMM yyyy',
            'widget' => 'single_text',
            'label' => 'form.birthdate', 
            'translation_domain' => 'FOSUserBundle')
        );
        $builder->add('plainPassword', 'repeated', array(
            'type' => 'password',
            'options' => array('attr' => array('class' => 'form-control input-sm'), 'translation_domain' => 'FOSUserBundle'),
            'first_options' => array('label' => 'form.password'),
            'second_options' => array('label' => 'form.password_confirmation'),
            'invalid_message' => 'fos_user.password.mismatch',
        ));
    }

    public function getName()
    {
        return 'victorvis_user_registration';
    }

}

<?php

namespace PiggyBox\UserBundle\Form;

use Symfony\Component\Form\FormBuilder;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class MerchantType extends BaseType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('username')
            ->add('email')
            ->add('emailCanonical')
            ->add('roles')
            ->add('merchant_type')
            ->add('merchant_name')
            ->add('street_address')
            ->add('country')
            ->add('postal_code')
            ->add('steet_number')
            ->add('phone')
            ->add('user_name')
        ;
    }

    public function getName()
    {
        return 'piggybox_userbundle_merchanttype';
    }
}
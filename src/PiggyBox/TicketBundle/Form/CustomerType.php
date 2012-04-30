<?php

namespace PiggyBox\TicketBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('email')
            ->add('phone')
            ->add('comment')
            ->add('createdat')
            ->add('modifiedat')
        ;
    }

    public function getName()
    {
        return 'piggybox_ticketbundle_customertype';
    }
}

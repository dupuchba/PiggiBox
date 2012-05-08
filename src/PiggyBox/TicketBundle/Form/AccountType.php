<?php

namespace PiggyBox\TicketBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class AccountType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('balance')
            ->add('ticket_value')
            ->add('customer')
        ;
    }

    public function getName()
    {
        return 'piggybox_ticketbundle_accounttype';
    }
}

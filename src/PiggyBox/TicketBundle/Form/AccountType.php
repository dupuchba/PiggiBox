<?php

namespace PiggyBox\TicketBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class AccountType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('ticket_value', 'text', array(
                'label'        => 'Valeur d\'un ticket',
                'help_block'  => 'Entrez la valeur d\'un ticket restaurant du client afin de simplifier votre utilisation',
                'widget_addon' => array(
                        'text' => '€'
                ),
                'attr' => array(
                    'class' => 'input-small',
                )
            ))
            ->add('balance', 'text', array(
                'label'        => 'Solde',
                'help_block'   => 'Entrez le solde actuel du client',
                'widget_addon' => array(
                        'text' => '€'
                ),
                'attr' => array(
                    'class' => 'input-small',
                )
            ))
        ;
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'PiggyBox\TicketBundle\Entity\Account',
        );
    }

    public function getName()
    {
        return 'piggybox_ticketbundle_accounttype';
    }
}

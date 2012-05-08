<?php

namespace PiggyBox\TicketBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('lastname', 'text', array(
                'label'        => 'Nom',
                'widget_addon' => array(
                        'icon' => 'user'
                ),
                'attr' => array(
                    'class' => 'span3',
                )
            ))
            ->add('firstname', 'text', array(
                'label'        => 'Prénom',
                'widget_addon' => array(
                        'icon' => 'user'
                ),
                'attr' => array(
                    'class' => 'span3',
                )
            ))            
            ->add('email', 'email', array(
                'widget_addon' => array(
                        'icon' => 'envelope'
                ),
                'attr' => array(
                    'class' => 'span3',
                )
            ))
            ->add('phone', 'text', array(
                'label'        => 'Téléphone',
                'widget_addon' => array(
                        'text' => '&#9742;'
                ),
                'attr' => array(
                    'class' => 'span3',
                )
            ))           
            ->add('comment','textarea', array(
                'label'         => 'Commentaire'
                ))
            ->add('accounts', 'collection', array(
                'label_render' => false,
                'type' => new AccountType()
                ))
        ;

        
    }

    public function getName()
    {
        return 'piggybox_ticketbundle_customertype';
    }
}

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
                    'class' => 'span3'
                ),
                'required'  => false
            ))
            ->add('phone', 'text', array(
                'label'        => 'Téléphone',
                'widget_addon' => array(
                        'text' => '&#9742;'
                ),
                'attr' => array(
                    'class' => 'span3'
                ),
                'required'  => false
            ))           
            ->add('comment','textarea', array(
                'label'         => 'Commentaire',
                'required'  => false
                ))
        ;

        
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'PiggyBox\TicketBundle\Entity\Customer',
        );
    }

    public function getName()
    {
        return 'customer';
    }
}

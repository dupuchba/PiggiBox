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
            ->add('merchant_lastname', 'text', array(
                    'label'        => 'Votre Nom',
                    'widget_addon' => array(
                            'icon' => 'user'
                    ),
                    'attr' => array(
                        'class' => 'input-xlarge',
                    )
                ))
            ->add('merchant_firstname', 'text', array(
                    'label'        => 'Votre Prénom',
                    'widget_addon' => array(
                            'icon' => 'user'
                    ),
                    'attr' => array(
                        'class' => 'input-xlarge',
                    )
                ))
            ->add('username')
            ->add('plainPassword', 'repeated',array('type' => 'password'), array(
                    'label'        => 'Votre mot de passe',
                    'widget_addon' => array(
                            'icon' => 'lock'
                    ),
                    'attr' => array(
                        'class' => 'input-xlarge',
                    )
                    ))
            ->add('shop_name', 'text', array(
                    'label'        => 'Nom de votre boutique',
                    'widget_addon' => array(
                            'icon' => 'home'
                    ),
                    'attr' => array(
                        'class' => 'input-xlarge',
                    )
            ))        
            ->add('shop_name', 'text', array(
                    'label'        => 'Nom de votre boutique',
                    'widget_addon' => array(
                            'icon' => 'home'
                    ),
                    'attr' => array(
                        'class' => 'input-xlarge',
                    ) 
            ))               
            ->add('email', 'email', array(
                'widget_addon' => array(
                        'icon' => 'envelope'
                ),
                'attr' => array(
                    'class' => 'input-xlarge',
                )
            ))        
            ->add('phone', 'text', array(
                'label'        => 'Téléphone',
                'widget_addon' => array(
                        'text' => '&#9742;'
                ),
                'attr' => array(
                    'class' => 'input-xlarge',
                )
            ))
            ->add('street_number', 'text', array(
                'label'        => 'Adresse',
                'widget_addon' => array(
                        'text' => 'N°'
                ),
                'attr' => array(
                    'class' => 'span1',
                )
            ))
            ->add('street_name', 'text', array(
                'label_render'        => false,
                'widget_addon' => array(
                        'text' => 'Rue'
                ),
                'widget_type'  => "inline",
                'attr' => array(
                    'class' => 'span4',
                )
            ))
            ->add('zipcode')
            ->add('city')
            ->add('shop_type')
        ;
    }

    public function getName()
    {
        return 'piggybox_userbundle_merchanttype';
    }
}
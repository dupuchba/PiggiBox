<?php

namespace PiggyBox\TicketBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CustomerSearchType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('keyword', 'text', array(
                'label_render'        => false,
                'attr' => array(
                    'class' => 'span4',
                    'autocomplete' => 'off',
                    'data-provide' => 'typeahead'
                )
            ));
    }

    public function getName()
    {
        return 'customersearch';
    }
}

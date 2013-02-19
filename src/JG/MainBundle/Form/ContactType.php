<?php

namespace JG\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', 'email', array('required' => true));
        $builder->add('name', 'text', array('required' => true));
        $builder->add('phone', 'text', array('required' => false, 'label' => "Phone Number (optional)"));
        $builder->add('message', 'textarea', array('required' => true));
    }

    public function getName()
    {
        return 'contact';
    }
}

<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;



class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('sexe', ChoiceType::class, array('choices' => array('Madame' => 'Madame', 'Monsieur' => 'Monsieur'),))

        ->add('firstname',  TextType::class, array('label'=> 'Prenom','attr' => array('class' => 'form-control')))
        ->add('lastname',  TextType::class, array('label'=> 'Nom','attr' => array('class' => 'form-control')))
        ->add('address',  TextType::class, array('label'=> 'Adresse','attr' => array('class' => 'form-control')))
         ->add('zipcode',  NumberType::class, array('label'=> 'code postal','attr' => array('class' => 'form-control')))
         ->add('city',  TextType::class, array('label'=> 'ville','attr' => array('class' => 'form-control')))
         ->add('country',  TextType::class, array('label'=> 'pays','attr' => array('class' => 'form-control')));

    }

    public function getParent()
    {
         return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }

     public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

}
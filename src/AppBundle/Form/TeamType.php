<?php

namespace AppBundle\Form;

use AppBundle\Entity\League;
use AppBundle\Entity\Sport;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
class TeamType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        
->add('imageFile', FileType::class, array('label'=> 'Image du produit', 'attr' => array('class' => 'form-control')))
        ->add('libelle',  TextType::class, array('label'=> 'Equipe','attr' => array('class' => 'form-control')))
         ->add('commentaire',     TextareaType::class, array('attr' => array('class' => 'form-control')))


      ->add('league', EntityType::class, array(
      'class'=> 'AppBundle\Entity\League',
      'choice_label'=>'libelle',
      'expanded'=>false,
      'multiple'=>false,'attr' => array('class' => 'form-control select2') ))

      

        ->add('save', SubmitType::class, array('label'=> 'envoyer','attr' =>array('class' => 'btn btn-default')));
}


    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Team'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_team';
    }


}

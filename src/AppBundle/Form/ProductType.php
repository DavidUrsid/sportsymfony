<?php

namespace AppBundle\Form;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Team;
use AppBundle\Entity\Category;
use AppBundle\Entity\Size;
use AppBundle\Entity\Player;

class ProductType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('description',     TextType::class, array('label'=> 'Description du produit', 'attr' => array('class' => 'form-control')))
        ->add('commentaire',     TextareaType::class, array('attr' => array('class' => 'form-control')))
        ->add('imageFile', FileType::class, array('label'=> 'Image du produit', 'attr' => array('class' => 'form-control')))

        ->add('player', EntityType::class, array(
            'class'=> 'AppBundle\Entity\Player',
        'placeholder' => 'Choisir un joueur',
        
        'choice_label'=>'libelle',
        'expanded'=>false,
        'multiple'=>false, 'label'=> 'Jouer','attr' => array('class' => 'form-control select2') ))
        

        ->add('team', EntityType::class, array(
        'class'=> 'AppBundle\Entity\Team',
        'choice_label'=>'libelle',
        'expanded'=>false,
        'multiple'=>false, 'label'=> 'Equipe','attr' => array('class' => 'form-control select2') ))

        ->add('category', EntityType::class, array(
        'class'=> 'AppBundle\Entity\Category',
        'choice_label'=>'libelle',
        'expanded'=>false,
        'multiple'=>false,'label'=> 'Categorie du produit','attr' => array('class' => 'form-control select2') ))

        ->add('prix',     IntegerType::class, array('label'=> 'Prix €','attr' => array('class' => 'form-control')))
        ->add('save', SubmitType::class, array('label'=> 'envoyer','attr' =>array('class' => 'btn btn-default')));


    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Product'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_product';
    }


}

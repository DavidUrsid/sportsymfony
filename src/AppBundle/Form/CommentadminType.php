<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use AppBundle\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class CommentadminType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $product_id=$options['product_id'];





        $builder




      ->add('product', EntityType::class, array(
        'class'=> 'AppBundle\Entity\Product',
          'choice_label' => 'description',
          'expanded'=>false,
          'multiple'=>false,'attr' => array('class' => 'form-control select2') ))

         ->add('note', ChoiceType::class, array(
                'choices'  => array(
                        '1' => 1,
                        '2' => 2,
                        '3' => 3,
                        '4' => 4,
                        '5' => 5
    )))

        ->add('comment',     TextareaType::class, array('label'=>'Commentaire', 'attr' => array('class' => 'form-control')))
        ->add('save', SubmitType::class, array('label'=> 'envoyer','attr' =>array('class' => 'btn btn-default')));

        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Comment',
              'product_id' => 'product_id'
            
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_comment';
    }


}

<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\SizeProduct;
    
use Doctrine\ORM\EntityRepository;

class PanierType extends AbstractType
{    

   
  
    
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        
$product_id=$options['product_id'];

        $builder
       ->add('size', EntityType::class, array(
            'label' => 'Taille',
            'class' => 'AppBundle:SizeProduct',
            'expanded'=>false,
            'choice_label'=>'size',
            'query_builder' => function(EntityRepository $repo) use($product_id) {
                return $repo->findByProduct($product_id);
            }
            ))
        ->add('quantity', ChoiceType::class, array(
    'choices'  => array(
        '1' => 1,
        '2' => 2,
        '3' => 3,
        '4' => 4,
        '5' => 5
    )))

      
 





        ->add('save', SubmitType::class, array('label'=> 'envoyer','attr' =>array('class' => 'btn btn-default')));
        
        
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Panier',
            'product_id' => 'product_id',
            'panier' => 'panier'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_panier';
    }


}

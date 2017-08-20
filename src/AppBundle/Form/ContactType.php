<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use AppBundle\Entity\Contact;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ContactType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {







        $builder
        ->add('email',     EmailType::class, array('label'=>'Votre adresse email', 'attr' => array('class' => 'form-control')))

        ->add('message',     TextareaType::class, array('label'=>'Commentaire', 'attr' => array('class' => 'form-control')))
        ->add('save', SubmitType::class, array('label'=> 'envoyer','attr' =>array('class' => 'btn btn-default')));

        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Contact'
            
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_contact';
    }


}

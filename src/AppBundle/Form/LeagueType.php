<?php

namespace AppBundle\Form;
use AppBundle\Entity\League;
use AppBundle\Entity\Sport;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class LeagueType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('imageFile', FileType::class, array('label'=> 'Logo de la ligue', 'attr' => array('class' => 'form-control')))
        ->add('libelle',  TextType::class, array('label'=> 'Ligue','attr' => array('class' => 'form-control')))
         ->add('commentaire',     TextareaType::class, array('attr' => array('class' => 'form-control')))


->add('sport', EntityType::class, array(
'class'=> 'AppBundle\Entity\Sport',
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
            'data_class' => 'AppBundle\Entity\League'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'sport_usersbundle_league';
    }

    protected function buildChoices() {
        $choices          = [];

        $repository = $this
          ->getDoctrine()
          ->getManager();

        $query =$repository->createQuery(
          'SELECT s FROM AppBundle:Sport s WHERE s.status != 9'
        );



        $listSport = $query->getResult();

        foreach ($listSport  as $sport) {
            $choices[$sport->getId()] = $sport->getlibelle();
        }

        return $choices;
    }



}

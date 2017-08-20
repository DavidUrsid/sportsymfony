<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Team;
use Symfony\Component\Form\FormBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\TeamType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class TeamsAdminController extends Controller
{
    public function teamsAction(Request $request)
    {
$team = new Team;

$repository = $this
  ->getDoctrine()
  ->getManager();

$query =$repository->createQuery(
  'SELECT t FROM AppBundle:Team t WHERE t.status != 9'
);



$listTeam = $query->getResult();

$form = $this->get('form.factory')->create(TeamType::class, $team);



if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

  $team->setCreatedAt(new \DateTime('now'));
  $team->setUpdateAt(new \DateTime('now'));
  $team->setstatus(1);

   $em = $this->getDoctrine()->getManager();
   $em->persist($team);
   $em->flush();

   $request->getSession()->getFlashBag()->add('notice', 'Cette équipe bien enregistrée.');

   return $this->redirectToRoute('teamsAdmin', array('title'=>'Gestion des équipes'));
 }else{


      return $this->render('AppBundle:Admin:Teams\teams.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des équipes',
        'listTeam' => $listTeam
      ));

 }


      return $this->render('AppBundle:Admin:Teams\teams.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des équipes',
        'listTeam' => $listTeam
      ));







    }


    public function teamsupdateAction($id, Request $request)
    {


    $repository = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('AppBundle:Team');


    $Team= $repository->find($id);






    $form = $this->get('form.factory')->create(TeamType::class, $Team);


      $Team;
    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {


    $Team->setUpdateAt(new \DateTime('now'));


    $form->handleRequest($request);
    $em = $this->getDoctrine()->getManager();
    $em->persist($Team);
    $em->flush();

    $request->getSession()->getFlashBag()->add('notice', 'Cette équipe bien enregistrée.');

    return $this->redirectToRoute('teamsAdmin', array('title'=>'Gestion des équipes'));
    }else{

       return $this->render('AppBundle:Admin:Teams\teamsupdate.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des équies',
        'Team' => $Team
      ));


    }


      return $this->render('AppBundle:Admin:Teams\teamsupdate.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des équies',
        'Team' => $Team
      ));







    }


    public function teamsdeleteAction($id, Request $request)
    {


    $repository = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('AppBundle:Team');


    $Team= $repository->find($id);






    $formBuilder=$this->get('form.factory')->createBuilder(FormType::class,$Team);



    $formBuilder->add('save', SubmitType::class, array('label'=> 'Confirmer','attr' =>array('class' => 'btn btn-default')));

$form= $formBuilder->getForm();

      $Team;
    if ($request->isMethod('POST') ) {

$Team->setUpdateAt(new \DateTime('now'));
    $Team->setStatus(9);
    $Team->setUpdateAt(new \DateTime('now'));

    $form->handleRequest($request);
    $em = $this->getDoctrine()->getManager();
    $em->persist($Team);
    $em->flush();

    $request->getSession()->getFlashBag()->add('notice', 'Cette équipe a été effacé.');

    return $this->redirectToRoute('teamsAdmin', array('title'=>'Gestion des équipes'));
    }


      return $this->render('AppBundle:Admin:Teams\teamsdelete.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des sports',
        'Team' => $Team
      ));







    }





  }

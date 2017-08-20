<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Sport;
use Symfony\Component\Form\FormBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\SportType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SportsAdminController extends Controller
{
    public function sportsAction(Request $request)
    {
$sport = new Sport;

$repository = $this
  ->getDoctrine()
  ->getManager();

$query =$repository->createQuery(
  'SELECT s FROM AppBundle:Sport s WHERE s.status   != 9'
);



$listSport = $query->getResult();

$form = $this->get('form.factory')->create(SportType::class, $sport);



if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

  $sport->setCreatedAt(new \DateTime('now'));
  $sport->setUpdateAt(new \DateTime('now'));
  $sport->setstatus(1);


   $em = $this->getDoctrine()->getManager();
   $em->persist($sport);
   $em->flush();

   $request->getSession()->getFlashBag()->add('notice', 'Le sport bien enregistrée.');

   return $this->redirectToRoute('sportsAdmin', array('title'=>'Gestion des sports'));
 }else{

  return $this->render('AppBundle:Admin:Sports\sports.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des sports',
        'listSport' => $listSport
      ));

 }


      






    }


    public function sportsupdateAction($id, Request $request)
    {


    $repository = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('AppBundle:Sport');


    $sport= $repository->find($id);






    $form = $this->get('form.factory')->create(SportType::class, $sport);


      $sport;
    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {


    $sport->setUpdateAt(new \DateTime('now'));



    $em = $this->getDoctrine()->getManager();
    $em->persist($sport);
    $em->flush();

    $request->getSession()->getFlashBag()->add('notice', 'Sport bien enregistrée.');

    return $this->redirectToRoute('sportsAdmin', array('title'=>'Gestion des sports'));
    }else{
        return $this->render('AppBundle:Admin:Sports\sportsupdate.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des sports',
        'sport' => $sport
      ));
    }


      return $this->render('AppBundle:Admin:Sports\sportsupdate.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des sports',
        'sport' => $sport
      ));







    }


    public function sportsdeleteAction($id, Request $request)
    {


    $repository = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('AppBundle:Sport');


    $Sport= $repository->find($id);






    $formBuilder=$this->get('form.factory')->createBuilder(FormType::class,$Sport);



    $formBuilder->add('save', SubmitType::class, array('label'=> 'Confirmer','attr' =>array('class' => 'btn btn-default')));

$form= $formBuilder->getForm();

      $Sport;
    if ($request->isMethod('POST')) {

$Sport->setUpdateAt(new \DateTime('now'));
    $Sport->setStatus(9);
    $Sport->setUpdateAt(new \DateTime('now'));


    $em = $this->getDoctrine()->getManager();
    $em->persist($Sport);
    $em->flush();

    $request->getSession()->getFlashBag()->add('notice', 'Ce sport a été effacé.');

    return $this->redirectToRoute('sportsAdmin', array('title'=>'Gestion des sports'));
    }


      return $this->render('AppBundle:Admin:sports\sportsdelete.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des sports',
        'Sport' => $Sport
      ));







    }





  }

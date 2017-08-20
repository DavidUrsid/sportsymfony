<?php

namespace AppBundle\Controller;

use AppBundle\Entity\League;
use Symfony\Component\Form\FormBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\LeagueType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class LeaguesAdminController extends Controller
{
    public function leaguesAction(Request $request)
    {
$league = new League;

$repository = $this
  ->getDoctrine()
  ->getManager();

$query =$repository->createQuery(
  'SELECT l FROM AppBundle:League l WHERE l.status != 9'
);



$listLeague = $query->getResult();

$form = $this->get('form.factory')->create(LeagueType::class, $league);



if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

  $league->setCreatedAt(new \DateTime('now'));
  $league->setUpdateAt(new \DateTime('now'));
  $league->setstatus(1);

   $em = $this->getDoctrine()->getManager();
   $em->persist($league);
   $em->flush();

   $request->getSession()->getFlashBag()->add('notice', 'Le sport bien enregistrée.');

   return $this->redirectToRoute('leaguesAdmin', array('title'=>'Gestion des ligues'));
 }else {
  return $this->render('AppBundle:Admin:Leagues\leagues.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des ligues',
        'listLeague' => $listLeague
      ));


 }


      return $this->render('AppBundle:Admin:Leagues\leagues.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des ligues',
        'listLeague' => $listLeague
      ));







    }


    public function leaguesupdateAction($id, Request $request)
    {


    $repository = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('AppBundle:League');


    $League= $repository->find($id);






    $form = $this->get('form.factory')->create(LeagueType::class, $League);


      $League;
    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {


    $League->setUpdateAt(new \DateTime('now'));



    $em = $this->getDoctrine()->getManager();
    $em->persist($League);
    $em->flush();

    $request->getSession()->getFlashBag()->add('notice', 'Cette ligue bien enregistrée.');

    return $this->redirectToRoute('leaguesAdmin', array('title'=>'Gestion des ligues'));
    }else {
        return $this->render('AppBundle:Admin:Leagues\leaguesupdate.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des ligues',
        'League' => $League
      ));

    }


      return $this->render('AppBundle:Admin:Leagues\leaguesupdate.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des ligues',
        'League' => $League
      ));







    }


    public function leaguesdeleteAction($id, Request $request)
    {

    $repository = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('AppBundle:League');


    $League= $repository->find($id);






    $formBuilder=$this->get('form.factory')->createBuilder(FormType::class,$League);



    $formBuilder->add('save', SubmitType::class, array('label'=> 'Confirmer','attr' =>array('class' => 'btn btn-default')));

$form= $formBuilder->getForm();

      $League;
    if ($request->isMethod('POST')) {

$League->setUpdateAt(new \DateTime('now'));
    $League->setStatus(9);
$League->setUpdateAt(new \DateTime('now'));

    $form->handleRequest($request);
    $em = $this->getDoctrine()->getManager();
    $em->persist($League);
    $em->flush();

    $request->getSession()->getFlashBag()->add('notice', 'Cette ligue a été effacé.');

    return $this->redirectToRoute('leaguesAdmin', array('title'=>'Gestion des ligues'));
    }


      return $this->render('AppBundle:Admin:Leagues\Leaguesdelete.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des ligues',
        'League' => $League
      ));







    }





  }

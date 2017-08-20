<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Player;

use Symfony\Component\Form\FormBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\PlayerType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Security("has_role('ROLE_ADMIN')")
 */
class PlayersAdminController extends Controller
{
    public function playerAction(Request $request)
    {
$player = new Player;

$repository = $this
  ->getDoctrine()
  ->getManager();

$query =$repository->createQuery(
  'SELECT o FROM AppBundle:Player o WHERE o.status != 9'
);


$listplayers = $query->getResult();

$form = $this->get('form.factory')->create(PlayerType::class, $player);



if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

  $player->setCreatedAt(new \DateTime('now'));
  $player->setUpdateAt(new \DateTime('now'));
  $player->setstatus(1);


   $em = $this->getDoctrine()->getManager();
   $em->persist($player);
   $em->flush();

   $request->getSession()->getFlashBag()->add('notice', 'Categorie bien enregistrée.');

   return $this->redirectToRoute('playersAdmin', array('title'=>'Gestion des option'));
 }


      return $this->render('AppBundle:Admin:Players\player.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des option',
        'listplayers' => $listplayers
      ));







    }


    public function playerupdateAction($id, Request $request)
    {


    $repository = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('AppBundle:Player');


    $players= $repository->find($id);






    $form = $this->get('form.factory')->create(PlayerType::class, $players);


      $players;
    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {


    $players->setUpdateAt(new \DateTime('now'));



    $em = $this->getDoctrine()->getManager();
    $em->persist($players);
    $em->flush();

    $request->getSession()->getFlashBag()->add('notice', 'Ce nom de joueur a bien été enregistré.');

    return $this->redirectToRoute('playersAdmin', array('title'=>'Gestion des options'));
    }


      return $this->render('AppBundle:Admin:Players\playerupdate.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des option',
        'players' => $players
      ));







    }


    public function playerdeleteAction($id, Request $request)
    {


    $repository = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('AppBundle:Player');


    $players= $repository->find($id);






    $formBuilder=$this->get('form.factory')->createBuilder(FormType::class,$players);



    $formBuilder->add('save', SubmitType::class, array('label'=> 'Confirmer','attr' =>array('class' => 'btn btn-default')));

  $form= $formBuilder->getForm();


      $players;
    if ($request->isMethod('POST')) {

      $players->setUpdateAt(new \DateTime('now'));

    $players->setStatus(9);
    $players->setUpdateAt(new \DateTime('now'));



    $em = $this->getDoctrine()->getManager();
    $em->persist($players);
    $em->flush();

    $request->getSession()->getFlashBag()->add('notice', 'La categorie a été effacé.');

    return $this->redirectToRoute('playersAdmin', array('title'=>'Gestion des option'));
    }


      return $this->render('AppBundle:Admin:PLayers\playerdelete.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des option',
        'players' => $players
      ));







    }





  }

<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Panier;
use AppBundle\Entity\Product;
use AppBundle\Entity\SizeProduct;
use AppBundle\Entity\Size;
use AppBundle\Entity\Commandes;
use AppBundle\Entity\CommandesPanier;
use AppBundle\Entity\Comment;
use AppBundle\Entity\Team;
use AppBundle\Form\PanierType;
use AppBundle\Form\CommandesType;
use AppBundle\Form\CommandesPanierType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * @Security("has_role('ROLE_ADMIN')")
 */

class OrdersAdminController extends Controller
{

    public function CommandesAction( Request $request)
    {


   $repository = $this
  ->getDoctrine()
  ->getManager();
$query =$repository->createQuery(
  "SELECT c FROM AppBundle:Commandes c WHERE  c.status!= 9 "
);
$listCommande = $query->getResult();





return $this->render('AppBundle:Admin/Orders:commandes.html.twig', array(
	    'title'=>'gestion des Commandes'  ,     
        'listCommande' => $listCommande
      ));



  }



  public function CommandesupdateAction($id, Request $request){

   $repository = $this
  ->getDoctrine()
  ->getManager();
$query =$repository->createQuery(
  "SELECT c FROM AppBundle:CommandesPanier c WHERE c.commandes = '$id' AND c.status!= 9 "
);
$listPaniers = $query->getResult();





  return $this->render('AppBundle:Admin/Orders:commandesupdate.html.twig', array(
      'title'=>'gestion des Commandes'  ,     
        'listPaniers' => $listPaniers
      ));  

  }





  public function Commandesdelete($id, Request $request){

   $repository = $this
  ->getDoctrine()
  ->getManager();
$query =$repository->createQuery(
  "SELECT c FROM AppBundle:CommandesPanier c WHERE c.commandes = '$id' AND c.status!= 9 "
);
$listPaniers = $query->getResult();

  

  }




}
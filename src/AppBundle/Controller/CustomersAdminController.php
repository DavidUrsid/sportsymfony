<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\User;
use AppBundle\Form\RegistrationType;
use AppBundle\Form\ProfileType;
 use Doctrine\ORM\Mapping as ORM;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
/**
 * @Security("has_role('ROLE_ADMIN')")
 */

class CustomersAdminController extends Controller
{


    public function customersAction(Request $request)
    {


$customer = new User;

$repository = $this
  ->getDoctrine()
  ->getManager()
  ->getRepository('AppBundle:User')
;

$listCustomers = $repository->findAll();







$form = $this->get('form.factory')->create(RegistrationType::class, $customer);

$form->add('save', SubmitType::class, array('label'=> 'Confirmer','attr' =>array('class' => 'btn btn-default')));




if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

  




   $em = $this->getDoctrine()->getManager();
   $em->persist($customer);
   $em->flush();

   $request->getSession()->getFlashBag()->add('notice', 'Client bien enregistrée.');

   return $this->redirectToRoute('customersAdmin', array('title'=>'Gestions des clients'));
 } else {

      $content = $this
      ->get('templating')
      ->render('AppBundle:Admin:Customers\customers.html.twig', array('title'=>'Gestion des profils client',  'form' => $form->createView(), 'listCustomers'=>$listCustomers));

      return new Response($content);
 }






      $content = $this
      ->get('templating')
      ->render('AppBundle:Admin:Customers\customers.html.twig', array('title'=>'Gestion des profils client',  'form' => $form->createView(), 'listCustomers'=>$listCustomers));

      return new Response($content);

  }



   public function customerupdateAction($id, Request $request)
    {


    $repository = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('AppBundle:User');


    $customer= $repository->find($id);






    $form = $this->get('form.factory')->create(ProfileType::class, $customer);
$form->add('save', SubmitType::class, array('label'=> 'Confirmer','attr' =>array('class' => 'btn btn-default')));


    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {





  
    $em = $this->getDoctrine()->getManager();
    $em->persist($customer);
    $em->flush();

    $request->getSession()->getFlashBag()->add('notice', 'Category bien enregistrée.');

    return $this->redirectToRoute('customersAdmin', array('title'=>'Gestion des clients'));
    }else {

       return $this->render('AppBundle:Admin:Customers\customerupdate.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des clients',
        'customer' => $customer
      ));

    }


    return $this->render('AppBundle:Admin:Customers\customerupdate.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des clients',
        'customer' => $customer
      ));







    }



}

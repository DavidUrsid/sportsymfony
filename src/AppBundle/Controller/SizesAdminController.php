<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Size;
use Symfony\Component\Form\FormBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\SizeType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class SizesAdminController extends Controller
{
    public function sizesAction(Request $request)
    {
$size = new Size;

$repository = $this
  ->getDoctrine()
  ->getManager();

$query =$repository->createQuery(
  'SELECT s FROM AppBundle:Size s WHERE s.status != 9'
);



$listSizes = $query->getResult();

$form = $this->get('form.factory')->create(SizeType::class, $size);



if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

  $size->setCreatedAt(new \DateTime('now'));
  $size->setUpdateAt(new \DateTime('now'));
  $size->setstatus(1);

   $em = $this->getDoctrine()->getManager();
   $em->persist($size);
   $em->flush();

   $request->getSession()->getFlashBag()->add('notice', 'La taille bien enregistrée.');

   return $this->redirectToRoute('sizesAdmin', array('title'=>'Gestion des tailles'));
 }else{

   return $this->render('AppBundle:Admin:Sizes\size.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des tailles',
        'listSizes' => $listSizes
      ));

 }


      return $this->render('AppBundle:Admin:Sizes\size.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des tailles',
        'listSizes' => $listSizes
      ));







    }


    public function sizeupdateAction($id, Request $request)
    {


    $repository = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('AppBundle:Size');


    $Sizes= $repository->find($id);






    $form = $this->get('form.factory')->create(SizeType::class, $Sizes);


      $Sizes;
    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {


    $Sizes->setUpdateAt(new \DateTime('now'));



    $em = $this->getDoctrine()->getManager();
    $em->persist($Sizes);
    $em->flush();

    $request->getSession()->getFlashBag()->add('notice', 'Cette taille a  bien été enregistrée.');

    return $this->redirectToRoute('sizesAdmin', array('title'=>'Gestion des tailles'));
    }else {

      
      return $this->render('AppBundle:Admin:Sizes\sizeupdate.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des tailles',
        'Sizes' => $Sizes
      ));

    }


      return $this->render('AppBundle:Admin:sizes\sizeupdate.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des tailles',
        'Sizes' => $Sizes
      ));







    }


    public function sizedeleteAction($id, Request $request)
    {


    $repository = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('AppBundle:Size');


    $Sizes= $repository->find($id);






    $formBuilder=$this->get('form.factory')->createBuilder(FormType::class,$Sizes);



    $formBuilder->add('save', SubmitType::class, array('label'=> 'Confirmer','attr' =>array('class' => 'btn btn-default')));

  $form= $formBuilder->getForm();


      $Sizes;
    if ($request->isMethod('POST')) {

      $Sizes->setUpdateAt(new \DateTime('now'));

    $Sizes->setStatus(9);
    $Sizes->setUpdateAt(new \DateTime('now'));

    $em = $this->getDoctrine()->getManager();
    $em->persist($Sizes);
    $em->flush();

    $request->getSession()->getFlashBag()->add('notice', 'Cette taille a été effacé.');

    return $this->redirectToRoute('sizesAdmin', array('title'=>'Gestion des tailles'));
    }


      return $this->render('AppBundle:Admin:Sizes\sizedelete.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des tailles',
        'Sizes' => $Sizes
      ));







    }





  }

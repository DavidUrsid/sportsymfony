<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use Symfony\Component\Form\FormBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\CategoryType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Security("has_role('ROLE_ADMIN')")
 */
class CategoriesAdminController extends Controller
{
    public function categoriesAction(Request $request)
    {
$category = new Category;

$repository = $this
  ->getDoctrine()
  ->getManager();

$query =$repository->createQuery(
  'SELECT c FROM AppBundle:Category c WHERE c.status != 9'
);



$listCategories = $query->getResult();

$form = $this->get('form.factory')->create(CategoryType::class, $category);



if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

  $category->setCreatedAt(new \DateTime('now'));
  $category->setUpdateAt(new \DateTime('now'));
  $category->setstatus(1);

  
   $em = $this->getDoctrine()->getManager();
   $em->persist($category);
   $em->flush();

   $request->getSession()->getFlashBag()->add('notice', 'Categorie bien enregistrée.');

   return $this->redirectToRoute('categoriesAdmin', array('title'=>'Gestion des categories'));
 } else {

     return $this->render('AppBundle:Admin:Categories\categories.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des categories',
        'listCategories' => $listCategories
      ));
 }


      return $this->render('AppBundle:Admin:Categories\categories.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des categories',
        'listCategories' => $listCategories
      ));







    }


    public function categoryupdateAction($id, Request $request)
    {


    $repository = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('AppBundle:Category');


    $Categories= $repository->find($id);






    $form = $this->get('form.factory')->create(CategoryType::class, $Categories);


      $Categories;
    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {


    $Categories->setUpdateAt(new \DateTime('now'));


   
    $em = $this->getDoctrine()->getManager();
    $em->persist($Categories);
    $em->flush();

    $request->getSession()->getFlashBag()->add('notice', 'Category bien enregistrée.');

    return $this->redirectToRoute('categoriesAdmin', array('title'=>'Gestion des categories'));
    }else {

       return $this->render('AppBundle:Admin:Categories\categoryupdate.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des categories',
        'Categories' => $Categories
      ));

    }


      return $this->render('AppBundle:Admin:Categories\categoryupdate.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des categories',
        'Categories' => $Categories
      ));







    }


    public function categorydeleteAction($id, Request $request)
    {


    $repository = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('AppBundle:Category');


    $Categories= $repository->find($id);






    $formBuilder=$this->get('form.factory')->createBuilder(FormType::class,$Categories);



    $formBuilder->add('save', SubmitType::class, array('label'=> 'Confirmer','attr' =>array('class' => 'btn btn-default')));

  $form= $formBuilder->getForm();


      $Categories;
    if ($request->isMethod('POST')) {

      $Categories->setUpdateAt(new \DateTime('now'));

    $Categories->setStatus(9);
    $Categories->setUpdateAt(new \DateTime('now'));

    $form->handleRequest($request);
    $em = $this->getDoctrine()->getManager();
    $em->persist($Categories);
    $em->flush();

    $request->getSession()->getFlashBag()->add('notice', 'La categorie a été effacé.');

    return $this->redirectToRoute('categoriesAdmin', array('title'=>'Gestion des categories'));
    }


      return $this->render('AppBundle:Admin:Categories\categorydelete.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des categories',
        'Categories' => $Categories
      ));







    }





  }

<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Symfony\Component\Form\FormBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ProductType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\SizeProduct;
use AppBundle\Entity\Size;
use AppBundle\Entity\Comment;
use AppBundle\Form\CommentadminType;
class ProductsAdminController extends Controller
{
    public function productsAction(Request $request)
    {
$product = new Product;

$repository = $this
  ->getDoctrine()
  ->getManager();

$query =$repository->createQuery(
  'SELECT p FROM AppBundle:Product p WHERE p.status != 9'
);



$listProducts = $query->getResult();

$form = $this->get('form.factory')->create(ProductType::class, $product);

if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

 
  $product->setCreatedAt(new \DateTime('now'));
  $product->setUpdateAt(new \DateTime('now'));
  $product->setstatus(1);
 


   $em = $this->getDoctrine()->getManager();
   $em->persist($product);
   $em->flush();

   $request->getSession()->getFlashBag()->add('notice', 'Ce produit a bien été enregistré.');

   return $this->redirectToRoute('productsAdmin', array('title'=>'Gestion des produits'));
 }


      return $this->render('AppBundle:Admin:Products\products.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des produits',
        'listProducts' => $listProducts
      ));







    }


    public function productupdateAction($id, Request $request)
    {


    $repository = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('AppBundle:Product');


    $product= $repository->find($id);






    $form = $this->get('form.factory')->create(ProductType::class, $product);


      $product;
    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {


    $product->setUpdateAt(new \DateTime('now'));


 
    $em = $this->getDoctrine()->getManager();
    $em->persist($product);
    $em->flush();

    $request->getSession()->getFlashBag()->add('notice', 'Ce produit a bien été modifié.');

    return $this->redirectToRoute('productsAdmin', array('title'=>'Gestion des produits'));
    }


      return $this->render('AppBundle:Admin:Products\productupdate.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des tailles',
        'product' => $product
      ));







    }


    public function productdeleteAction($id, Request $request)
    {


    $repository = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('AppBundle:Product');


    $product= $repository->find($id);



    $formBuilder=$this->get('form.factory')->createBuilder(FormType::class,$product);



    $formBuilder->add('save', SubmitType::class, array('label'=> 'Confirmer','attr' =>array('class' => 'btn btn-default')));

  $form= $formBuilder->getForm();


      $product;
    if ($request->isMethod('POST')) {

      $product->setUpdateAt(new \DateTime('now'));

    $product->setStatus(9);
    $product->setUpdateAt(new \DateTime('now'));

    $form->handleRequest($request);
    $em = $this->getDoctrine()->getManager();
    $em->persist($product);
    $em->flush();

    $request->getSession()->getFlashBag()->add('notice', 'Cette taille a été effacé.');

    return $this->redirectToRoute('productsAdmin', array('title'=>'Gestion des produits'));
    }


      return $this->render('AppBundle:Admin:Products\productdelete.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des tailles',
        'product' => $product
      ));







    }

    public function viewAction( Request $request)
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



    $Sizes->setStatus(9);
    $Sizes->setUpdateAt(new \DateTime('now'));

    $form->handleRequest($request);
    $em = $this->getDoctrine()->getManager();
    $em->persist($Sizes);
    $em->flush();

    $request->getSession()->getFlashBag()->add('notice', 'Cette taille a été effacé.');

    return $this->redirectToRoute('productsAdmin', array('title'=>'Gestion des tailles'));
    }


      return $this->render('AppBundle:Admin:sizes\sizedelete.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des tailles',
        'Sizes' => $Sizes
      ));

    }




    public function commentAction($id, Request $request)
    {


    $repository = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('AppBundle:Product');


    $product= $repository->find($id);



$repository = $this
  ->getDoctrine()
  ->getManager();

$query =$repository->createQuery(
  "SELECT c FROM AppBundle:Comment c WHERE  c.product = '$id' AND c.status != 9"
);

$listComment = $query->getResult();

$comment = new Comment; 

    $form = $this->get('form.factory')->create(CommentadminType::class, $comment);


     
    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {


    $comment->setUpdateAt(new \DateTime('now'));
  $comment->setCreatedAt(new \DateTime('now'));
   $comment->setStatus(1);

   
    $em = $this->getDoctrine()->getManager();
    $em->persist($comment);
    $em->flush();

    $request->getSession()->getFlashBag()->add('notice', 'Ce commentaire a bien été modifié.');

    return $this->redirectToRoute('comment_product', array('title'=>'Gestion des produits', 'id'=>$id));
    }else {
           return $this->render('AppBundle:Admin:Products\comment.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des commentaires',
        'listComment' => $listComment
      ));


    }


      return $this->render('AppBundle:Admin:Products\comment.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des commentaires',
        'listComment' => $listComment
      ));







    }



public function updatecommentAction($id, Request $request)
    {


    $repository = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('AppBundle:Comment');


    $comment= $repository->find($id);


    $form = $this->get('form.factory')->create(CommentadminType::class, $comment);


     
    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {


    $comment->setUpdateAt(new \DateTime('now'));

   
    $em = $this->getDoctrine()->getManager();
    $em->persist($comment);
    $em->flush();

    $request->getSession()->getFlashBag()->add('notice', 'Ce commentaire a bien été modifié.');

    return $this->redirectToRoute('productsAdmin', array('title'=>'Gestion des produits'));
    }else {
           return $this->render('AppBundle:Admin:Products\updatecomment.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des commentaires',
        'comment' => $comment,
        'id'=>$id
      ));


    }

     return $this->render('AppBundle:Admin:Products\updatecomment.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des commentaires',
        'comment' => $comment
      ));






    }





public function deletecommentAction($id, Request $request)
    {


    $repository = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('AppBundle:Comment');


    $comment= $repository->find($id);



    $formBuilder=$this->get('form.factory')->createBuilder(FormType::class,$comment);



    $formBuilder->add('save', SubmitType::class, array('label'=> 'Confirmer','attr' =>array('class' => 'btn btn-default')));

  $form= $formBuilder->getForm();


   
    if ($request->isMethod('POST')) {



     $comment->setStatus(9);
     $comment->setUpdateAt(new \DateTime('now'));

    $form->handleRequest($request);
    $em = $this->getDoctrine()->getManager();
    $em->persist($comment);
    $em->flush();

    $request->getSession()->getFlashBag()->add('notice', 'Cette taille a été effacé.');

    return $this->redirectToRoute('productsAdmin', array('title'=>'Gestion des produits'));
    }


      return $this->render('AppBundle:Admin:Products\deletecomment.html.twig', array(
        'form' => $form->createView(),
        'title'=>'Gestion des commentaires',
        'comment' => $comment
      ));







    }




  }

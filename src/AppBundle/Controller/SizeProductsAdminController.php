<?php

namespace AppBundle\Controller;

use AppBundle\Entity\SizeProduct;
use AppBundle\Entity\Product;
use AppBundle\Entity\Size;
use Symfony\Component\Form\FormBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\SizeProductType;
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



class SizeProductsAdminController extends Controller
{

    public function sizesAction($id, Request $request)
    {

      //Tu crees un nouveau SizeProduct
      		$sizeproduct= new SizeProduct;

      		//Entity Manager
      		$em = $this->getDoctrine()->getManager();

      		//Recuperation du product d'apres l'id
      		$product = $em->getRepository('AppBundle:Product')->find($id);

      		//Recuperation de la liste des tailles
      		$size = $em->getRepository('AppBundle:Size')->findAll();

      		//Recuperation de toutes les tailles du produit
      		$sizeproducts= $em->getRepository('AppBundle:SizeProduct')->findBy(array( 'size'=>$size,
       'product'=>$product));

      		//
      		$allsize =$em->createQuery(
      		  "SELECT p FROM AppBundle:SizeProduct p WHERE p.product ='$id' AND p.status !=9"
      		)->getResult();








      		$form = $this->get('form.factory')->create(SizeProductType::class, $sizeproduct);

      		//Si on est en POST
      		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

      
            		$sizeproduct->setCreatedAt(new \DateTime('now'));
            		$sizeproduct->setUpdateAt(new \DateTime('now'));
            		$sizeproduct->setstatus(1);

      		
      			$sizeproduct->setProduct($product);

      	
      			if($form->isValid()) {
      				
      				$em->persist($sizeproduct);
      				$em->flush();

      				$request->getSession()->getFlashBag()->add('notice', 'Ce produit a bien été enregistré.');
      				return $this->redirectToRoute('size_product', array(  'id' => $id,'title'=>'Gestion des produits'));
      			}
           	}
      		
                return $this->render('AppBundle:Admin:Products\sizeproduct.html.twig', array(
                'form' => $form->createView(),
                  'title'=>'Gestion des produits',
                
                  'product'=>$product,
                  'size'=>$size,
                  'sizeproducts'=>$sizeproducts,
                  'allsize'=> $allsize));

    }


public function updatesizeAction($id, Request $request){


      $repository = $this
      ->getDoctrine()
      ->getManager()
      ->getRepository('AppBundle:SizeProduct');


      $sizeproduct= $repository->find($id);

      $form = $this->get('form.factory')->create(SizeProductType::class, $sizeproduct);

 
        $sizeproduct;
      if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {


      $sizeproduct->setUpdateAt(new \DateTime('now'));



      $em = $this->getDoctrine()->getManager();
      $em->persist($sizeproduct);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Ce produit a bien été modifié.');

      return $this->redirectToRoute('size_product', array('title'=>'Gestion des produits',  'id'=> $id));
      }


        return $this->render('AppBundle:Admin:Products\sizeproductupdate.html.twig', array(
          'form' => $form->createView(),
          'title'=>'Gestion des tailles',
          'sizeproduct' => $sizeproduct
        ));






}



public function deletesizeAction($id, Request $request){


    $repository = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('AppBundle:SizeProduct');


    $sizeproduct= $repository->find($id);



    $formBuilder=$this->get('form.factory')->createBuilder(FormType::class, $sizeproduct);



    $formBuilder->add('save', SubmitType::class, array('label'=> 'Confirmer','attr' =>array('class' => 'btn btn-default')));

  $form= $formBuilder->getForm();


      $sizeproduct;
    if ($request->isMethod('POST')) {

      $sizeproduct->setUpdateAt(new \DateTime('now'));

    $sizeproduct->setStatus(9);
    $sizeproduct->setUpdateAt(new \DateTime('now'));

    $form->handleRequest($request);
    $em = $this->getDoctrine()->getManager();
    $em->persist($sizeproduct);
    $em->flush();

    $request->getSession()->getFlashBag()->add('notice', 'Cette taille a été effacé.');
$id=$sizeproduct->getProduct($id);

        return $this->redirectToRoute('size_product', array('title'=>'Gestion des produits',  'id'=>$id->getId() ));


  

} return $this->render('AppBundle:Admin:Products\sizeproductdelete.html.twig', array(
            'form' => $form->createView(),
            'title'=>'Gestion des tailles',
            'sizeproduct' => $sizeproduct
          ));}





}

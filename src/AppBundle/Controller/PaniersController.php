<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Panier;
use AppBundle\Entity\Product;
use AppBundle\Entity\SizeProduct;
use AppBundle\Entity\Size;
use AppBundle\Entity\Commandes;
use AppBundle\Entity\Comment;
use AppBundle\Entity\Team;
use AppBundle\Form\PanierType;
use AppBundle\Form\CommandesType;

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


/**
 * @Security("has_role('ROLE_USER')")
 */

class PaniersController extends Controller
{
    public function addPanierAction($product_id, Request $request)
    {



//Recup ENtityManaer
	$em = $this->getDoctrine()->getManager();
	
	$product = $em->getRepository('AppBundle:Product')->find($product_id);
	$sizeId = $request->request->get('appbundle_panier')['size'];
  
	$repository = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('AppBundle:SizeProduct');


    $size= $repository->find($sizeId);

	$panier = new Panier();
	
	$form = $this->createForm(PanierType::class, new Panier($product_id), ['panier' => $panier] );



	//Si tu arrives ici en post
	if($request->isMethod('POST')) {

		$form->handleRequest($request);
		

		$prix = $product->getPrix() * $form['quantity']->getData();
	
		$ht= $prix/1.2;
    $tva = $prix-$ht;
		$panier->setProduct($product);		
		$panier->setUser($this->getUser()); 
		$panier->setSize($size);
		$panier->setQuantity($form['quantity']->getData());
		$panier->setTotal($prix);	
		$panier->setTva($tva);
    $panier->setHt($ht);	 
  		$panier->setCreatedAt(new \DateTime('now'));
  		$panier->setUpdateAt(new \DateTime('now'));
  		$panier->setstatus(2);


  		
		//Tu ajoutes le panier à Doctrine
		$em->persist($panier);
		
		//Tu enregistres le panier
		$em->flush();

    

   return $this->redirectToRoute('panier');
    			}



	}



public function PanierAction(Request $request)
    {
$user= $this->getUser();

   $repository = $this
  ->getDoctrine()
  ->getManager();
$query =$repository->createQuery(
  "SELECT p FROM AppBundle:Panier p WHERE  p.status = 2 AND p.user = '$user'   "
);
$listPanier = $query->getResult();

$totalcommande = 0;
	foreach ($listPanier as  $panier){

								$totalcommande = $totalcommande +$panier->getTotal();
							} 

 $commande = new Commandes;

$form_commande = $this->createForm(CommandesType::class, new Commandes($totalcommande), [
   'action' =>  $this->generateUrl('add_commande')
    
]);
  



      $content = $this
      ->get('templating')
      ->render('AppBundle:Panier:panier.html.twig', array('title'=>'Panier',
        'listPanier' => $listPanier, 
        'totalcommande' => $totalcommande, 
        'form_commande' => $form_commande->createView()
        ));
	return new Response($content);
   


    			}




    public function panierupdateAction($id, Request $request)
    {


    $repository = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('AppBundle:Panier');


    $panier= $repository->find($id);




$product_id  =$panier->getProduct()->getId();

    $form = $this->get('form.factory')->create(PanierType::class, $panier);

$form = $this->createForm(PanierType::class, $panier, [
    'product_id' =>$product_id  
]);
      
    if ($request->isMethod('POST')) {




 $form->handleRequest($request);

$prix = $panier->getProduct()->getPrix() * $form['quantity']->getData();
 
    $ht= $prix/1.2;
    $tva=$prix-$ht;

    $panier->setUpdateAt(new \DateTime('now'));
  $panier->setTotal($prix); 
    $panier->setTva($tva);  
    $panier->setHt($ht); 



   
    $em = $this->getDoctrine()->getManager();
    $em->persist($panier);
    $em->flush();

    $request->getSession()->getFlashBag()->add('notice', 'Ce produit a bien été modifié.');

    return $this->redirectToRoute('panier');
    }


      return $this->render('AppBundle:Panier:panierupdate.html.twig', array(
        'form' => $form->createView(),
        'panier' => $panier,
        'title' => 'Modifier votre panier'
      ));







    }


    public function panierdeleteAction($id, Request $request)
    {


    $repository = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('AppBundle:Panier');


    $panier= $repository->find($id);






    $formBuilder=$this->get('form.factory')->createBuilder(FormType::class,$panier);



    $formBuilder->add('save', SubmitType::class, array('label'=> 'Confirmer','attr' =>array('class' => 'btn btn-default')));

  $form= $formBuilder->getForm();


    if ($request->isMethod('POST')) {

     
    $form->handleRequest($request);

    $panier->setStatus(9);
    $panier->setUpdateAt(new \DateTime('now'));

    $em = $this->getDoctrine()->getManager();
    $em->persist($panier);
    $em->flush();

    $request->getSession()->getFlashBag()->add('notice', 'Cette taille a été effacé.');

    return $this->redirectToRoute('panier', array('title'=>'Gestion des produits'));
    }


      return $this->render('AppBundle:Panier:panierdelete.html.twig', array(
        'title' => 'title',
        'form' => $form->createView(),
        
        'panier' => $panier
      ));







    }
	



}
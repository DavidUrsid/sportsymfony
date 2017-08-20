<?php

namespace AppBundle\Controller;



use AppBundle\Entity\Product;
use AppBundle\Entity\SizeProduct;
use AppBundle\Entity\Size;
use AppBundle\Entity\Commandes;
use AppBundle\Entity\Comment;
use AppBundle\Entity\Team;
use AppBundle\Entity\Panier;
use AppBundle\Form\PanierType;
use AppBundle\Form\CommentType;
use AppBundle\Controller\CommandesController;


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

class CommentsController extends Controller
{
    public function addCommentAction($product_id, Request $request)
    {




	$em = $this->getDoctrine()->getManager();
	
	$product = $em->getRepository('AppBundle:Product')->find($product_id);
	

	$comment = new Comment();
	
	$form = $this->createForm(CommentType::class, $comment, ['product_id' => $product_id] );


	if($request->isMethod('POST') && $form->handleRequest($request)->isValid() ) {



		$comment->setProduct($product);		
		
  		$comment->setCreatedAt(new \DateTime('now'));
  		$comment->setUpdateAt(new \DateTime('now'));
  		$comment->setstatus(1);





   $em = $this->getDoctrine()->getManager();
  		
		//Tu ajoutes le panier à Doctrine
		$em->persist($comment);
		
		//Tu enregistres le panier
		$em->flush();

    

   return $this->redirectToRoute('comment');
    			}else {



$repository = $this
  ->getDoctrine()
  ->getManager();

$query =$repository->createQuery(
  "SELECT c FROM AppBundle:Comment c WHERE  c.status != 9 AND c.product = '$product_id'"
);



$listcomments = $query->getResult();



$user= $this->getUser();
$repository = $this
  ->getDoctrine()
  ->getManager();

$query =$repository->createQuery(
  "SELECT p FROM AppBundle:Panier p WHERE  p.status =1  AND p.user = '$user' AND p.product= '$product_id'"
);



$client = $query->getResult();




$form_panier = $this->createForm(PanierType::class, new Panier($produit_id), [
    'product_id' => $product_id,
    'action' =>  $this->generateUrl('add_panier', array('product_id' => $product_id))
    
]);





    				 $content = $this
      ->get('templating')
      ->render('AppBundle:Users:product.html.twig', array('title'=>'Vu du produit', 
        'product' => $product, 
        'product_id' => $product_id, 
        'listcomments' => $listcomments,
        'client' => $client,
        'form_panier' => $form_panier->createView(),
        'form_comment' => $form->createView(),
        ));
    return new Response($content);
  
    			}



	}



public function CommentAction(Request $request)
    {


 $content = $this
      ->get('templating')
      ->render('AppBundle:Comment:comment.html.twig', array('title'=>'Commentaire',
      
        ));
	return new Response($content);

    			}





	



}
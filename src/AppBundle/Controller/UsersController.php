<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use AppBundle\Entity\Product;
use AppBundle\Entity\SizeProduct;
use AppBundle\Entity\Size;
use AppBundle\Entity\Commandes;
use AppBundle\Entity\Comment;
use AppBundle\Entity\Team;
use AppBundle\Entity\Panier;
use AppBundle\Form\PanierType;
use AppBundle\Form\ContactType;
use AppBundle\Form\CommentType;
use AppBundle\Form\RechercheType;
use AppBundle\Controller\CommandesController;
use Doctrine\ORM\ProductRepository;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class UsersController extends Controller
{
    public function indexAction()
    {


$product = new Product;

$listproducts  = $this->getDoctrine()->getRepository('AppBundle:Product')->findIndex();




      $content = $this
      ->get('templating')
      ->render('AppBundle:Users:index.html.twig', array('title'=>'Accueil','listproducts' => $listproducts));

  return new Response($content);
    }













    public function presentationAction()
    {
      $content = $this
      ->get('templating')
      ->render('AppBundle:Users:presentation.html.twig', array('title'=>'Qui sommes-nous?'));

  return new Response($content);
    }


public function contactAction(Request $request, \Swift_Mailer $mailer)
    {

      $contact= new Contact;


$form = $this->get('form.factory')->create(ContactType::class, $contact);






if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

  $contact->setCreatedAt(new \DateTime('now'));
  $contact->setUpdateAt(new \DateTime('now'));
  $contact->setstatus(1);

$commentaire=$contact->getMessage();
$email= $contact->getEmail();

$message = (new \Swift_Message('Message contact'))
        ->setFrom($email)
        ->setSubject('Contact Sport Symfonique')
        ->setTo('bonjour@sportsymfonique.fr', $email)
        ->setCharset('utf-8')
        ->setBody($commentaire);

    $mailer->send($message);

    
   $em = $this->getDoctrine()->getManager();
   $em->persist($contact);
   $em->flush();


   return $this->redirectToRoute('contact', array('title'=>'Contact'));
 }else{


      $content = $this
      ->get('templating')
      ->render('AppBundle:Users:contact.html.twig', array('title'=>'Contact',  'form' => $form->createView()));

    return new Response($content);
 }




      $content = $this
      ->get('templating')
      ->render('AppBundle:Users:contact.html.twig', array('title'=>'Contact',  'form' => $form->createView()));

    return new Response($content);




    }





    public function mentionslegalesAction()
    {
      $content = $this
      ->get('templating')
      ->render('AppBundle:Users:mentionslegales.html.twig', array('title'=>'Mentions légales'));

    return new Response($content);
    }

    public function conditionsgeneralesAction()
    {
      $content = $this
      ->get('templating')
      ->render('AppBundle:Users:conditionsgenerales.html.twig', array('title'=>'Condtions générales de vente'));

    return new Response($content);
    }


    
public function productAction($id, Request $request)
    {


$comment = new Comment;

$repository = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('AppBundle:Product');


    $product= $repository->find($id);
$product_id = $product->getId();


$repository = $this
  ->getDoctrine()
  ->getManager();

$query =$repository->createQuery(
  "SELECT c FROM AppBundle:Comment c WHERE  c.status != 9 AND c.product = '$id'"
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

  $form_comment = $this->createForm(CommentType::class, new Comment($produit_id), [
     'product_id' => $product_id,
      'action' => $this->generateUrl('add_comment',  array('product_id' => $product_id)    )
    ]);


      $content = $this
      ->get('templating')
      ->render('AppBundle:Users:product.html.twig', array('title'=>'Vu du produit', 
        'product' => $product, 
        'product_id' => $product_id, 
        'listcomments' => $listcomments,
        'client' => $client,
        'form_panier' => $form_panier->createView(),
        'form_comment' => $form_comment->createView(),
        ));
    return new Response($content);
    }



public function rechercheformAction(Request $request){

$form = $this->createForm(RechercheType::class);


   $content = $this
      ->get('templating')
      ->render('AppBundle:Layout:recherche.html.twig', array('form' => $form->createView()));

 return new Response($content);

  }

  public function rechercheAction(Request $request){




if ($request->isMethod('POST')) {

     
      $chaine = $request->request->get('recherche')['libelle'];
    
 $listTeams = $this->getDoctrine()->getRepository('AppBundle:Team')->findRechercheTeam($chaine);


   $content = $this
      ->get('templating')
      ->render('AppBundle:Users:recherche.html.twig', array('title'=>'resultat de la recherche', 
        'listTeams' => $listTeams, 
        
        ));
    return new Response($content);
   


    }else {
       $content = $this
      ->get('templating')
      ->render('AppBundle:Users:recherche.html.twig', array('title'=>'resultat de la recherche', 
        'listTeams' => $listTeams, 
        
        ));
    return new Response($content);
    }



  }





}

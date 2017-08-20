<?php

namespace AppBundle\Controller;
use Spipu\Html2Pdf\Html2Pdf;
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
 * @Security("has_role('ROLE_USER')")
 */

class CommandesController extends Controller
{

	public function addCommandeAction( Request $request)
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


 foreach ($listPanier as  $panier){
                                  $idproduct=$panier->getProduct();
                                  $idp= $idproduct->getId();
                                  $sizepanier=$panier->getSize();
                                  $sp= $sizepanier->getSize();
                                  $s=$sp->getId();
                                  $quantityproduct= $panier->getQuantity();
                         
                                          $query =$repository->createQuery(
                                               "SELECT s FROM AppBundle:SizeProduct s WHERE  s.status !=9  AND s.product = '$idp' AND s.size = '$s'  "
                                            ) ;
                                              $sizeproduct = $query->getResult();

                                        $stock=  $sizeproduct[0]->getStock();       

                                        if ( $quantityproduct > $stock ){



 
      $message=      'La quantité pour le produit '.$idproduct->getDescription().' '.$idproduct->getCommentaire().' est trop importante pour notre stock. Veuillez le modifier ou passer plus tard.';
  

                      return $this->redirectToRoute('panier', array('message'=> $message) );
                  }



                    
                 

           }
             
 
              


 $commande = new Commandes;
$commandepanier = new CommandesPanier;

$form_commande = $this->createForm(CommandesType::class, new Commandes($totalcommande));
$form_commandepanier = $this->createForm(CommandesPanierType::class, new CommandesPanier($listPanier));

 if ($request->isMethod('POST')) {
$form_commande->handleRequest($request);


  $commande->setUser($user);
  $commande->setTotal($totalcommande);
  $commande->setTotaltva($totalcommande -($totalcommande / 1.2));
  $commande->setHt($totalcommande / 1.2);
  $commande->setCreatedAt(new \DateTime('now'));
    $commande->setUpdateAt(new \DateTime('now'));
    $commande->setStatus(1);

    $em = $this->getDoctrine()->getManager();
    $em->persist($commande);
    
    $em->flush();






$newcommande = $this->getDoctrine()->getRepository('AppBundle:Commandes')->findLastId($user);





  foreach ($listPanier as  $panier){
 $commandepanier = new CommandesPanier();
    $commandepanier->setCommandes($commande);
    $commandepanier->setPanier($panier);
    $commandepanier->setCreatedAt(new \DateTime('now'));
    $commandepanier->setUpdateAt(new \DateTime('now'));
    $commandepanier->setStatus(4);


    $em->persist($commandepanier);
   

  

      } 

  
$em->flush();




 foreach ($listPanier as  $panier){

   
    $panier->setUpdateAt(new \DateTime('now'));
    $panier->setStatus(1);


    $em->persist($panier);
   

  

      } 

  
$em->flush();


foreach ($listPanier as  $panier){
                                  $idproduct=$panier->getProduct();
                                  $idp= $idproduct->getId();
                                  $sizepanier=$panier->getSize();
                                  $sp= $sizepanier->getSize();
                                  $s=$sp->getId();
                                  $quantityproduct= $panier->getQuantity();
                         
                                          $query =$repository->createQuery(
                                               "SELECT s FROM AppBundle:SizeProduct s WHERE  s.status !=9  AND s.product = '$idp' AND s.size = '$s'  "
                                            ) ;
                                              $sizeproduct = $query->getResult();

                                        $stock=  $sizeproduct[0]->getStock();  

                                      $newstock= $stock -$quantityproduct;
   


                                      foreach($sizeproduct as $newsizeproduct){ 
                                         $newsizeproduct->setUpdateAt(new \DateTime('now'));
                                          $newsizeproduct->setStock($newstock);
                                      $em->persist($newsizeproduct);  


                                       }

$em->flush();

}



    $request->getSession()->getFlashBag()->add('notice', 'Cette commande a bien été enregistrée.');

    return $this->redirectToRoute('commande');

    }

}
	




    public function CommandeAction( Request $request)
    {


$user= $this->getUser();

$commande = $this->getDoctrine()->getRepository('AppBundle:Commandes')->findLastId($user);


$commandeId = $commande[0]->getId();


   $repository = $this
  ->getDoctrine()
  ->getManager();
$query =$repository->createQuery(
  "SELECT c FROM AppBundle:CommandesPanier c WHERE c.commandes ='$commandeId' AND c.status= 4 "
);
$commandepanier = $query->getResult();





return $this->render('AppBundle:Commande:commande.html.twig', array(
	    'title'=>'vos commandes'  ,     
        'commandepanier' => $commandepanier
      ));



}

public function CommandesAction( Request $request)
    {

$user= $this->getUser();
$userId= $user->getId();


   $repository = $this
  ->getDoctrine()
  ->getManager();
$query =$repository->createQuery(
  "SELECT c FROM AppBundle:Commandes c WHERE  c.user = '$userId' AND c.status= 1  "
);
$listCommandes = $query->getResult();



return $this->render('AppBundle:Commande:commandes.html.twig', array(
      'title'=>'vos commandes',     
        'listCommandes' => $listCommandes
      ));



}

public function VoirCommandeAction($id, Request $request)
    {

$user= $this->getUser();



   $repository = $this
  ->getDoctrine()
  ->getManager();
$query =$repository->createQuery(
  "SELECT c FROM AppBundle:CommandesPanier c WHERE  c.commandes = '$id' AND c.status= 4  "
);
$listCommandes = $query->getResult();



return $this->render('AppBundle:Commande:voircommande.html.twig', array(
      'title'=>'Ma Commande',     
        'listCommandes' => $listCommandes
      ));



}

public function pdfAction()
    {



$user= $this->getUser();

$commande = $this->getDoctrine()->getRepository('AppBundle:Commandes')->findLastId($user);


$commandeId = $commande[0]->getId();


   $repository = $this
  ->getDoctrine()
  ->getManager();
$query =$repository->createQuery(
  "SELECT c FROM AppBundle:CommandesPanier c WHERE c.commandes ='$commandeId' AND c.status= 4 "
);
$commandepanier = $query->getResult();



$pdf = new Html2Pdf('P', 'A4', 'fr');
    //On écrit dedans avec un template twig, en y passant les variables qu'on veux
      $pdf->writeHTML($this->renderView('AppBundle:Commande:pdf.html.twig', array(
              'commandepanier' => $commandepanier,
            )));
    
    //On renvoie en réponse la sortie du PDF
        return new Response($pdf->output('votrecommande.pdf'));






}


}
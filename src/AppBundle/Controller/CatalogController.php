<?php

namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Sport;
use AppBundle\Entity\League;
use AppBundle\Entity\Team;
use AppBundle\Entity\Category;
use AppBundle\Entity\Product;

class CatalogController extends Controller
{
 

    public function SportAction(Request $request)
    { 


$repository = $this
  ->getDoctrine()
  ->getManager();

$query =$repository->createQuery(
  'SELECT s FROM AppBundle:Sport s WHERE s.status != 9'
);



$listSport = $query->getResult();

     
      $content = $this
      ->get('templating')
      ->render('AppBundle:Catalog:sportcatalog.html.twig', array(
      	'title'=>'Tout nos sports',
      	'listSport' => $listSport));

      return new Response($content);

  }



    public function LeagueAction($id, Request $request)
    { 



$repository = $this
  ->getDoctrine()
  ->getManager();

$query =$repository->createQuery(
  "SELECT l FROM AppBundle:League l WHERE l.sport = '$id' AND l.status != 9"
);



$listLeague = $query->getResult();

     
      $content = $this
      ->get('templating')
      ->render('AppBundle:Catalog:leaguecatalog.html.twig', array(
      	'title'=>'Tout nos sports',
      	'listLeague' => $listLeague));

      return new Response($content);

  }



public function TeamAction($id, Request $request)
    { 



$repository = $this
  ->getDoctrine()
  ->getManager();

$query =$repository->createQuery(
  "SELECT t FROM AppBundle:Team t WHERE t.league = '$id' AND t.status != 9"
);



$listTeam = $query->getResult();

     
      $content = $this
      ->get('templating')
      ->render('AppBundle:Catalog:teamcatalog.html.twig', array(
      	'title'=>'Toutes les équipes',
      	'listTeam' => $listTeam));

      return new Response($content);

  }


public function CategoryAction($id, Request $request)
    { 



$repository = $this
  ->getDoctrine()
  ->getManager();

$query =$repository->createQuery(
  "SELECT c FROM AppBundle:Category c, AppBundle:Product p WHERE p.team = '$id' AND p.status != 9 AND c.id = p.category "
);



$listCategory = $query->getResult();

     
      $content = $this
      ->get('templating')
      ->render('AppBundle:Catalog:categorycatalog.html.twig', array(
      	'title'=>'Toutes les équipes',
      	'listCategory' => $listCategory,
        'idteam'=>$id));

      return new Response($content);

  }

public function ProductAction($id, $idteam, Request $request)
    { 



$repository = $this
  ->getDoctrine()
  ->getManager();

$query =$repository->createQuery(
  "SELECT p FROM  AppBundle:Product p WHERE p.category = '$id' AND p.team='$idteam'  AND p.status != 9 "
);



$listProduct = $query->getResult();

     
      $content = $this
      ->get('templating')
      ->render('AppBundle:Catalog:productcatalog.html.twig', array(
      	'title'=>'Toutes les équipes',
      	'listProduct' => $listProduct,
        ));

      return new Response($content);

  }

}



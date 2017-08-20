<?php

namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
class DashboardAdminController extends Controller
{
 

    public function dashboardAction()
    { 

     
      $content = $this
      ->get('templating')
      ->render('AppBundle:Admin:dashboard.html.twig', array('title'=>'Tableau de bord'));

      return new Response($content);

  }
}

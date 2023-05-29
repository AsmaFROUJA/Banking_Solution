<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class PageController extends AbstractController
{
   
  /**
     * @Route("/page", name="page")
     */
    public function index()
    {
        return $this->render('page/page.html.twig');
    }

    
/**  
     * @Route("/interface", name="interface")
     */
    //fonction afficher barre de recherche
    public function indexx(): Response
    {
        return $this->render('interfaceEtdainte/interface.html.twig');
    }




}

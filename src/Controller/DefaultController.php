<?php
 
// src/Controller/DefaultController.php
namespace App\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
 
class DefaultController extends Controller
{
    public function index()
    {
        return $this->render('home/home.html.twig');
    }
}
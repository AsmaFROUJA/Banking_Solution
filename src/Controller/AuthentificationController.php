<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Admin;

class AuthentificationController extends AbstractController

{   

    /**
    * @Route("/login", name="login", methods={"GET", "POST"})
    */
   public function login(Request $request): Response
   {
       $username = $request->request->get('username');
       $password = $request->request->get('password');

       $entityManager = $this->getDoctrine()->getManager();
       $userRepository = $entityManager->getRepository(Admin::class);
       $user = $userRepository->findOneBy([
           'login' => $username,
           'password' => $password,
       ]);

       if ($user) {
           $session = $request->getSession();
           $session->set('connected', 'oui');

    return $this->redirectToRoute('page');
       } else {
           return $this->render('authentification/login.html.twig', [
               'error' => 'Verifier votre login',
           ]);
       }
       
   }
}
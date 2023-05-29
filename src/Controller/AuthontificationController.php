<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Entity\Etudiant;

class AuthontificationController extends AbstractController
{   /**
    * @Route("/loginn", name="loginn", methods={"GET", "POST"})
    */
   public function loginn(Request $request): Response
   {
       $username = $request->request->get('username');
       $password = $request->request->get('Pasword');

       $entityManager = $this->getDoctrine()->getManager();
       $userRepository = $entityManager->getRepository(Etudiant::class);
       $user = $userRepository->findOneBy([
           'login' => $username,
           'password' => $password,
       ]);

       if ($user) {
           $session = $request->getSession();
           $session->set('connected', 'oui');

           return new RedirectResponse($this->generateUrl('interface'));
        } else {
           return $this->render('authontification/login.html.twig', ['error' => 'Verifier votre login',
           ]);
       }
       
   }







   
}
<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\FormNameCompteType;
use App\Form\FormNameEtudiantType;

use App\Form\FormNameAjoutCompteType;
use App\Entity\Compte;
use App\Entity\Etudiant;


class CompteController extends AbstractController
{
    /**
     * @Route("/compte", name="app_compte")
     */
    public function index(): Response
    {
        return $this->render('compte/index.html.twig', [
            'controller_name' => 'CompteController',
        ]);
    }
    
        /**
     * @Route("/ajoutcompte", name="ajoutcompte")
     */
    public function ajout(Request $request): Response 
    {
   
        $compte = new Compte();

        $form = $this->createForm(FormNameAjoutCompteType::class, $compte);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($compte); 
            $em->flush();

            return $this->redirectToRoute('listcompte');
        }
        return $this->render('compte/ajout.html.twig',['form'=>$form->createView()]);
    }


      /**
 * @Route("/listcompte", name="listcompte")
 */
public function affiche()
{
    $compte = $this->getDoctrine()->getRepository(Compte::class)->findAll();

    return $this->render('compte/list.html.twig', [
        'compte' => $compte,
    ]);
}
      /**
 * @Route("/afficheCompt/{cin}", name="afficheCompt")
 */
     public function afficheCompt($cin): Response
     {
         $compteRepository = $this->getDoctrine()->getRepository(Compte::class);
         $compts = $compteRepository->findBy(['cin' => $cin]);
 
         return $this->render('compte/affiche.html.twig', [
             
             'compts' => $compts,
         ]);
     }
/**
 * @Route("/modifcompte/{numero}", name="modifcompte", methods={"GET", "POST"})
 */
public function modifier(Request $request, Compte $compte): Response
{
    $form = $this->createForm(FormNameCompteType::class, $compte);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('listcompte');
    }

    return $this->render('compte/modifcompte.html.twig', [
        'form' => $form->createView(),
    ]);
}
    /**
 * @Route("suppcompte/{numero}", name="suppcompte")
 */
public function suppetudiant(Compte $compte)
{
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($compte);
    $entityManager->flush();

    return $this->redirectToRoute('listcompte');
}


/**
     * @Route("/affiche-compte", name="affiche_compte", methods={"GET"})
     */
    public function afficheCompte(Request $request): Response
    {
        $numeroCompte = $request->query->get('numero');

        // Recherche du compte en fonction du numéro de compte
        $repository = $this->getDoctrine()->getRepository(Compte::class);
        $compte = $repository->findOneBy(['numero' => $numeroCompte]);

        return $this->render('compte/afficheuncompte.html.twig', [
            'compte' => $compte,
        ]);
    }

}
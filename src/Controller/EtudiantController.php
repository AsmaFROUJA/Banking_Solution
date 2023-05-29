<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\EtudiantRepository;
use App\Entity\Etudiant;
use App\Form\FormNameEtudiantType;
use App\Controller\FormNameAjoutCompteType;



class EtudiantController extends AbstractController
{
    /**
     * @Route("/etudiant", name="app_etudiant")
     */
    public function index(): Response
    {
        return $this->render('etudiant/index.html.twig', [
            'controller_name' => 'EtudiantController',
        ]);
    }
      /**
 * @Route("/listetudiant", name="listetudiant")
 */
public function affiche()
{
    $etudiants = $this->getDoctrine()->getRepository(Etudiant::class)->findAll();

    return $this->render('etudiant/list.html.twig', [
        'etudiants' => $etudiants,
    ]);
}

/**
 * @Route("/modifetu/{cin}", name="modifetu", methods={"GET", "POST"})
 */
public function modifier(Request $request, Etudiant $etudiant): Response
{
    $form = $this->createForm(FormNameEtudiantType::class, $etudiant);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('listetudiant');
    }

    return $this->render('etudiant/modifetudiant.html.twig', [
        'form' => $form->createView(),
    ]);
}
    /**
 * @Route("suppetudiant/{cin}", name="suppetudiant")
 */
public function suppetudiant(Etudiant $etudiant)
{
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($etudiant);
    $entityManager->flush();

    return $this->redirectToRoute('listetudiant');
}
    }



        
    


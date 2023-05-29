<?php
namespace App\Controller;

use App\Entity\Etudiant;
use App\Form\InscriptionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;

class InscriptionController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription(Request $request)
    {
        $Etudiant = new Etudiant();
        $form = $this->createForm(InscriptionType::class, $Etudiant);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($Etudiant);
            $entityManager->flush();

            // Redirigez l'utilisateur vers une page de confirmation ou effectuez une autre action

            return $this->redirectToRoute('interface');
        }

        return $this->render('inscription/inscription.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}


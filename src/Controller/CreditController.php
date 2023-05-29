<?php
    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use App\Entity\Credit;
    use App\Entity\Demandecredit;
    use Symfony\Component\Routing\Annotation\Route;
    use App\Entity\Compte;
    use App\Form\FormNameCreditType;
    use App\Form\FormDemandeCreditType;
    use Doctrine\ORM\EntityManagerInterface;

    
    class CreditController extends AbstractController
    {
        
        /**
         * @Route("/listCredit", name="listCredit")
         */
        public function listDemandeCredit(Request $request)
        {
            $entityManager = $this->getDoctrine()->getManager();
            $demandeCreditRepository = $entityManager->getRepository(Demandecredit::class);
    
            $demandesCredit = $demandeCreditRepository->findAll();
    
            return $this->render('credit/listCredit.html.twig', [
                'demandesCredit' => $demandesCredit,
            ]);
        }
  /**
 * @Route("/acceptercredit/{idcredit}", name="acceptercredit")
 */
public function accepterCredit(Request $request, $idcredit)
{
    $entityManager = $this->getDoctrine()->getManager();
    $demandeCreditRepository = $entityManager->getRepository(Demandecredit::class);

    $demandeCredit = $demandeCreditRepository->find($idcredit);

    if (!$demandeCredit) {
        throw $this->createNotFoundException('Demande de crédit non trouvée.');
    }

    // Insérer dans la table "Credit"
    $credit = new Credit();
    $credit->setCin($demandeCredit->getCin());
    $credit->setMontant($demandeCredit->getMontant());
    $credit->setCause($demandeCredit->getCause());
    $credit->setNom($demandeCredit->getNom());
    $credit->setPrenom($demandeCredit->getPrenom());

    $compte = $demandeCredit->getNumero();
    $credit->setNumero($compte);

    $entityManager->persist($credit);
    $entityManager->flush();
    

    return $this->redirectToRoute('affichetousCridit');
}

/**
 * @Route("/refusercredit/{idcredit}", name="refusercredit")
 */
public function refuserCredit(Request $request, $idcredit)
{
    $entityManager = $this->getDoctrine()->getManager();
    $demandeCreditRepository = $entityManager->getRepository(Demandecredit::class);

    $demandeCredit = $demandeCreditRepository->find($idcredit);

    if (!$demandeCredit) {
        throw $this->createNotFoundException('Demande de crédit non trouvée.');
    }

    $entityManager->remove($demandeCredit);
    $entityManager->flush();

    return $this->redirectToRoute('listCredit');
}

    
/**
 * @Route("/affichetousCridit", name="affichetousCridit")
 */

 public function affichetousCridit()
 {
     $credit = $this->getDoctrine()->getRepository(Credit::class)->findAll();
 
     return $this->render('credit/afficheTous.html.twig', [
         'credit' => $credit,
     ]);
    }
/**
 * @Route("/modifCridit/{numero}", name="modifCridit", methods={"GET", "POST"})
 */
public function modifCridit(Request $request, Credit $credit): Response
{
    $form = $this->createForm(FormNameCreditType::class, $credit);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('affichetousCridit');
    }

    return $this->render('credit/modif.html.twig', [
        'form' => $form->createView(),
    ]);
}


/**
 * @Route("/supprimercridit/{numero}", name="supprimercridit")
 */
public function supprimercridit($numero)
{
    $entityManager = $this->getDoctrine()->getManager();
    $creditRepository = $entityManager->getRepository(Credit::class);

    $credit = $creditRepository->findOneBy(['numero' => $numero]);

    if (!$credit) {
        throw $this->createNotFoundException('Crédit non trouvé.');
    }

    $entityManager->remove($credit);
    $entityManager->flush();

    return $this->redirectToRoute('affichetousCridit');
}

    /**
     * @Route("/demande_credit", name="demande_credit")
     */
    public function demande_credit(Request $request, EntityManagerInterface $entityManager): Response
    {
        $demandeCredit = new Demandecredit();

        $form = $this->createForm(FormDemandeCreditType::class, $demandeCredit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Insérez la demande de crédit dans la table "Demandecredit"
            $entityManager->persist($demandeCredit);
            $entityManager->flush();

            // Affichez un message de succès
            $this->addFlash('success', 'La demande de crédit a été soumise avec succès.');

        }

        return $this->render('credit/demande.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}







    




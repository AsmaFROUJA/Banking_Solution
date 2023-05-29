<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Transaction;
use App\Entity\Compte;

use App\Form\FormNameTransactionType;

use Doctrine\ORM\EntityManagerInterface;

class TransactionController extends AbstractController
{
   


/**
     * @Route("/transaction", name="transaction")
     */
    
     public function operation(Request $request, EntityManagerInterface $entityManager): Response
     {
         $operation = new Transaction();
     
         $form = $this->createForm(FormNameTransactionType::class, $operation);
         $form->handleRequest($request);
     
         if ($form->isSubmitted() && $form->isValid()) {
             $operation = $form->getData();
             $compteNumero = $operation->getNumero(); // Récupérer le numéro de compte
     
             // Rechercher le compte correspondant au numéro
             $compte = $entityManager->getRepository(Compte::class)->findOneBy(['numero' => $compteNumero]);

             if ($compte) {
                 $type = $operation->getType();
                 $montant = $operation->getMontant();
     
                 if ($type === 'retrait') {
                     $solde = $compte->getSolde();
                        if ($solde>$montant)
                           return new Response('votre solde est insuffisante');
                        else{$compte->setSolde($solde - $montant);}
                 } 
                 elseif ($type === 'versement') {
                     $solde = $compte->getSolde();
                     $compte->setSolde($solde + $montant);

                 }
     
                 $entityManager->persist($compte);
                 $entityManager->flush();



                 return new Response('Operation Terminer'); 
             } else  // si le compte n'existe pas
                { $this->addFlash('error', 'Le compte spécifié est introuvable.'); 

             }
         }
     
         return $this->render('transaction/transaction.html.twig', [
             'form' => $form->createView(),
         ]);
     }
     



    }
    

   










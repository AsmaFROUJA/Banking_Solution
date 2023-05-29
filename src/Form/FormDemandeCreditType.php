<?php

namespace App\Form;
use App\Entity\Credit;
use App\Entity\Compte;
use App\Entity\Demandecredit;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class FormDemandeCreditType extends AbstractType
{

    
        public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('numero', EntityType::class, [
            'label' => 'numero : ',
            'class' => Compte::class,
            'choice_label' => 'numero',
            'required' => true,
        ])
        ->add('cin', IntegerType::class, [
            'label' => 'cin: ',
            'required' => true,
        ])
        ->add('montant', IntegerType::class, [
            'label' => 'montant: ',
            'required' => true,
        ]) 
        ->add('nom', TextType::class, [
            'label' => 'Nom: ',
            'required' => true,
        ])
        ->add('prenom', TextType::class, [
            'label' => 'Prenom: ',
            'required' => true,
        ])
        ->add('cause', TextType::class, [
            'label' => 'cause: ',
            'required' => true,
        ])
      
        
        
        ->add('submit', SubmitType::class, ['label' => 'Soumettre']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Demandecredit::class,
        ]);
    }

}

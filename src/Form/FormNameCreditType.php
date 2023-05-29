<?php
namespace App\Form;

use App\Entity\Credit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Compte;
use App\Entity\Etudiant;

class FormNameCreditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idcredit')
            ->add('nom')
            ->add('prenom')
            ->add('cause')
            ->add('cin')
            ->add('montant')
            ->add('numero', EntityType::class, ['class' => Compte::class, 'choice_label' => 'numero'])
            ->add('submit', SubmitType::class, ['label' => 'modifier'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Compte;
use App\Entity\Etudiant;

use App\Entity\Credit;

class FormNameCompteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('numero')
        ->add('nom')
        ->add('prenom')
        ->add('type')
        ->add('solde')
        ->add('statu')
        ->add('cin', EntityType::class, ['class' => Etudiant::class, 'choice_label' => 'cin'])
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

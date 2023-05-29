<?php

namespace App\Form;
use App\Entity\Etudiant;
use App\Entity\Compte;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           ->add('cin', IntegerType::class, [
                'label' => 'cin: ',
                'required' => true,
            ]) 
            ->add('nom', TextType::class, [
                'label' => 'Nom: ',
                'required' => true,
            ])
            ->add('prenom', TextType::class, [
                'label' => 'prenom: ',
                'required' => true,
            ])
            ->add('datenaissance', DateType::class, [
                'label' => 'date de naissance: ',
                'required' => true,
            ])
            ->add('telephone', IntegerType::class, [
                'label' => 'telephone: ',
                'required' => true,
            ])

            ->add('email', TextType::class, [
                'label' => 'email: ',
                'required' => true,
            ])
            ->add('adresse', TextType::class, [
                'label' => 'adresse: ',
                'required' => true,
            ])
            ->add('login', TextType::class, [
                'label' => 'login: ',
                'required' => true,
            ])
            ->add('password', PasswordType::class, [
                'label' => 'password: ',
                'required' => true,
            ])     
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
            ]);
        }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
<?php
namespace App\Form;
use App\Entity\Transaction;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FormNameTransactionType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('numero', TextType::class, ['label' => 'numero'])
        ->add('montant', IntegerType::class, ['label' => 'Montant'])
        ->add('type', ChoiceType::class, [
            'choices' => [
                'Retrait' => 'retrait',
                'Versement' => 'versement',
            ],
            'label' => 'Type',])     
            ->add('submit', SubmitType::class, ['label' => 'Terminer']);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Transaction::class,
        ]);
    }
}
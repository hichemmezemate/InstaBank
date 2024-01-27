<?php

namespace App\Form;

use App\Entity\Budget;
use App\Entity\Operation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OperationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('montant', NumberType::class, [
                'attr' => ['class' => 'm-2'],
                'html5' => true,
                'scale' => 2
            ])
            ->add('budget', EntityType::class, [
                'attr' => ['class' => 'm-2'],
                'class' => Budget::class,
                'choice_label' => function(Budget $budget) {
                    return $budget->getNom();
                }
            ])
            ->add('type', ChoiceType::class, [
                'attr' => ['class' => 'm-2'],
                'choices' => [
                    'Dépôt' => 'Dépôt',
                    'Retrait' => 'Retrait',
                ],
                'expanded' => false,
                'multiple' => false
            ])
            ->add('Confirmer', SubmitType::class, [
                'attr' => ['class' => 'btn btn-success']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Operation::class,
        ]);
    }
}

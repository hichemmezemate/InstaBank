<?php

namespace App\Form;

use App\Entity\Compte;
use App\Entity\TypeCompte;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThan;

class CompteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('solde', NumberType::class, [
                'attr' => ['class' => 'm-3'],
                'html5' => true,
                'scale' => 2,
                'constraints' => [
                    new GreaterThan([
                        'value' => 0,
                        'message' => 'Vous devez fournir un nombre positif'
                    ])
                ]
            ])
            ->add('type', EntityType::class, [
                'attr' => ['class' => 'm-3'],
                'class' => TypeCompte::class,
                'choice_label' => function(TypeCompte $typeCompte) {
                    return $typeCompte->getLibelle();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Compte::class,
        ]);
    }
}

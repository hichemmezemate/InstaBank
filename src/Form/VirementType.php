<?php

namespace App\Form;

use App\Entity\Compte;
use App\Entity\User;
use App\Repository\CompteRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThan;

class VirementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $options['user'];

        $builder
            ->add('debit', EntityType::class, [
                'attr' => ['class' => 'm-3'],
                'label' => 'Compte à débiter',
                'class' => Compte::class,
                'query_builder' => function(CompteRepository $repository) use($user) {
                    return $repository->createQueryBuilder('c')
                        ->where('c.user = :current_user')
                        ->setParameter('current_user', $user);
                },
                'choice_label' => function(Compte $compte) {
                    return $compte->getType()->getLibelle() . ' - ' . $compte->getSolde() . ' €';
                },
            ])
            ->add('credit', EntityType::class, [
                'attr' => ['class' => 'm-3'],
                'label' => 'Compte à créditer',
                'class' => Compte::class,
                'query_builder' => function(CompteRepository $repository) use($user) {
                    return $repository->createQueryBuilder('c')
                        ->where('c.user = :current_user')
                        ->setParameter('current_user', $user);
                },
                'choice_label' => function(Compte $compte) {
                    return $compte->getType()->getLibelle() . ' - ' . $compte->getSolde() . ' €';
                },
            ])
            ->add('montant', NumberType::class, [
                'attr' => ['class' => 'm-3'],
                'html5' => true,
                'scale' => 2,
                'constraints' => [
                    new GreaterThan([
                        'value' => 0,
                        'message' => 'Vous devez entrer un nombre positif'
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setRequired('user')
            ->setAllowedTypes('user', User::class);
    }
}

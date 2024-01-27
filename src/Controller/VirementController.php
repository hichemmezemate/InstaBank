<?php

namespace App\Controller;

use App\Entity\Operation;
use App\Form\VirementType;
use App\Repository\CompteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VirementController extends AbstractController
{
    #[Route('/virement', name: 'app_virement')]
    public function index(Request $request, CompteRepository $compteRepository, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(VirementType::class, null, ['user' => $this->getUser()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $compte_debit = $compteRepository->findOneBy(['id' => $form->get('debit')->getData()]);
            $compte_credit = $compteRepository->findOneBy(['id' => $form->get('credit')->getData()]);

            if ($compte_debit !== $compte_credit) {
                $compte_debit->setSolde($compte_debit->getSolde() - $form->get('montant')->getData());
                $compte_credit->setSolde($compte_credit->getSolde() + $form->get('montant')->getData());

                $operation_debit = new Operation();
                $operation_debit->setCompte($compte_debit);
                $operation_debit->setMontant($form->get('montant')->getData());
                $operation_debit->setDate(new \DateTime('now'));
                $operation_debit->setType('Virement envoyé au ' . $compte_credit->getType()->getLibelle());

                $operation_credit = new Operation();
                $operation_credit->setCompte($compte_credit);
                $operation_credit->setMontant($form->get('montant')->getData());
                $operation_credit->setDate(new \DateTime('now'));
                $operation_credit->setType('Virement reçu depuis le ' . $compte_debit->getType()->getLibelle());

                $manager->persist($compte_debit);
                $manager->persist($compte_credit);
                $manager->persist($operation_debit);
                $manager->persist($operation_credit);
                $manager->flush();

                $this->addFlash('success','Votre virement a bien été effectué');
                return $this->redirectToRoute('app_home');
            } else {
                $this->addFlash('warning','Saisissez 2 comptes différents');
            }
        }

        return $this->render('virement/index.html.twig', [
            'controller_name' => 'VirementController',
            'form' => $form->createView(),
        ]);
    }
}

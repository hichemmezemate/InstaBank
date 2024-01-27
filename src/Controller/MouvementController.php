<?php

namespace App\Controller;

use App\Entity\Operation;
use App\Form\OperationType;
use App\Repository\CompteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MouvementController extends AbstractController
{
    #[Route('/mouvement/{id}', name: 'app_mouvement')]
    public function index(int $id, Request $request, CompteRepository $compteRepository, EntityManagerInterface $manager): Response
    {
        $compte = $compteRepository->find($id);
        $form = $this->createForm(OperationType::class, null);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $montantIndique = $form->get('montant')->getData();

            if ($form->get('type')->getData() == "Dépôt") {
                $compte->setSolde($compte->getSolde() + $montantIndique);
            } else {
                $compte->setSolde($compte->getSolde() - $montantIndique);
            }

            $operation = new Operation();
            $operation->setCompte($compte);
            $operation->setMontant($montantIndique);
            $operation->setDate(new \DateTime('now'));
            $operation->setType($form->get('type')->getData());
            $operation->setBudget($form->get('budget')->getData());
            // Persiste et flush toutes les données précédemment modifiées ou ajoutées
            $manager->persist($compte);
            $manager->persist($operation);
            $manager->flush($compte);
            $this->addFlash('success','Votre opération a bien été effectué.');
            return $this->redirectToRoute('app_home');
        }

        return $this->render('mouvement/index.html.twig', [
            'form' => $form->createView(),
            'compte' => $compte,
        ]);
    }
}

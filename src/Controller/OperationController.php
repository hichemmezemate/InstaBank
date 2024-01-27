<?php

namespace App\Controller;

use App\Entity\Operation;
use App\Entity\Search;
use App\Form\OperationType;
use App\Form\SearchType;
use App\Repository\OperationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/operation')]
class OperationController extends AbstractController
{
    #[Route('/{id}', name: 'app_operation_index', methods: ['GET'])]
    public function index(OperationRepository $operationRepository, int $id, Request $request): Response
    {
        $data = new Search();
        $data->page = $request->get('page',1);
        $form = $this->createForm(SearchType::class, $data);
        $form->handleRequest($request);

        return $this->render('operation/index.html.twig', [
            'operations' => $operationRepository->findSearch($id, $data),
            'form' => $form->createView()
        ]);
    }
}

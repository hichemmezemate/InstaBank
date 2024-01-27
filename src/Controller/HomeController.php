<?php

namespace App\Controller;

use App\Repository\CompteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CompteRepository $compteRepository): Response
    {
        $user = $this->getUser();
        $mescomptes = $compteRepository->findBy(['user' => $user]);
        $nbComptes = count($mescomptes);

        return $this->render('home/index.html.twig', [
            'user' => $user,
            'mescomptes' => $mescomptes,
            'nbComptes' => $nbComptes
        ]);
    }
}

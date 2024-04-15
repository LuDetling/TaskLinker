<?php

namespace App\Controller;

use App\Repository\ProjetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ProjetRepository $repository): Response
    {
        $projets = $repository->findAll();
        return $this->render('home/home.html.twig', [
            'projets' => $projets
        ]);
    }
}

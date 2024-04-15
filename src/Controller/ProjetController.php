<?php

namespace App\Controller;

use App\Repository\ProjetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProjetController extends AbstractController
{
    #[Route('/projet/{id}', name: 'projet')]
    public function index(ProjetRepository $repository, int $id): Response
    {

        $projet = $repository->find($id);
        return $this->render('projet/index.html.twig', [
            'projet' => $projet
        ]);
    }
}

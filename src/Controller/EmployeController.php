<?php

namespace App\Controller;

use App\Repository\EmployeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EmployeController extends AbstractController
{
    #[Route('/employes', name: 'employes')]
    public function index(EmployeRepository $repository): Response
    {
        $employes = $repository->findAll();

        return $this->render('employe/employes.html.twig', [
            'employes' => $employes
        ]);
    }
}

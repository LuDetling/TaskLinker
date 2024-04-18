<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Form\ProjetType;
use App\Repository\EmployeRepository;
use App\Repository\ProjetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProjetController extends AbstractController
{

    #[Route('/projet/{id}', name: 'projet')]
    public function projet(ProjetRepository $repository, int $id): Response
    {

        $projet = $repository->find($id);
        return $this->render('projet/projet.html.twig', [
            'projet' => $projet
        ]);
    }

    #[Route('/createProjet', name: 'createProjet', methods: ["POST", "GET"])]
    public function createProjet(EmployeRepository $employeRepository)
    {
        $employes = $employeRepository->findAll();
        $projet = new Projet();
        $form = $this->createForm(ProjetType::class, $projet);

        return $this->render('projet/createProjet.html.twig', [
            "employes" => $employes,
            "form" => $form
        ]);
    }
}

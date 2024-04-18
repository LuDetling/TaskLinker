<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Form\ProjetType;
use App\Repository\EmployeRepository;
use App\Repository\ProjetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProjetController extends AbstractController
{

    #[Route('/projet/{id}', name: 'projet')]
    public function projet(ProjetRepository $projetRepository, EmployeRepository $employeRepository, int $id): Response
    {

        $employes = $employeRepository->findEmployeByProjetId($id);
        var_dump($employes);
        $projet = $projetRepository->find($id);
        return $this->render('projet/projet.html.twig', [
            'projet' => $projet,
            'employes' => $employes
        ]);
    }

    #[Route('/createProjet', name: 'createProjet', methods: ["POST", "GET"])]
    public function createProjet(Request $request, EntityManagerInterface $em, EmployeRepository $repository)
    {
        $employes = $repository->findAll();
        $projet = new Projet();
        $form = $this->createForm(ProjetType::class, $projet);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($projet);
            $em->flush();
            $this->addFlash("succes", "Vous avez créé un nouveau projet");
            return $this->redirectToRoute("home");
        }

        return $this->render('projet/createProjet.html.twig', [
            "employes" => $employes,
            "form" => $form
        ]);
    }
}

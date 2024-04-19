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
    public function projet(ProjetRepository $projetRepository, int $id): Response
    {

        $projet = $projetRepository->find($id);
        $employes = $projet->getEmployes();

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

    #[Route('/editProjet/{id}', 'editProjet', methods: ["GET", "POST"])]
    public function editProjet(Request $request, Projet $projet, EntityManagerInterface $em)
    {
        $employes = $projet->getEmployes();

        $form = $this->createForm(ProjetType::class, $projet);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute("projet", ["id" => $projet->getId()]);
        }
        return $this->render('projet/editProjet.html.twig', [
            "projet" => $projet,
            "employes" => $employes,
            "form" => $form
        ]);
    }
    #[Route('/deleteProjet/{id}', 'deleteProjet', methods: ['GET'])]
    public function deleteProjet(Projet $projet, EntityManagerInterface $em)
    {
        $em->remove($projet);
        $em->flush();
        return $this->redirectToRoute("home");
    }
}

<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Entity\Tache;
use App\Form\TacheType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TacheController extends AbstractController
{

    #[Route('/projet/{id}/createTache', name: 'createTache', methods: ['GET', 'POST'])]
    public function createTache(Request $request, EntityManagerInterface $em, Projet $projet)
    {
        $tache = new Tache();
        $form = $this->createForm(TacheType::class, $tache, ['employes' => $projet->getEmploye()]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $tache->setProjet($projet);
            $em->persist($tache);
            $em->flush();
            $this->addFlash("succes", "Vous avez créé une nouvelle tâche");
            return $this->redirectToRoute("projet", ['id' => $tache->getProjet()->getId()]);
        }

        return $this->render('tache/createTache.html.twig', [
            "tache" => $tache,
            "form" => $form,
        ]);
    }

    #[Route('/editTache/{id}', name: 'editTache', methods: ['GET', 'POST'])]
    public function editTache(Request $request, EntityManagerInterface $em, Tache $tache): Response
    {
        if (!$tache) return $this->redirectToRoute("projets");

        $projet = $tache->getProjet();
        $form = $this->createForm(TacheType::class, $tache, ['employes' => $projet->getEmploye()]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute("projet", ['id' => $tache->getProjet()->getId()]);
        }

        return $this->render('tache/editTache.html.twig', [
            "tache" => $tache,
            "form" => $form
        ]);
    }

    #[Route('/deleteTache/{id}', name: 'deleteTache', methods: ["GET"])]
    public function deleteTache(Tache $tache, EntityManagerInterface $em)
    {
        $em->remove($tache);
        $em->flush();
        return $this->redirectToRoute("projet", ['id' => $tache->getProjet()->getId()]);
    }
}

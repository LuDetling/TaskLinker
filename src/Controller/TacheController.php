<?php

namespace App\Controller;

use App\Entity\Tache;
use App\Form\TacheType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TacheController extends AbstractController
{

    #[Route('/createTache', name: 'createTache', methods: ['GET', 'POST'])]
    public function createTache(Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(TacheType::class,);
    }

    #[Route('/editTache/{id}', name: 'editTache', methods: ['GET', 'POST'])]
    public function editTache(Request $request, EntityManagerInterface $em, Tache $tache): Response
    {

        if (!$tache) return $this->redirectToRoute("projets");

        $form = $this->createForm(TacheType::class, $tache);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute("projets");
        }

        return $this->render('tache/editTache.html.twig', [
            "tache" => $tache,
            "form" => $form
        ]);
    }
}

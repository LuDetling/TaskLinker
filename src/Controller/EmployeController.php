<?php

namespace App\Controller;

use App\Entity\Employe;
use App\Form\EmployeType;
use App\Repository\EmployeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/editEmploye/{id}', 'editEmploye', methods: ['GET', 'POST'])]
    public function editEmploye(Request $request, EntityManagerInterface $em, Employe $employe)
    {
        $form = $this->createForm(EmployeType::class, $employe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('employes');
        }

        return $this->render("employe/editEmploye.html.twig", [
            "employe" => $employe,
            "form" => $form
        ]);
    }

    #[Route('/deleteEmploye/{id}', 'deleteEmploye', methods: ['GET'])]
    public function deleteEmploye(EntityManagerInterface $em, Employe $employe)
    {
        $em->remove($employe);
        $em->flush();
        return $this->redirectToRoute('employes');
    }
}

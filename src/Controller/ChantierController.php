<?php

namespace App\Controller;

use App\Entity\Chantier;
use App\Entity\User;
use App\Entity\Pointage;
use App\Form\ChantierType;
use App\Repository\ChantierRepository;
use App\Repository\UserRepository;
use App\Repository\PointageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ChantierController extends AbstractController
{
    private $chantierRepository;
    private $entityManager;

    public function __construct(ChantierRepository $chantierRepository, EntityManagerInterface $entityManager)
    {
        $this->chantierRepository = $chantierRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('/chantier', name: 'chantier_index', methods: ['GET'])]
    public function index(): Response
    {
        $chantiers = $this->chantierRepository->findAll();

        return $this->render('chantier/index.html.twig', [
            'chantiers' => $chantiers,
        ]);
    }

    #[Route('/chantier/new', name: 'chantier_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $chantier = new Chantier();
        $form = $this->createForm(ChantierType::class, $chantier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($chantier);
            $this->entityManager->flush();

            return $this->redirectToRoute('chantier_index');
        }

        return $this->render('chantier/new.html.twig', [
            'chantier' => $chantier,
            'form' => $form->createView(),
        ]);
    }
    
    #[Route('/chantier/{id}', name: 'chantier_show', methods: ['GET'])]
    public function show(Chantier $chantier): Response
    {
        $nombrePersonnesPointees = $this->chantierRepository->getNombrePersonnesPointees($chantier);
        $nombreHeuresCumuleesPointees = $this->chantierRepository->getNombreHeuresCumuleesPointees($chantier);
        
        return $this->render('chantier/show.html.twig', [
            'chantier' => $chantier,
            'nombre_personnes_pointees' => $nombrePersonnesPointees,
            'nombre_heures_cumulees_pointees' => $nombreHeuresCumuleesPointees,
        ]);
    }

    #[Route('/chantier/{id}/edit', name: 'chantier_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Chantier $chantier): Response
    {
        $form = $this->createForm(ChantierType::class, $chantier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('chantier_index');
        }

        return $this->render('chantier/edit.html.twig', [
            'chantier' => $chantier,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/chantier/{id}', name: 'chantier_delete', methods: ['DELETE'])]
    public function delete(Request $request, Chantier $chantier): Response
    {
        if ($this->isCsrfTokenValid('delete'.$chantier->getId(), $request->request->get('_token'))) {
            $this->entityManager->remove($chantier);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('chantier_index');
    }
}

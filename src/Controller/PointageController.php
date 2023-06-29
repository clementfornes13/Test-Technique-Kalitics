<?php

namespace App\Controller;

use App\Entity\Pointage;
use App\Entity\User;
use App\Entity\Chantier;
use App\Form\PointageType;
use App\Repository\ChantierRepository;
use App\Repository\UserRepository;
use App\Repository\PointageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class PointageController extends AbstractController
{
    private $userRepository;

    public function __construct(UserRepository $userRepository, ChantierRepository $chantierRepository, PointageRepository $pointageRepository, EntityManagerInterface $entityManager)
    {
        $this->pointageRepository = $pointageRepository;
        $this->userRepository = $userRepository;
        $this->chantierRepository = $chantierRepository;
        $this->entityManager = $entityManager;
    }
    #[Route('/pointage', name: 'pointage_index', methods: ['GET'])]
    public function index(PointageRepository $pointageRepository): Response
    {
        $pointages = $pointageRepository->findAll();
        
        return $this->render('pointage/index.html.twig', [
            'pointages' => $pointages,
        ]);
    }
    #[Route('/pointage/new', name: 'pointage_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator, PointageRepository $pointageRepository): Response
    {
        $pointage = new Pointage();
        $form = $this->createForm(PointageType::class, $pointage);
        $form->handleRequest($request);
        $errors = null;
        if ($form->isSubmitted() && $form->isValid()) {
            $errors = $validator->validate($pointage);
    
            if (count($errors) === 0) {
                $matricule = $form->get('utilisateur')->getData()->getMatricule();
                $utilisateur = $this->userRepository->findUserByMatricule($matricule);
                
                if (!$utilisateur) {
                    throw new \Exception('Utilisateur non trouvé.');
                }
                
    
                $pointage->setUtilisateur($utilisateur);
    
                $existingPointage = $pointageRepository->findOneBy([
                    'date' => $pointage->getDate(),
                    'utilisateur' => $pointage->getUtilisateur(),
                ]);
                if ($existingPointage) {
                    $this->addFlash('error', 'Le pointage pour cet utilisateur à cette date existe déjà.');
                    return $this->redirectToRoute('pointage_index');
                }
    
                $weekStart = (clone $pointage->getDate())->modify('monday this week');
                $weekEnd = (clone $pointage->getDate())->modify('sunday this week');
    
                $totalHoursThisWeek = $pointageRepository->getTotalHoursForUserInWeek(
                    $pointage->getUtilisateur()->getId(),
                    $weekStart,
                    $weekEnd
                );
                $currentPointageHours = $pointage->getDureeInMinutes() / 60;
                if (($totalHoursThisWeek + $currentPointageHours) > 35) {
                    $this->addFlash('error', 'La somme des pointages de cette semaine dépasse 35 heures.');
                    return $this->redirectToRoute('pointage_index');
                }
    
                $entityManager->persist($pointage);
                $entityManager->flush();
    
                return $this->redirectToRoute('pointage_index');
            }
        }
        $utilisateurs = $this->userRepository->findAll();
        $chantiers = $this->chantierRepository->findAll();
    
        return $this->render('pointage/new.html.twig', [
            'pointage' => $pointage,
            'form' => $form->createView(),
            'errors' => $errors ?? null,
            'utilisateurs' => $utilisateurs,
            'chantiers' => $chantiers,
        ]);
    }
    
    #[Route('/pointage/{id}', name: 'pointage_delete', methods: ['DELETE'])]
    public function delete(Request $request, Pointage $pointage, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pointage->getId(), $request->request->get('_token'))) {
            $entityManager->remove($pointage);
            $entityManager->flush();
        }
    
        return $this->redirectToRoute('pointage_index');
    }    

}
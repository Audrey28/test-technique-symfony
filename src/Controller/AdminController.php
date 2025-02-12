<?php

namespace App\Controller;

use App\Entity\Specialist;
use App\Form\SpecialistType;
use App\Repository\SpecialistRepository;
use App\Repository\AppelRepository;
use Doctrine\ORM\EntityManagerInterface; 

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;



// Définit /admin comme base pour toutes les routes du contrôleur.
#[Route('/admin', name:'admin_')]
class AdminController extends AbstractController
{

    private $entityManager; 

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager; 
    }

    #[Route('/', name: 'specialist_list')]
    public function list(SpecialistRepository $specialistRepository): Response
    {
        return $this->render('admin/specialists.html.twig', [
            'specialists' => $specialistRepository->findAll(),
        ]);
    }

    #[Route('/specialist/new', name: 'specialist_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $specialist = new Specialist();
        $form = $this->createForm(SpecialistType::class, $specialist);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($specialist);
            $entityManager->flush();

            $this->addFlash('success', 'Le psychologue a été ajouté avec succès.');

            return $this->redirectToRoute('admin_specialist_list');
        }

        return $this->render('admin/specialist_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/appels', name: 'appels_list')]
    public function listAppels(AppelRepository $appelRepository): Response
    {
        return $this->render('admin/appels.html.twig', [
            'appels' => $appelRepository->findAll(),
        ]);
    }
}

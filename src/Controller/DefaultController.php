<?php

namespace App\Controller;

use App\Entity\Specialist;
use Doctrine\ORM\EntityManagerInterface; 
use App\Entity\Appel;
use App\Repository\SpecialistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    private $entityManager;
    
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager; 
    }
    
    #[Route('/', name: 'app_homepage')]
    public function index(SpecialistRepository $specialistRepository): Response
    {
        return $this->render('default/index.html.twig', [
            'specialists' => $specialistRepository->findAllOrderedByOnline(),
        ]);
    }

    #[Route('/specialist/{id}', name: 'specialist_detail')]
    public function detail(Specialist $specialist): Response
    {
        return $this->render('default/detail.html.twig', [
            'specialist' => $specialist, 
        ]);
    }

    #[Route('/call/{id}', name: 'specialist_call')]
    public function call(Specialist $specialist, EntityManagerInterface $entityManager): Response
    {
        $appel = new Appel();
        $appel->setDate(new \DateTime());
        $appel->setSpecialist($specialist);

        $entityManager->persist($appel);
        $entityManager->flush();

        $this->addFlash('success', 'L\'appel a été enregistré avec succès.');

        return $this->redirectToRoute('app_homepage'); // Redirection vers l'accueil
    }

}

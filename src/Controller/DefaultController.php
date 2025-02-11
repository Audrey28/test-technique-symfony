<?php

namespace App\Controller;

use App\Entity\Specialist;
use App\Repository\SpecialistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
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
}

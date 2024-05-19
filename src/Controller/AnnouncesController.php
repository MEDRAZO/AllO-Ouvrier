<?php

namespace App\Controller;

use App\Repository\AnnouncesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[isGranted('ROLE_USER')]
class AnnouncesController extends AbstractController
{
    #[Route('/announces', name: 'app_announces')]
    public function index(AnnouncesRepository $announcesRepository): Response
    {
        $announces = $announcesRepository->findAll();

        return $this->render('announces/index.html.twig', [
            'user' => $this->getUser(),
            'announces' => $announces,
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Announces;
use App\Form\AnnouncesType;
use App\Repository\AnnouncesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/announces/me', name: 'app_announces_me')]
    public function mine(AnnouncesRepository $announcesRepository): Response
    {
        $announces = $announcesRepository->findBy(['client' => $this->getUser()]);

        return $this->render('announces/mine.html.twig', [
            'user' => $this->getUser(),
            'announces' => $announces,
        ]);
    }

    #[Route('/announces/add', name: 'app_announces_add')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $announces = new Announces();
        $form = $this->createForm(AnnouncesType::class, $announces);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $announces = $form->getData();
            $announces->setClient($this->getUser());
            $announces->setCreatedAt(new \DateTimeImmutable());
            $announces->setViews(0);
            $announces->setSells(0);

            $entityManager->persist($announces);
            $entityManager->flush();

            return $this->redirectToRoute('app_announces');
        }

        return $this->render('announces/add.html.twig', [
            'user' => $this->getUser(),
            'form' => $form,
        ]);
    }

    #[Route('/announces/{id}', name: 'app_announces_show')]
    public function details(Announces $announce): Response
    {
        return $this->render('announces/details.html.twig', [
            'user' => $this->getUser(),
            'announce' => $announce,
        ]);
    }

    #[Route('/announces/changeStatus/{id}', name: 'app_announces_edit_status')]
    public function changeStatus(Announces $announces, EntityManagerInterface $entityManager): Response
    {
        if ($announces->getStatus() == "1") {
            $announces->setStatus("0");
        } else {
            $announces->setStatus("1");
        }

        $entityManager->persist($announces);
        $entityManager->flush();

        return $this->redirectToRoute('app_announces_me');
    }
}

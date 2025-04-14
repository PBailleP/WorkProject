<?php

namespace App\Controller;

use App\Entity\Dinosaurs;
use App\Form\DinosaursType;
use App\Repository\DinosaursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/dinosaurs')]
final class DinosaursController extends AbstractController
{
    #[Route('/', name: 'home', methods: ['GET'])]
    public function index(DinosaursRepository $dinosaursRepository): Response
    {
        return $this->render('dinosaurs/index.html.twig', [
            'dinosaurs' => $dinosaursRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_dinosaurs_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $dinosaur = new Dinosaurs();
        $form = $this->createForm(DinosaursType::class, $dinosaur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($dinosaur);
            $entityManager->flush();

            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('dinosaurs/new.html.twig', [
            'dinosaur' => $dinosaur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dinosaurs_show', methods: ['GET'])]
    public function show(Dinosaurs $dinosaur): Response
    {
        return $this->render('dinosaurs/show.html.twig', [
            'dinosaur' => $dinosaur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_dinosaurs_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Dinosaurs $dinosaur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DinosaursType::class, $dinosaur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('dinosaurs/edit.html.twig', [
            'dinosaur' => $dinosaur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dinosaurs_delete', methods: ['POST'])]
    public function delete(Request $request, Dinosaurs $dinosaur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dinosaur->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($dinosaur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/cool-dinosaurs/{cool}', name: 'dinosaurs_by_cool', requirements: ['cool' => '0|1'])]
    public function byCoolStatus(bool $cool, DinosaursRepository $dinoRepo): Response
    {
        $dinosaurs = $dinoRepo->findByCoolStatus($cool);

        return $this->render('dinosaurs/index.html.twig', [
            'dinosaurs' => $dinosaurs,
        ]);
    }

}

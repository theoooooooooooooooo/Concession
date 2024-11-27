<?php

namespace App\Controller;

use App\Entity\Mecanicien;
use App\Form\MecanicienType;
use App\Repository\MecanicienRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/mecanicien')]
final class MecanicienController extends AbstractController{
    #[Route(name: 'app_mecanicien_index', methods: ['GET'])]
    public function index(MecanicienRepository $mecanicienRepository): Response
    {
        return $this->render('mecanicien/index.html.twig', [
            'mecaniciens' => $mecanicienRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_mecanicien_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $mecanicien = new Mecanicien();
        $form = $this->createForm(MecanicienType::class, $mecanicien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($mecanicien);
            $entityManager->flush();

            return $this->redirectToRoute('app_mecanicien_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('mecanicien/new.html.twig', [
            'mecanicien' => $mecanicien,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mecanicien_show', methods: ['GET'])]
    public function show(Mecanicien $mecanicien): Response
    {
        return $this->render('mecanicien/show.html.twig', [
            'mecanicien' => $mecanicien,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_mecanicien_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Mecanicien $mecanicien, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MecanicienType::class, $mecanicien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_mecanicien_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('mecanicien/edit.html.twig', [
            'mecanicien' => $mecanicien,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mecanicien_delete', methods: ['POST'])]
    public function delete(Request $request, Mecanicien $mecanicien, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mecanicien->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($mecanicien);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_mecanicien_index', [], Response::HTTP_SEE_OTHER);
    }
}

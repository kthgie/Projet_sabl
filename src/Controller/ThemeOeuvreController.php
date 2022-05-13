<?php

namespace App\Controller;

use App\Entity\ThemeOeuvre;
use App\Form\ThemeOeuvreType;
use App\Repository\ThemeOeuvreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/theme-oeuvre')]
class ThemeOeuvreController extends AbstractController
{
    #[Route('/', name: 'app_theme_oeuvre_index', methods: ['GET'])]
    public function index(ThemeOeuvreRepository $themeOeuvreRepository): Response
    {
        return $this->render('theme_oeuvre/index.html.twig', [
            'theme_oeuvres' => $themeOeuvreRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_theme_oeuvre_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ThemeOeuvreRepository $themeOeuvreRepository): Response
    {
        $themeOeuvre = new ThemeOeuvre();
        $form = $this->createForm(ThemeOeuvreType::class, $themeOeuvre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $themeOeuvreRepository->add($themeOeuvre, true);

            return $this->redirectToRoute('app_theme_oeuvre_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('theme_oeuvre/new.html.twig', [
            'theme_oeuvre' => $themeOeuvre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_theme_oeuvre_show', methods: ['GET'])]
    public function show(ThemeOeuvre $themeOeuvre): Response
    {
        return $this->render('theme_oeuvre/show.html.twig', [
            'theme_oeuvre' => $themeOeuvre,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_theme_oeuvre_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ThemeOeuvre $themeOeuvre, ThemeOeuvreRepository $themeOeuvreRepository): Response
    {
        $form = $this->createForm(ThemeOeuvreType::class, $themeOeuvre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $themeOeuvreRepository->add($themeOeuvre, true);

            return $this->redirectToRoute('app_theme_oeuvre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('theme_oeuvre/edit.html.twig', [
            'theme_oeuvre' => $themeOeuvre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_theme_oeuvre_delete', methods: ['POST'])]
    public function delete(Request $request, ThemeOeuvre $themeOeuvre, ThemeOeuvreRepository $themeOeuvreRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$themeOeuvre->getId(), $request->request->get('_token'))) {
            $themeOeuvreRepository->remove($themeOeuvre, true);
        }

        return $this->redirectToRoute('app_theme_oeuvre_index', [], Response::HTTP_SEE_OTHER);
    }
}

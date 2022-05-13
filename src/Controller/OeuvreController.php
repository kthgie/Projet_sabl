<?php

namespace App\Controller;

use App\Entity\Oeuvre;
use App\Form\OeuvreType;
use App\Repository\OeuvreRepository;
use DateTime;
use PhpParser\Node\Scalar\MagicConst\File;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File as FileFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[Route('/oeuvre')]
class OeuvreController extends AbstractController
{
    #[Route('/', name: 'app_oeuvre_index', methods: ['GET'])]
    public function index(OeuvreRepository $oeuvreRepository): Response
    {
        return $this->render('oeuvre/index.html.twig', [
            'oeuvres' => $oeuvreRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_oeuvre_new', methods: ['GET', 'POST'])]
    public function new(Request $request, OeuvreRepository $oeuvreRepository): Response
    {
        $oeuvre = new Oeuvre();
        $form = $this->createForm(OeuvreType::class, $oeuvre);
        $form->handleRequest($request);
        $oeuvre->setCreatedAt(new DateTime('now'))->setModifiedAt(new DateTime('now'));


        if ($form->isSubmitted() && $form->isValid()) {
            $monImage = $form->get('image')->getData();

            $id = $oeuvreRepository->add($oeuvre, true);

            if ($monImage) {
                $newImage = 'image' . $id . '.' . $monImage->guessExtension();

                try {
                    $monImage->move(
                        $this->getParameter('new_image'),
                        $newImage
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
            }

            return $this->redirectToRoute('app_oeuvre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('oeuvre/new.html.twig', [
            'oeuvre' => $oeuvre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_oeuvre_show', methods: ['GET'])]
    public function show(Oeuvre $oeuvre): Response
    {
        return $this->render('oeuvre/show.html.twig', [
            'oeuvre' => $oeuvre,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_oeuvre_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Oeuvre $oeuvre, OeuvreRepository $oeuvreRepository): Response
    {
        $form = $this->createForm(OeuvreType::class, $oeuvre);
        $form->handleRequest($request);
        $oeuvre->setModifiedAt(new DateTime('now'));

        if ($form->isSubmitted() && $form->isValid()) {
            $monImage = $form->get('image')->getData();
            $id = $oeuvreRepository->add($oeuvre, true);

            if ($monImage) {
                $oldImage = new FileFile('uploads/images/image' . $id . '.jpg');
var_dump(pathinfo('../public/uploads/images/image7.jpg')); die;

                $newImage = 'image' . $id . '.' . $monImage->guessExtension();

                try {
                    // $oldimage->unlink(
                    //     $this->getParameter('garbage'),
                    //     $oldImage
                    // );
                    $monImage->move(
                        $this->getParameter('new_image'),
                        $newImage
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
            }

            return $this->redirectToRoute('app_oeuvre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('oeuvre/edit.html.twig', [
            'oeuvre' => $oeuvre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_oeuvre_delete', methods: ['POST'])]
    public function delete(Request $request, Oeuvre $oeuvre, OeuvreRepository $oeuvreRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $oeuvre->getId(), $request->request->get('_token'))) {
            $oeuvreRepository->remove($oeuvre, true);
        }

        return $this->redirectToRoute('app_oeuvre_index', [], Response::HTTP_SEE_OTHER);
    }
}

<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/updateuser/{id}', name: 'app_update_user', methods: 'GET')]
    public function index(ManagerRegistry $doctrine, int $id, Request $request): Response
    {
        $entityManager = $doctrine->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);
        $form = $this->createForm(User::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $user->setRoles([$form['']]);

        }
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}

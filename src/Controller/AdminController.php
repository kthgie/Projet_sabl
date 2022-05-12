<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $users = $doctrine->getRepository(User::class)->findAll();
        //dd($users[0]->getRoles());

        foreach ($users as $user) {
            $roles = $user->getRoles();
            $user->main_role = $this->ttt($roles);
        }
        if (!$users) {
            throw $this->createNotFoundException(
                'No users found...'
            );
        }
        return $this->render('admin/index.html.twig', [
            'users' => $users,
            //'roles' => $roles
        ]);
    }

    private function ttt($roles)
    {
        if(in_array('ROLE_ADMIN', $roles)) {
            $roles = "Admin";
        } else {
            $roles = 'Membre';
        }
        //dd($roles);
        return $roles;
    }
}

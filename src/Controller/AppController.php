<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    #[Route('/', name: 'homepage', methods: 'GET')]
    public function index(): Response
    {
        return $this->render('homepage.html.twig');
    }

    #[Route('/login', name: 'loginpage', methods: 'GET')]
    public function login(): Response
    {
        return $this->render('security/login.html.twig');
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventosController extends AbstractController
{
    #[Route('/eventos', name: 'app_eventos')]
    public function index(): Response
    {
        return $this->render('eventos/index.html.twig', [
            'controller_name' => 'EventosController',
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MesaController extends AbstractController
{
    #[Route('/mesas', name: 'app_mesa')]
    public function index(): Response
    {
        return $this->render('mesa/index.html.twig', [
            'controller_name' => 'MesaController',
        ]);
    }
}

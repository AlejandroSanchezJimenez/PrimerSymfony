<?php

namespace App\Controller;

use App\Repository\EventoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventosController extends AbstractController
{
    private $evento;
    private $security;

    public function __construct(EventoRepository $evento, Security $security)
    {
       $this->evento = $evento;
       $this->security = $security;
    }

    #[Route('/eventos', name: 'app_eventos')]
    public function index(): Response
    {
        $date = date('y-m-d');
        $eventos=$this->evento->findAll();
        return $this->render('eventos/index.html.twig', [
            'eventos' => $eventos,

        ]);
    }
}

<?php

namespace App\Controller;

use App\Repository\EventoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventosController extends AbstractController
{
    private $evento;

    public function __construct(EventoRepository $evento)
    {
       $this->evento = $evento;
    }

    #[Route('/eventos', name: 'app_eventos')]
    public function index(): Response
    {
        $date = date('y-m-d');
        $eventos=$this->evento->findByExampleField($date);
        return $this->render('eventos/index.html.twig', [
            'eventos' => $eventos,

        ]);
    }
}

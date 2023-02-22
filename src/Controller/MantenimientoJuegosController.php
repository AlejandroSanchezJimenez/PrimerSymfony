<?php

namespace App\Controller;

use App\Repository\JuegoDeMesaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MantenimientoJuegosController extends AbstractController
{
    private $juegorep;

    public function __construct(JuegoDeMesaRepository $juegorep)
    {
       $this->juegorep = $juegorep;
    }

    #[Route('/mantenimiento/juegos', name: 'app_mantenimiento_juegos')]
    public function index(JuegoDeMesaRepository $juego): Response
    {
        $juegos=$this->juegorep->findAll();
        
        return $this->render('mantenimiento_juegos/index.html.twig', [
            'juegos' => $juegos,
            'juegorep' => $this->juegorep
        ]);
    }
}

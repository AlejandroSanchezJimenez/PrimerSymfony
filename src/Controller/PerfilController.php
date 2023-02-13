<?php

namespace App\Controller;

use App\Repository\EventoRepository;
use App\Repository\JuegoDeMesaRepository;
use App\Repository\ReservaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PerfilController extends AbstractController
{
    private $security;
    private $evento;

    public function __construct(Security $security,EventoRepository $evento)
    {
       $this->security = $security;
       $this->evento = $evento;
    }

    #[Route('/perfil', name: 'app_perfil')]
    public function index(ReservaRepository $reserva, JuegoDeMesaRepository $juego): Response
    {
        $date = date('y-m-d');
        $eventos=$this->evento->findAll();
        $reservas= $reserva->findallbyid($this->security->getUser(),$date);
        $juegosjugados= $reserva->findJuegosJugados($date,$this->security->getUser());
        $juegos=$juego->findAll();
        
        return $this->render('perfil/index.html.twig',['reservas' => $reservas, 'juegos' => $juegos, 'jugados' => $juegosjugados,  'eventos' => $eventos]);
    }
}

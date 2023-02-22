<?php

namespace App\Controller;

use App\Entity\Evento;
use App\Repository\EventoRepository;
use App\Repository\JuegoDeMesaRepository;
use App\Repository\ReservaRepository;
use App\Repository\UsuarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PerfilController extends AbstractController
{
    private $security;
    private $evento;
    private $user;

    public function __construct(Security $security,EventoRepository $evento, UsuarioRepository $user)
    {
       $this->security = $security;
       $this->evento = $evento;
       $this->user = $user;
    }

    #[Route('/perfil', name: 'app_perfil')]
    public function index(ReservaRepository $reserva, JuegoDeMesaRepository $juego): Response
    {
        $date = date('y-m-d');
        $evento= new Evento;
        $email= $this->security->getUser()->getUserIdentifier();
        $idarray= $this->user->getUserID($email);
        $id=implode($idarray);
        $eventos=$this->evento->findEventosByIDallDates($evento,$id);
        $reservas= $reserva->findallbyid($this->security->getUser(),$date);
        $juegosjugados= $reserva->findJuegosJugados($date,$this->security->getUser());
        $juegos=$juego->findAll();
        
        return $this->render('perfil/index.html.twig',['reservas' => $reservas, 'juegos' => $juegos, 'jugados' => $juegosjugados,  'eventos' => $eventos,
        'eventorep' => $this->evento,
        'eventonew' => $evento
    ]);
    }
}

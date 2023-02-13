<?php
namespace App\Controller;

use App\Entity\JuegoDeMesa;
use App\Repository\JuegoDeMesaRepository;
use App\Repository\ReservaRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authorization\Voter\AuthenticatedVoter;

class IndexController extends AbstractController
{
    #[Route('/',name:'landing')]
    public function landing(ReservaRepository $reserva, JuegoDeMesaRepository $juego): Response 
    {
        $reservas= $reserva->findAll();
        $juegos=$reserva->findJuegosPopulares();
        return $this->render('index.html.twig', ['reservas' => $reservas, 'juegos' => $juegos]);
    } 

    #[Route('/home')]
    public function request(JuegoDeMesaRepository $juego)
    {
        $juegos=$juego->findAll();
        return new Response(dump($juegos));
    } 
}
?>
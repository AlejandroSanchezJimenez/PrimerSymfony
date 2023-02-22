<?php
namespace App\Controller;

use App\Repository\ReservaRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends AbstractController
{
    #[Route('/',name:'landing')]
    public function landing(ReservaRepository $reserva): Response 
    {
        $reservas= $reserva->findAll();
        $juegos=$reserva->findJuegosPopulares();
        return $this->render('index.html.twig', ['reservas' => $reservas, 'juegos' => $juegos]);
    } 
}
?>
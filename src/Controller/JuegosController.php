<?php

namespace App\Controller;

use App\Entity\JuegoDeMesa;
use App\Repository\JuegoDeMesaRepository;
use App\Repository\MesaRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JuegosController extends AbstractController
{
    #[Route('/juegos', name: 'app_juegos')]
    public function index(JuegoDeMesaRepository $juego, MesaRepository $mesa): Response
    {
        $juegos=$juego->findAll();
        

        return $this->render('juegos/index.html.twig', [
            'juegos' => $juegos,
            'mesa' => $mesa
        ]);
    }

    #[Route('/product/crear', name: 'create_juego')]
    public function creaProducto(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $juego = new JuegoDeMesa();
        $juego->setNombre("");
        $juego->setEditorial("");
        $juego->setCaratula("");
        $juego->setTablero("");
        $juego->setAnchura("");
        $juego->setLongitud("");
        $juego->setMinJug("");
        $juego->setMaxJug("");

        $entityManager->persist($juego);

        $entityManager->flush();

        return new Response('Nuevo producto guardado con la ID'.$juego->getId());
    }
}

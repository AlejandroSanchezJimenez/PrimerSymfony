<?php

namespace App\Controller;

use App\Entity\JuegoDeMesa;
use App\Entity\Reserva;
use App\Form\ReservaType;
use App\Repository\JuegoDeMesaRepository;
use App\Repository\ReservaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
use Exception;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservaFormController extends AbstractController
{
    private $security;
    private $juego;
    private $reservarep;

    public function __construct(Security $security, JuegoDeMesaRepository $juego, ReservaRepository $reservarep)
    {
       $this->security = $security;
       $this->juego = $juego;
       $this->reservarep = $reservarep;
    }

    #[Route('/reserva', name: 'crea_reservas')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        // creates a task object and initializes some data for this example
        $reserva = new Reserva;
        $juego = new JuegoDeMesa;
        $juego = $this-> juego ->findOneBySomeField($_GET['idjuego']);

        $form = $this->createForm(ReservaType::class, $reserva);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            // $reserva = $form->getData();
            $date = date('y-m-d');
            $date_convert = date_format($form->get('dia_reserva')->getData(), 'y-m-d');
            
            if ($this->reservarep->findIfReservaExist($form->get('dia_reserva')->getData(),$form->get('Hora_entrada')->getData(),$form->get('Hora_salida')->getData(),$form->get('Mesa')->getData(),$date)) {
                $this->addFlash('Error', 'Ya existe una reserva en ese rango horario');
            }
            else if ($date_convert<=$date) {
                $this->addFlash('Errordate', 'Debe elegir una fecha posterior a la de hoy');
            }
            else {
                $reserva->setJuego($juego);
                $reserva->setMesa($form->get('Mesa')->getData());
                $reserva->setDiaReserva($form->get('dia_reserva')->getData());
                $reserva->setHoraEntrada($form->get('Hora_entrada')->getData());
                $reserva->setHoraSalida($form->get('Hora_salida')->getData());
                $reserva->setIdUsuario($this->security->getUser());
                
                $em->persist($reserva);
                $em->flush();

                return $this->redirectToRoute('app_juegos');
                $this->addFlash('Exito', 'Reserva realizada con éxito, te esperamos.');
            }
            
        }
        
        return $this->render('reserva/index.html.twig', [
            'form' => $form->createView(),
            'juego' => $juego
        ]);
    }

    #[Route('/cancelareserva', name: 'app_cancela_reserva')]
    public function cancelaReserva()
    {
        $date = date('y-m-d');
        $this->reservarep->cancelaReserva($date,$_GET['id_reserva']);

        return $this->redirectToRoute('app_perfil');
    }
}

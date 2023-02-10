<?php

namespace App\Controller;

use App\Entity\Reserva;
use App\Form\ReservaType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservaFormController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
       $this->security = $security;
    }

    #[Route('/reserva', name: 'crea_reservas')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        // creates a task object and initializes some data for this example
        $reserva = new Reserva;

        $form = $this->createForm(ReservaType::class, $reserva);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            // $reserva = $form->getData();
            $reserva->setJuego($form->get('Juego')->getData());
            $reserva->setMesa($form->get('Mesa')->getData());
            $reserva->setDiaReserva($form->get('dia_reserva')->getData());
            $reserva->setHoraEntrada($form->get('Hora_entrada')->getData());
            $reserva->setHoraSalida($form->get('Hora_salida')->getData());
            $reserva->setIdUsuario($this->security->getUser());
            
            $em->persist($reserva);
            $em->flush();

            return $this->redirectToRoute('crea_reservas');
        }
        
        return $this->render('reserva/index.html.twig', [
            'form' => $form,
        ]);
    }
}

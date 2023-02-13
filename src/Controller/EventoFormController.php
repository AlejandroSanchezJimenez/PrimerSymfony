<?php

namespace App\Controller;

use App\Entity\Evento;
use App\Form\EventosType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventoFormController extends AbstractController
{
    #[Route('/evento/create', name: 'crea_eventos')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        // creates a task object and initializes some data for this example
        $evento = new Evento;

        $form = $this->createForm(EventosType::class, $evento);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            // $reserva = $form->getData();
            $date = date('y-m-d');
            $date_convert = date_format($form->get('Fecha_ini')->getData(), 'y-m-d');
            $date_convert2 = date_format($form->get('Fecha_fin')->getData(), 'y-m-d');
            
            if ($date_convert<=$date) {
                $this->addFlash('Errordate', 'Debe elegir una fecha posterior a la de hoy');
            }
            else if ($date_convert2<=$date_convert) {
                $this->addFlash('Errordate', 'Debe elegir una fecha posterior a la de inicio');
            }
            else {
                $session = $request->getSession();
                $session->set('NombreEvento', $form->get('Nombre')->getData()); 
                
                $evento->setNombre($form->get('Nombre')->getData());
                $evento->setDescripcion($form->get('Descripcion')->getData());
                $evento->setFechaIni($form->get('Fecha_ini')->getData());
                $evento->setFechaFin($form->get('Fecha_fin')->getData());
                
                $em->persist($evento);
                $em->flush();

                return $this->redirectToRoute('app_juegosde_evento');
                $this->addFlash('Exito', 'Reserva realizada con éxito, te esperamos.');
            }
            
        }
        
        return $this->render('añadeeventos/index.html.twig', [
            'form' => $form->createView()
        ]);
}
}

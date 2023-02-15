<?php

namespace App\Controller;

use App\Entity\JuegoDeMesa;
use App\Entity\JuegosDeEvento;
use App\Form\JuegosdeEventoType;
use App\Repository\EventoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
use PhpParser\Node\Expr\Assign;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JuegosdeEventoController extends AbstractController
{
    private $evento;

    public function __construct(EventoRepository $evento)
    {
       $this->evento=$evento;
    }

    #[Route('/juegosevento', name: 'app_juegosde_evento')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $juegosdeevento= new JuegosDeEvento;

        $session = $request->getSession();
        $evento = $session->get('Evento');
        unserialize($evento);

        $form = $this->createForm(JuegosdeEventoType::class, $juegosdeevento);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $arrayJuegos=$form->get('Juego')->getData();
            
            foreach ($arrayJuegos as $juego) {
                $juegosdeevento->setJuego($juego);
                $juegosdeevento->setEventoId($evento);

                $em->persist($juegosdeevento);
                $em->flush();
            }

            return $this->redirectToRoute('app_invitaciones');
            $this->addFlash('Exito', 'Reserva realizada con éxito, te esperamos.');
        }
        
        return $this->render('juegosde_evento/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

    


<?php

namespace App\Controller;

use App\Entity\Participacion;
use App\Form\InvitacionesType;
use App\Repository\EventoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InvitacionesController extends AbstractController
{
    private $evento;

    public function __construct(EventoRepository $evento)
    {
       $this->evento=$evento;
    }

    #[Route('/invitaciones', name: 'app_invitaciones')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $participacion= new Participacion;
        $session = $request->getSession();
        $evento=$this->evento->findByNombre($session->get('NombreEvento'));

        $form = $this->createForm(InvitacionesType::class, $participacion);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $arrayUsers=$form->get('ParticipanEvento')->getData();
                foreach ($arrayUsers as $user) {
                    $participacion->setUsuario($user);
                    $participacion->setEvento($evento);

                    $em->persist($participacion);
                }

                $em->flush();

            return $this->redirectToRoute('/eventos');
            $this->addFlash('Exito', 'Reserva realizada con éxito, te esperamos.');
        }
        
        return $this->render('invitaciones/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

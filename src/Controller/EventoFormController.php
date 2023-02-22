<?php

namespace App\Controller;

use App\Entity\Evento;
use App\Event\EventoCreateEvent;
use App\EventSubscriber\EventoSubscriber;
use App\Form\EventosType;
use App\Repository\EventoRepository;
use App\Repository\ReservaRepository;
use App\Repository\UsuarioRepository;
use App\Service\Mailer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class EventoFormController extends AbstractController
{
    private $evento;
    private $ed;
    protected $rerep;
    protected $eventorep;
    protected $usuariorep;

    public function __construct(EventoRepository $evento, EventDispatcherInterface $ed, ReservaRepository $rerep, EventoRepository $eventorep, UsuarioRepository $usuariorep)
    {
        $this->evento = $evento;
        $this->ed = $ed;
        $this->rerep = $rerep;
        $this->eventorep = $eventorep;
        $this->usuariorep = $usuariorep;
    }

    #[Route('/evento/create', name: 'crea_eventos')]
    public function index(Request $request, EntityManagerInterface $em, Mailer $mailer): Response
    {
        $evento = new Evento;

        $form = $this->createForm(EventosType::class, $evento);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $date = date('y-m-d');
            $date_convert = date_format($form->get('Fecha_Evento')->getData(), 'y-m-d');

            if ($date_convert <= $date) {
                $this->addFlash('Errordate', 'Debe elegir una fecha posterior a la de hoy');
            } else {
                $evento = $form->getData();

                $arrayJuegos = $form->get('JuegosDeEvento')->getData();
                foreach ($arrayJuegos as $juego) {
                    $evento->addJuegosDeEvento($juego);
                }

                $arrayUsers = $form->get('Participacion')->getData();
                foreach ($arrayUsers as $user) {
                    $evento->addInvitacion($user);

                    $mailer->sendInvitation($user);

                    if ($user->getNumTelegram()) {
                        $chatid = $user->getNumTelegram();
                        $mensaje = 'Has recibido una invitación para acudir al evento ' . $form->get('Nombre')->getData() . ' realizado el ' . $form->get('Fecha_Evento')->getData()->format('d-m-Y') . '. Por favor confirma tu asistencia accediendo a la pestaña de eventos de la página de Los Juegos Hermanos';
                        $url = "https://api.telegram.org/bot6267084166:AAFQb1ByP74ebPIM8coZo6xzwvY0Q9Hnx8o/sendMessage?chat_id=" . $chatid;
                        $url = $url . "&text=" . urlencode($mensaje);
                        $ch = curl_init();
                        $optArray = array(
                            CURLOPT_URL => $url,
                            CURLOPT_RETURNTRANSFER => true
                        );
                        curl_setopt_array($ch, $optArray);
                        curl_exec($ch);
                        curl_close($ch);
                    }
                }

                $em->persist($evento);
                $em->flush();

                $event = new EventoCreateEvent($evento, $mailer, $this->rerep, $this->eventorep, $this->usuariorep,$em);
                $this->ed->addSubscriber(new EventoSubscriber());
                $this->ed->dispatch($event, EventoCreateEvent::NAME);


                return $this->redirectToRoute('app_eventos');
                $this->addFlash('Exito', 'Reserva realizada con éxito, te esperamos.');
            }
        }

        return $this->render('añadeeventos/index.html.twig', [
            'form' => $form
        ]);
    }
}

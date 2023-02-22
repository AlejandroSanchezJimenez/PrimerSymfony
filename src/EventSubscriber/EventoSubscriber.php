<?php

namespace App\EventSubscriber;

use App\Event\EventoCreateEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EventoSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents(): array
    {
        return [
            EventoCreateEvent::NAME => 'onEventoCreation',
        ];
    }

    public function onEventoCreation(EventoCreateEvent $event)
    {
        if ($event->getrerep()->findIfReservaExistDay($event->getEvento()->getFechaEvento())) {
            $reservas=$event->getrerep()->findIfReservaExistDay($event->getEvento()->getFechaEvento());
           
            foreach ($reservas as $reserva) {
                $usuario=$event->getusuariorep()->getUserByID($reserva->getIdUsuario());

                $event->getEvento()->addInvitacion($usuario);

                $event->getMailer()->changeReserva($usuario);

                $event->getrerep()->remove($reserva,true);

                if ($usuario->getNumTelegram()) {
                    $chatid=$usuario->getNumTelegram();
                    $mensaje = 'Lamento informarle de que debido a la celebración de un evento de la empresa, '.$event->getEvento()->getNombre().', nos vemos obligados a eliminar su reserva del día '. $event->getEvento()->getFechaEvento()->format('d-m-Y') .'. Como disculpas podemos ofrecerle una invitación a este mismo evento de acceso exclusivo. Podrá ver esta invitación desde la pestaña de eventos de la página web de Los Pollos Hermanos';
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

                $event->getem()->persist($event->getEvento());
            }
            
            $event->getem()->flush();
        }
    }
}

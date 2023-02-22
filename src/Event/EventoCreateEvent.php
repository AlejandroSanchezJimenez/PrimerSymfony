<?php

namespace App\Event;

use App\Entity\Evento;
use App\Repository\EventoRepository;
use App\Repository\ReservaRepository;
use App\Repository\UsuarioRepository;
use Symfony\Contracts\EventDispatcher\Event;
use App\Service\Mailer;
use Doctrine\ORM\EntityManager;

class EventoCreateEvent extends Event
{
    public const NAME = 'evento.created';

    protected $rerep;
    protected $eventorep;
    protected $usuariorep;
    protected Evento $evento;
    protected Mailer $mailer;
    protected $em;

    public function __construct($evento, $mailer, ReservaRepository $rerep, EventoRepository $eventorep, UsuarioRepository $usuariorep, EntityManager $em)
    {
        $this->evento = $evento;
        $this->mailer = $mailer;
        $this->rerep = $rerep;
        $this->eventorep= $eventorep;
        $this->usuariorep= $usuariorep;
        $this->em=$em;
    }

    public function getEvento()
    {
        return $this->evento;
    }

    public function getMailer()
    {
        return $this->mailer;
    }

    public function getrerep()
    {
        return $this->rerep;
    }

    public function geteventorep()
    {
        return $this->eventorep;
    }

    public function getusuariorep()
    {
        return $this->usuariorep;
    }

    public function getem()
    {
        return $this->em;
    }

    
}
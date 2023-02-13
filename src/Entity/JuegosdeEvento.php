<?php

namespace App\Entity;

use App\Repository\JuegosdeEventoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JuegosdeEventoRepository::class)]
class JuegosDeEvento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Evento $EventoId = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?JuegoDeMesa $Juego = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEventoId(): ?Evento
    {
        return $this->EventoId;
    }

    public function setEventoId(?Evento $EventoId): self
    {
        $this->EventoId = $EventoId;

        return $this;
    }

    public function getJuego(): ?JuegoDeMesa
    {
        return $this->Juego;
    }

    public function setJuego(?JuegoDeMesa $Juego): self
    {
        $this->Juego = $Juego;

        return $this;
    }
}

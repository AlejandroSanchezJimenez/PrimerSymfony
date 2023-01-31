<?php

namespace App\Entity;

use App\Repository\JuegosdeEventoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JuegosdeEventoRepository::class)]
class JuegosdeEvento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'Juegos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Juegodemesa $Juego = null;

    #[ORM\ManyToOne(inversedBy: 'Eventos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Evento $Evento = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJuego(): ?Juegodemesa
    {
        return $this->Juego;
    }

    public function setJuego(?Juegodemesa $Juego): self
    {
        $this->Juego = $Juego;

        return $this;
    }

    public function getEvento(): ?Evento
    {
        return $this->Evento;
    }

    public function setEvento(?Evento $Evento): self
    {
        $this->Evento = $Evento;

        return $this;
    }
}

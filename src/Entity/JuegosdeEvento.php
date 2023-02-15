<?php

namespace App\Entity;

use App\Repository\JuegosdeEventoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private ?JuegoDeMesa $Juego = null;

    #[ORM\ManyToOne(inversedBy: 'JuegosDeEvento')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Evento $evento = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEvento(): ?Evento
    {
        return $this->evento;
    }

    public function setEvento(?Evento $evento): self
    {
        $this->evento = $evento;

        return $this;
    }
}

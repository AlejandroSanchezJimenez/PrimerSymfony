<?php

namespace App\Entity;

use App\Repository\EventoRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventoRepository::class)]
class Evento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 3,
        max: 50,
        minMessage: 'El nombre del evento tiene que tener al menos {{ limit }} caracteres',
        maxMessage: 'El nombre del evento tiene que tener como máximo {{ limit }} caracteres',
    )]
    private ?string $Nombre = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank]
    private ?string $Descripcion = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank]
    private ?\DateTimeInterface $Fecha_evento = null;

    #[ORM\ManyToMany(targetEntity: JuegoDeMesa::class, inversedBy: 'eventos')]
    private Collection $Juegos_de_evento;

    #[ORM\ManyToMany(targetEntity: Usuario::class, inversedBy: 'eventos')]
    private Collection $Invitacion;

    public function __construct()
    {
        $this->Juegos_de_evento = new ArrayCollection();
        $this->Invitacion = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->Descripcion;
    }

    public function setDescripcion(string $Descripcion): self
    {
        $this->Descripcion = $Descripcion;

        return $this;
    }

    public function getFechaEvento(): ?\DateTimeInterface
    {
        return $this->Fecha_evento;
    }

    public function setFechaEvento(\DateTimeInterface $Fecha_evento): self
    {
        $this->Fecha_evento = $Fecha_evento;

        return $this;
    }

    /**
     * @return Collection<int, JuegoDeMesa>
     */
    public function getJuegosDeEvento(): Collection
    {
        return $this->Juegos_de_evento;
    }

    public function addJuegosDeEvento(JuegoDeMesa $juegosDeEvento): self
    {
        if (!$this->Juegos_de_evento->contains($juegosDeEvento)) {
            $this->Juegos_de_evento->add($juegosDeEvento);
        }

        return $this;
    }

    public function removeJuegosDeEvento(JuegoDeMesa $juegosDeEvento): self
    {
        $this->Juegos_de_evento->removeElement($juegosDeEvento);

        return $this;
    }

    /**
     * @return Collection<int, Usuario>
     */
    public function getInvitacion(): Collection
    {
        return $this->Invitacion;
    }

    public function addInvitacion(Usuario $invitacion): self
    {
        if (!$this->Invitacion->contains($invitacion)) {
            $this->Invitacion->add($invitacion);
        }

        return $this;
    }

    public function removeInvitacion(Usuario $invitacion): self
    {
        $this->Invitacion->removeElement($invitacion);

        return $this;
    }
}

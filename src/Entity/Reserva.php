<?php

namespace App\Entity;

use App\Repository\ReservaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservaRepository::class)]
class Reserva
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: tramohorario::class, inversedBy: 'Reservas')]
    private Collection $Tramos_horarios;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Fecha_cancelacion = null;

    #[ORM\Column]
    private ?bool $Presentado = null;

    #[ORM\ManyToOne(inversedBy: 'Reservas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Usuario $Usuario = null;

    #[ORM\ManyToOne(inversedBy: 'Juegos_reservados')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Juegodemesa $Juego = null;

    #[ORM\ManyToOne(inversedBy: 'Mesas_reservadas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Mesa $Mesa = null;

    public function __construct()
    {
        $this->Tramos_horarios = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, tramohorario>
     */
    public function getTramosHorarios(): Collection
    {
        return $this->Tramos_horarios;
    }

    public function addTramosHorario(tramohorario $tramosHorario): self
    {
        if (!$this->Tramos_horarios->contains($tramosHorario)) {
            $this->Tramos_horarios->add($tramosHorario);
        }

        return $this;
    }

    public function removeTramosHorario(tramohorario $tramosHorario): self
    {
        $this->Tramos_horarios->removeElement($tramosHorario);

        return $this;
    }

    public function getFechaCancelacion(): ?\DateTimeInterface
    {
        return $this->Fecha_cancelacion;
    }

    public function setFechaCancelacion(\DateTimeInterface $Fecha_cancelacion): self
    {
        $this->Fecha_cancelacion = $Fecha_cancelacion;

        return $this;
    }

    public function isPresentado(): ?bool
    {
        return $this->Presentado;
    }

    public function setPresentado(bool $Presentado): self
    {
        $this->Presentado = $Presentado;

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->Usuario;
    }

    public function setUsuario(?Usuario $Usuario): self
    {
        $this->Usuario = $Usuario;

        return $this;
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

    public function getMesa(): ?Mesa
    {
        return $this->Mesa;
    }

    public function setMesa(?Mesa $Mesa): self
    {
        $this->Mesa = $Mesa;

        return $this;
    }
}

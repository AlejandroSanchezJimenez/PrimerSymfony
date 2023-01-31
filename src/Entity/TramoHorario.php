<?php

namespace App\Entity;

use App\Repository\TramoHorarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TramoHorarioRepository::class)]
class TramoHorario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 5)]
    private ?string $Hora_ini = null;

    #[ORM\Column(length: 5)]
    private ?string $Hora_fin = null;

    #[ORM\ManyToMany(targetEntity: Reserva::class, mappedBy: 'Tramos_horarios')]
    private Collection $Reservas;

    public function __construct()
    {
        $this->Reservas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHoraIni(): ?string
    {
        return $this->Hora_ini;
    }

    public function setHoraIni(string $Hora_ini): self
    {
        $this->Hora_ini = $Hora_ini;

        return $this;
    }

    public function getHoraFin(): ?string
    {
        return $this->Hora_fin;
    }

    public function setHoraFin(string $Hora_fin): self
    {
        $this->Hora_fin = $Hora_fin;

        return $this;
    }

    /**
     * @return Collection<int, Reserva>
     */
    public function getReservas(): Collection
    {
        return $this->Reservas;
    }

    public function addReserva(Reserva $reserva): self
    {
        if (!$this->Reservas->contains($reserva)) {
            $this->Reservas->add($reserva);
            $reserva->addTramosHorario($this);
        }

        return $this;
    }

    public function removeReserva(Reserva $reserva): self
    {
        if ($this->Reservas->removeElement($reserva)) {
            $reserva->removeTramosHorario($this);
        }

        return $this;
    }
}

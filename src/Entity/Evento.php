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
    private ?string $Descripción = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank]
    #[Assert\LessThanOrEqual(
        propertyPath: "Fecha_fin"
    )]
    #[Assert\Date]
    private ?\DateTimeInterface $Fecha_ini = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank]
    #[Assert\GreaterThanOrEqual(
        propertyPath: "Fecha_ini"
    )]
    #[Assert\Date]
    private ?\DateTimeInterface $Fecha_fin = null;

    #[ORM\OneToMany(mappedBy: 'Evento', targetEntity: Participacion::class, orphanRemoval: true)]
    private Collection $ParticipanEvento;

    #[ORM\OneToMany(mappedBy: 'Evento', targetEntity: JuegosdeEvento::class, orphanRemoval: true)]
    private Collection $Eventos;

    public function __construct()
    {
        $this->ParticipanEvento = new ArrayCollection();
        $this->Eventos = new ArrayCollection();
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

    public function getDescripción(): ?string
    {
        return $this->Descripción;
    }

    public function setDescripción(string $Descripción): self
    {
        $this->Descripción = $Descripción;

        return $this;
    }

    public function getFechaIni(): ?\DateTimeInterface
    {
        return $this->Fecha_ini;
    }

    public function setFechaIni(\DateTimeInterface $Fecha_ini): self
    {
        $this->Fecha_ini = $Fecha_ini;

        return $this;
    }

    public function getFechaFin(): ?\DateTimeInterface
    {
        return $this->Fecha_fin;
    }

    public function setFechaFin(\DateTimeInterface $Fecha_fin): self
    {
        $this->Fecha_fin = $Fecha_fin;

        return $this;
    }

    /**
     * @return Collection<int, Participacion>
     */
    public function getParticipanEvento(): Collection
    {
        return $this->ParticipanEvento;
    }

    public function addParticipanEvento(Participacion $participanEvento): self
    {
        if (!$this->ParticipanEvento->contains($participanEvento)) {
            $this->ParticipanEvento->add($participanEvento);
            $participanEvento->setEvento($this);
        }

        return $this;
    }

    public function removeParticipanEvento(Participacion $participanEvento): self
    {
        if ($this->ParticipanEvento->removeElement($participanEvento)) {
            // set the owning side to null (unless already changed)
            if ($participanEvento->getEvento() === $this) {
                $participanEvento->setEvento(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, JuegosdeEvento>
     */
    public function getEventos(): Collection
    {
        return $this->Eventos;
    }

    public function addEvento(JuegosdeEvento $evento): self
    {
        if (!$this->Eventos->contains($evento)) {
            $this->Eventos->add($evento);
            $evento->setEvento($this);
        }

        return $this;
    }

    public function removeEvento(JuegosdeEvento $evento): self
    {
        if ($this->Eventos->removeElement($evento)) {
            // set the owning side to null (unless already changed)
            if ($evento->getEvento() === $this) {
                $evento->setEvento(null);
            }
        }

        return $this;
    }
}

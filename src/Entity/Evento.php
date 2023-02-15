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

    #[ORM\Column(nullable: true)]
    private ?bool $Asiste = null;

    #[ORM\OneToMany(mappedBy: 'evento', targetEntity: JuegosDeEvento::class, orphanRemoval: true)]
    private Collection $JuegosDeEvento;

    #[ORM\OneToMany(mappedBy: 'evento', targetEntity: Participacion::class, orphanRemoval: true)]
    private Collection $Participacion;

    public function __construct()
    {
        $this->JuegosDeEvento = new ArrayCollection();
        $this->Participacion = new ArrayCollection();
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

    public function isAsiste(): ?bool
    {
        return $this->Asiste;
    }

    public function setAsiste(?bool $Asiste): self
    {
        $this->Asiste = $Asiste;

        return $this;
    }

    public function addJuegosDeEvento(JuegosDeEvento $juegosDeEvento): self
    {
        if (!$this->JuegosDeEvento->contains($juegosDeEvento)) {
            $this->JuegosDeEvento->add($juegosDeEvento);
            $juegosDeEvento->setEvento($this);
        }

        return $this;
    }

    public function removeJuegosDeEvento(JuegosDeEvento $juegosDeEvento): self
    {
        if ($this->JuegosDeEvento->removeElement($juegosDeEvento)) {
            // set the owning side to null (unless already changed)
            if ($juegosDeEvento->getEvento() === $this) {
                $juegosDeEvento->setEvento(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Participacion>
     */
    public function getParticipacion(): Collection
    {
        return $this->Participacion;
    }

    public function addParticipacion(Participacion $participacion): self
    {
        if (!$this->Participacion->contains($participacion)) {
            $this->Participacion->add($participacion);
            $participacion->setEvento($this);
        }

        return $this;
    }

    public function removeParticipacion(Participacion $participacion): self
    {
        if ($this->Participacion->removeElement($participacion)) {
            // set the owning side to null (unless already changed)
            if ($participacion->getEvento() === $this) {
                $participacion->setEvento(null);
            }
        }

        return $this;
    }
}

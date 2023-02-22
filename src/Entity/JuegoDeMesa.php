<?php

namespace App\Entity;

use App\Repository\JuegoDeMesaRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JuegoDeMesaRepository::class)]
class JuegoDeMesa
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
        minMessage: 'El nombre del juego tiene que tener al menos {{ limit }} caracteres',
        maxMessage: 'El nombre del juego tiene que tener como máximo {{ limit }} caracteres',
    )]
    private ?string $Nombre = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 3,
        max: 50,
        minMessage: 'La editorial del juego tiene que tener al menos {{ limit }} caracteres',
        maxMessage: 'La editorial del juego tiene que tener como máximo {{ limit }} caracteres',
    )]
    private ?string $Editorial = null;

    #[ORM\Column]
    #[Assert\Positive]
    private ?float $Anchura = null;

    #[ORM\Column]
    #[Assert\Positive]
    private ?float $Longitud = null;

    #[ORM\Column(type: Types::BLOB)]
    private $Caratula = null;

    #[ORM\Column]
    #[Assert\Positive]
    #[Assert\LessThanOrEqual(
        propertyPath: "Max_jug"
    )]
    private ?int $Min_jug = null;

    #[ORM\Column]
    #[Assert\Positive]
    #[Assert\GreaterThanOrEqual(
        propertyPath: "Min_jug"
    )]
    private ?int $Max_jug = null;

    #[ORM\Column(type: Types::BLOB)]
    private $Tablero = null;

    #[ORM\ManyToMany(targetEntity: Evento::class, mappedBy: 'Juegos_de_evento')]
    private Collection $eventos;

    public function __construct()
    {
        $this->eventos = new ArrayCollection();
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

    public function getEditorial(): ?string
    {
        return $this->Editorial;
    }

    public function setEditorial(string $Editorial): self
    {
        $this->Editorial = $Editorial;

        return $this;
    }

    public function getAnchura(): ?float
    {
        return $this->Anchura;
    }

    public function setAnchura(float $Anchura): self
    {
        $this->Anchura = $Anchura;

        return $this;
    }

    public function getLongitud(): ?float
    {
        return $this->Longitud;
    }

    public function setLongitud(float $Longitud): self
    {
        $this->Longitud = $Longitud;

        return $this;
    }

    public function getCaratula()
    {
        return $this->Caratula;
    }

    public function setCaratula($Caratula): self
    {
        $this->Caratula = $Caratula;

        return $this;
    }

    public function getMinJug(): ?int
    {
        return $this->Min_jug;
    }

    public function setMinJug(int $Min_jug): self
    {
        $this->Min_jug = $Min_jug;

        return $this;
    }

    public function getMaxJug(): ?int
    {
        return $this->Max_jug;
    }

    public function setMaxJug(int $Max_jug): self
    {
        $this->Max_jug = $Max_jug;

        return $this;
    }

    public function getTablero()
    {
        return $this->Tablero;
    }

    public function setTablero($Tablero): self
    {
        $this->Tablero = $Tablero;

        return $this;
    }

    /**
     * @return Collection<int, Evento>
     */
    public function getEventos(): Collection
    {
        return $this->eventos;
    }

    public function addEvento(Evento $evento): self
    {
        if (!$this->eventos->contains($evento)) {
            $this->eventos->add($evento);
            $evento->addJuegosDeEvento($this);
        }

        return $this;
    }

    public function removeEvento(Evento $evento): self
    {
        if ($this->eventos->removeElement($evento)) {
            $evento->removeJuegosDeEvento($this);
        }

        return $this;
    }
}

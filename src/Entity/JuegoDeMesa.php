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
    // #[Assert\Image(
    //     minWidth: 100,
    //     maxWidth: 200,
    //     minHeight: 100,
    //     maxHeight: 200,
    // )]
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
    // #[Assert\Image(
    //     minWidth: 100,
    //     maxWidth: 200,
    //     minHeight: 100,
    //     maxHeight: 200,
    // )]
    private $Tablero = null;

    #[ORM\OneToMany(mappedBy: 'Juego', targetEntity: Evento::class, orphanRemoval: true)]
    private Collection $Eventos;

    #[ORM\ManyToMany(targetEntity: Evento::class, mappedBy: 'JuegosDeEventos')]
    private Collection $JuegosenEventos;

    public function __construct()
    {
        $this->Eventos = new ArrayCollection();
        $this->JuegosenEventos = new ArrayCollection();
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
        return $this->Eventos;
    }

    public function addEvento(Evento $evento): self
    {
        if (!$this->Eventos->contains($evento)) {
            $this->Eventos->add($evento);
        }

        return $this;
    }

    public function removeEvento(Evento $evento): self
    {
        if ($this->Eventos->removeElement($evento)) {
            // set the owning side to null (unless already changed)
        }

        return $this;
    }

    /**
     * @return Collection<int, Evento>
     */
    public function getJuegosenEventos(): Collection
    {
        return $this->JuegosenEventos;
    }

    public function addJuegosenEvento(Evento $juegosenEvento): self
    {
        if (!$this->JuegosenEventos->contains($juegosenEvento)) {
            $this->JuegosenEventos->add($juegosenEvento);
            $juegosenEvento->addJuegosDeEvento($this);
        }

        return $this;
    }

    public function removeJuegosenEvento(Evento $juegosenEvento): self
    {
        if ($this->JuegosenEventos->removeElement($juegosenEvento)) {
            $juegosenEvento->removeJuegosDeEvento($this);
        }

        return $this;
    }
}

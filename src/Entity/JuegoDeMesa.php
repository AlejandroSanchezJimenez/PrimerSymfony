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
    #[Assert\Image(
        minWidth: 200,
        maxWidth: 600,
        minHeight: 200,
        maxHeight: 600,
    )]
    private $Carátula = null;

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

    #[ORM\OneToMany(mappedBy: 'Juego', targetEntity: Reserva::class, orphanRemoval: true)]
    private Collection $Juegos_reservados;

    #[ORM\OneToMany(mappedBy: 'Juego', targetEntity: JuegosdeEvento::class, orphanRemoval: true)]
    private Collection $Juegos;

    public function __construct()
    {
        $this->Juegos_reservados = new ArrayCollection();
        $this->Juegos = new ArrayCollection();
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

    public function getCarátula()
    {
        return $this->Carátula;
    }

    public function setCarátula($Carátula): self
    {
        $this->Carátula = $Carátula;

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

    /**
     * @return Collection<int, Reserva>
     */
    public function getJuegosReservados(): Collection
    {
        return $this->Juegos_reservados;
    }

    public function addJuegosReservado(Reserva $juegosReservado): self
    {
        if (!$this->Juegos_reservados->contains($juegosReservado)) {
            $this->Juegos_reservados->add($juegosReservado);
            $juegosReservado->setJuego($this);
        }

        return $this;
    }

    public function removeJuegosReservado(Reserva $juegosReservado): self
    {
        if ($this->Juegos_reservados->removeElement($juegosReservado)) {
            // set the owning side to null (unless already changed)
            if ($juegosReservado->getJuego() === $this) {
                $juegosReservado->setJuego(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, JuegosdeEvento>
     */
    public function getJuegos(): Collection
    {
        return $this->Juegos;
    }

    public function addJuego(JuegosdeEvento $juego): self
    {
        if (!$this->Juegos->contains($juego)) {
            $this->Juegos->add($juego);
            $juego->setJuego($this);
        }

        return $this;
    }

    public function removeJuego(JuegosdeEvento $juego): self
    {
        if ($this->Juegos->removeElement($juego)) {
            // set the owning side to null (unless already changed)
            if ($juego->getJuego() === $this) {
                $juego->setJuego(null);
            }
        }

        return $this;
    }
}

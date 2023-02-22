<?php

namespace App\Entity;

use App\Repository\MesaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MesaRepository::class)]
class Mesa
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\Positive]
    #[Assert\Type('float', message: "El valor introducido debe ser del tipo {{ type }}")]
    private ?float $Anchura = null;

    #[ORM\Column]
    #[Assert\Positive]
    #[Assert\Type('float', message: "El valor introducido debe ser del tipo {{ type }}")]
    private ?float $Longitud = null;

    #[ORM\Column]
    #[Assert\Positive]
    #[Assert\Type('integer', message: "El valor introducido debe ser del tipo {{ type }}")]
    private ?int $X = null;

    #[ORM\Column]
    #[Assert\Positive]
    #[Assert\Type('integer', message: "El valor introducido debe ser del tipo {{ type }}")]
    private ?int $Y = null;

    #[ORM\OneToMany(mappedBy: 'Mesa', targetEntity: Reserva::class, orphanRemoval: true)]
    private Collection $Mesas_reservadas;

    public function __construct()
    {
        $this->Mesas_reservadas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getX(): ?int
    {
        return $this->X;
    }

    public function setX(int $X): self
    {
        $this->X = $X;

        return $this;
    }

    public function getY(): ?int
    {
        return $this->Y;
    }

    public function setY(int $Y): self
    {
        $this->Y = $Y;

        return $this;
    }

    /**
     * @return Collection<int, Reserva>
     */
    public function getMesasReservadas(): Collection
    {
        return $this->Mesas_reservadas;
    }

    public function addMesasReservada(Reserva $mesasReservada): self
    {
        if (!$this->Mesas_reservadas->contains($mesasReservada)) {
            $this->Mesas_reservadas->add($mesasReservada);
            $mesasReservada->setMesa($this);
        }

        return $this;
    }

    public function removeMesasReservada(Reserva $mesasReservada): self
    {
        if ($this->Mesas_reservadas->removeElement($mesasReservada)) {
            if ($mesasReservada->getMesa() === $this) {
                $mesasReservada->setMesa(null);
            }
        }

        return $this;
    }

    public function Posicion() {
        return '('.$this->getX().','.$this->getY().')';
    }
    public function Tamaño() {
        return $this->getLongitud().'x'.$this->getAnchura();
    }
}

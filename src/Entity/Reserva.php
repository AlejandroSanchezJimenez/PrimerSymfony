<?php

namespace App\Entity;

use App\Repository\ReservaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservaRepository::class)]
class Reserva
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Fecha_cancelacion = null;

    #[ORM\Column]
    private ?bool $Presentado = null;

    #[ORM\ManyToOne(inversedBy: 'Juegos_reservados')]
    #[ORM\JoinColumn(nullable: false)]
    private ?JuegoDeMesa $Juego = null;

    #[ORM\ManyToOne(inversedBy: 'Mesas_reservadas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Mesa $Mesa = null;

    #[ORM\ManyToOne(inversedBy: 'Reservas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Usuario $idUsuario = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $Hora_entrada = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $Hora_salida = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Dia_reserva = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getJuego(): ?JuegoDeMesa
    {
        return $this->Juego;
    }

    public function setJuego(?JuegoDeMesa $Juego): self
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

    public function getIdUsuario(): ?Usuario
    {
        return $this->idUsuario;
    }

    public function setIdUsuario(?Usuario $idUsuario): self
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    public function getHoraEntrada(): ?\DateTimeInterface
    {
        return $this->Hora_entrada;
    }

    public function setHoraEntrada(\DateTimeInterface $Hora_entrada): self
    {
        $this->Hora_entrada = $Hora_entrada;

        return $this;
    }

    public function getHoraSalida(): ?\DateTimeInterface
    {
        return $this->Hora_salida;
    }

    public function setHoraSalida(\DateTimeInterface $Hora_salida): self
    {
        $this->Hora_salida = $Hora_salida;

        return $this;
    }

    public function getDiaReserva(): ?\DateTimeInterface
    {
        return $this->Dia_reserva;
    }

    public function setDiaReserva(\DateTimeInterface $Dia_reserva): self
    {
        $this->Dia_reserva = $Dia_reserva;

        return $this;
    }

    public function horas() {
        return 'De '.$this->Hora_entrada->format('H:i').' a '.$this->getHoraSalida()->format('H:i');
    }

    public function nombreJuego() {
        return $this->getJuego()->getNombre();
    }

    public function nombreUser() {
        return $this->getIdUsuario()->getNickname();
    }

    public function cancelacion() {
        if ($this->getFechaCancelacion() === null) {
            return 'No ha cancelado';
        } else {
            return $this->Fecha_cancelacion->format('d-m-Y');
        }
    }
}

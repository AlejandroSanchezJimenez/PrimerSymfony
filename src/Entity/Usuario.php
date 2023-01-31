<?php

namespace App\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
class Usuario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 3,
        max: 30,
        minMessage: 'Tu nombre tiene que tener al menos {{ limit }} caracteres',
        maxMessage: 'Tu nombre tiene que tener como máximo {{ limit }} caracteres',
    )]
    private ?string $Nombre = null;

    #[ORM\Column(length: 40)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 3,
        max: 40,
        minMessage: 'Tu primer apellido tiene que tener al menos {{ limit }} caracteres',
        maxMessage: 'Tu primer apellido tiene que tener como máximo {{ limit }} caracteres',
    )]
    private ?string $Ape1 = null;

    #[ORM\Column(length: 40, nullable: true)]
    #[Assert\Length(
        min: 3,
        max: 40,
        minMessage: 'Tu segundo apellido tiene que tener al menos {{ limit }} caracteres',
        maxMessage: 'Tu segundo apellido tiene que tener como máximo {{ limit }} caracteres',
    )]
    private ?string $Ape2 = null;

    #[ORM\Column(length: 10)]
    #[Assert\NotBlank]
    #[Assert\NotCompromisedPassword]
    #[Assert\Length(
        min: 3,
        max: 10,
        minMessage: 'Tu contraseña tiene que tener al menos {{ limit }} caracteres',
        maxMessage: 'Tu contraseña tiene que tener como máximo {{ limit }} caracteres',
    )]
    private ?string $Contraseña = null;

    #[ORM\Column(length: 30)]
    #[Assert\NotBlank]
    #[Assert\Email(
        message: 'Este email {{ value }} no es válido.',
    )]
    #[Assert\Length(
        min: 3,
        max: 30,
        minMessage: 'Tu email tiene que tener al menos {{ limit }} caracteres',
        maxMessage: 'Tu email tiene que tener como máximo {{ limit }} caracteres',
    )]
    private ?string $Correo_electronico = null;

    #[ORM\Column(length: 15)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 3,
        max: 15,
        minMessage: 'Tu nickname tiene que tener al menos {{ limit }} caracteres',
        maxMessage: 'Tu nickname tiene que tener como máximo {{ limit }} caracteres',
    )]
    private ?string $Nickname = null;

    #[ORM\Column(length: 20)]
    #[Assert\NotBlank]
    private ?string $Rol = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 9,
        max: 9,
        minMessage: 'Tu número de telegram debe ser de {{ limit }} dígitos',
        maxMessage: 'Tu número de telegram debe ser de {{ limit }} dígitos',
    )]
    private ?int $Num_Telegram = null;

    #[ORM\OneToMany(mappedBy: 'Usuario', targetEntity: Reserva::class, orphanRemoval: true)]
    private Collection $Reservas;

    #[ORM\OneToMany(mappedBy: 'Usuario', targetEntity: Participacion::class, orphanRemoval: true)]
    private Collection $ParticipanUsuario;

    public function __construct()
    {
        $this->Reservas = new ArrayCollection();
        $this->ParticipanUsuario = new ArrayCollection();
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

    public function getApe1(): ?string
    {
        return $this->Ape1;
    }

    public function setApe1(string $Ape1): self
    {
        $this->Ape1 = $Ape1;

        return $this;
    }

    public function getApe2(): ?string
    {
        return $this->Ape2;
    }

    public function setApe2(?string $Ape2): self
    {
        $this->Ape2 = $Ape2;

        return $this;
    }

    public function getContraseña(): ?string
    {
        return $this->Contraseña;
    }

    public function setContraseña(string $Contraseña): self
    {
        $this->Contraseña = $Contraseña;

        return $this;
    }

    public function getCorreoElectronico(): ?string
    {
        return $this->Correo_electronico;
    }

    public function setCorreoElectronico(string $Correo_electronico): self
    {
        $this->Correo_electronico = $Correo_electronico;

        return $this;
    }

    public function getNickname(): ?string
    {
        return $this->Nickname;
    }

    public function setNickname(string $Nickname): self
    {
        $this->Nickname = $Nickname;

        return $this;
    }

    public function getRol(): ?string
    {
        return $this->Rol;
    }

    public function setRol(string $Rol): self
    {
        $this->Rol = $Rol;

        return $this;
    }

    public function getNumTelegram(): ?int
    {
        return $this->Num_Telegram;
    }

    public function setNumTelegram(int $Num_Telegram): self
    {
        $this->Num_Telegram = $Num_Telegram;

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
            $reserva->setUsuario($this);
        }

        return $this;
    }

    public function removeReserva(Reserva $reserva): self
    {
        if ($this->Reservas->removeElement($reserva)) {
            // set the owning side to null (unless already changed)
            if ($reserva->getUsuario() === $this) {
                $reserva->setUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Participacion>
     */
    public function getParticipanUsuario(): Collection
    {
        return $this->ParticipanUsuario;
    }

    public function addParticipanUsuario(Participacion $participanUsuario): self
    {
        if (!$this->ParticipanUsuario->contains($participanUsuario)) {
            $this->ParticipanUsuario->add($participanUsuario);
            $participanUsuario->setUsuario($this);
        }

        return $this;
    }

    public function removeParticipanUsuario(Participacion $participanUsuario): self
    {
        if ($this->ParticipanUsuario->removeElement($participanUsuario)) {
            // set the owning side to null (unless already changed)
            if ($participanUsuario->getUsuario() === $this) {
                $participanUsuario->setUsuario(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
#[UniqueEntity(fields: ['Email'], message: 'There is already an account with this Email')]
class Usuario implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
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

    private ?string $Email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Assert\NotCompromisedPassword]
    #[Assert\Length(
        min: 3,
        max: 10,
        minMessage: 'Tu contraseña tiene que tener al menos {{ limit }} caracteres',
        maxMessage: 'Tu contraseña tiene que tener como máximo {{ limit }} caracteres',
    )]

    private ?string $password = null;

    #[ORM\OneToMany(mappedBy: 'idUsuario', targetEntity: Reserva::class)]
    private Collection $Reservas;

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
        minMessage: 'Tu primer apellido tiene que tener al menos {{ limit }} caracteres',
        maxMessage: 'Tu primer apellido tiene que tener como máximo {{ limit }} caracteres',
    )]
    private ?string $Ape2 = null;

    #[ORM\Column(length: 20)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 3,
        max: 15,
        minMessage: 'Tu nickname tiene que tener al menos {{ limit }} caracteres',
        maxMessage: 'Tu nickname tiene que tener como máximo {{ limit }} caracteres',
    )]
    private ?string $Nickname = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 9,
        max: 9,
        minMessage: 'Tu número de telegram debe ser de {{ limit }} dígitos',
        maxMessage: 'Tu número de telegram debe ser de {{ limit }} dígitos',
    )]
    private ?int $Num_telegram = null;

    #[ORM\OneToMany(mappedBy: 'Invitados', targetEntity: Evento::class, orphanRemoval: true)]
    private Collection $Eventos;

    #[ORM\ManyToMany(targetEntity: Participacion::class, mappedBy: 'idUsuario')]
    private Collection $Participaciones;

    public function __construct()
    {
        $this->Reservas = new ArrayCollection();
        $this->Eventos = new ArrayCollection();
        $this->Participaciones = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->Email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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
            $reserva->setIdUsuario($this);
        }

        return $this;
    }

    public function removeReserva(Reserva $reserva): self
    {
        if ($this->Reservas->removeElement($reserva)) {
            // set the owning side to null (unless already changed)
            if ($reserva->getIdUsuario() === $this) {
                $reserva->setIdUsuario(null);
            }
        }

        return $this;
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

    public function getNickname(): ?string
    {
        return $this->Nickname;
    }

    public function setNickname(string $Nickname): self
    {
        $this->Nickname = $Nickname;

        return $this;
    }

    public function getNumTelegram(): ?int
    {
        return $this->Num_telegram;
    }

    public function setNumTelegram(int $Num_telegram): self
    {
        $this->Num_telegram = $Num_telegram;

        return $this;
    }

    /**
     * @return Collection<int, Evento>
     */
    public function getEventos(): Collection
    {
        return $this->Eventos;
    }

    /**
     * @return Collection<int, Participacion>
     */
    public function getParticipaciones(): Collection
    {
        return $this->Participaciones;
    }

    public function addParticipacione(Participacion $participacione): self
    {
        if (!$this->Participaciones->contains($participacione)) {
            $this->Participaciones->add($participacione);
            $participacione->addIdUsuario($this);
        }

        return $this;
    }

    public function removeParticipacione(Participacion $participacione): self
    {
        if ($this->Participaciones->removeElement($participacione)) {
            $participacione->removeIdUsuario($this);
        }

        return $this;
    }
}

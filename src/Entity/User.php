<?php

namespace App\Entity;

use App\Entity\ProInfos;
use App\Entity\PersoInfos;
use App\Entity\TravelInfos;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\Unique(
        message: 'Cette adresse email est déjà utilisé',
    )]
    #[Assert\Email(
        message: 'L\'email {{ value }} est invalide.',
    )]
    #[Assert\NotBlank(
        message: 'L\'email est requis',
    )]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = ['ROLE_USER'];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 6,
        minMessage:'Le mot de passe doit avoir au moins 6 caractère'
        )]
    private ?string $password = null;

    #[ORM\OneToOne(inversedBy: 'user', cascade: ['persist', 'remove'])]
    #[Ignore]
    private ?PersoInfos $persoInfos = null;

    #[ORM\OneToOne(inversedBy: 'user', cascade: ['persist', 'remove'])]
    private ?ProInfos $proInfos = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $confirmationCode = null;

    #[ORM\OneToOne(inversedBy: 'user', cascade: ['persist', 'remove'])]
    private ?TravelInfos $travelInfos = null;

    #[ORM\Column]
    private ?bool $confirmed = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __serialize(): array
    {
        return [
            'id' => $this->getId(),
            'email' => $this->getEmail(),
            'password'=>$this->getPassword()
            // Exclude other properties that shouldn't be stored in the session
        ];
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
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

    public function setRoles(array $roles): static
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

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPersoInfos(): ?PersoInfos
    {
        return $this->persoInfos;
    }

    public function setPersoInfos(?PersoInfos $persoInfos): static
    {
        $this->persoInfos = $persoInfos;

        return $this;
    }

    public function getProInfos(): ?proInfos
    {
        return $this->proInfos;
    }

    public function setProInfos(?proInfos $proInfos): static
    {
        $this->proInfos = $proInfos;

        return $this;
    }

    public function getConfirmationCode(): ?string
    {
        return $this->confirmationCode;
    }

    public function setConfirmationCode(?string $confirmationCode): static
    {
        $this->confirmationCode = $confirmationCode;

        return $this;
    }

    public function getTravelInfos(): ?TravelInfos
    {
        return $this->travelInfos;
    }

    public function setTravelInfos(?TravelInfos $travelInfos): static
    {
        $this->travelInfos = $travelInfos;

        return $this;
    }

    public function isConfirmed(): ?bool
    {
        return $this->confirmed;
    }

    public function setConfirmed(bool $confirmed): static
    {
        $this->confirmed = $confirmed;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\PersoInfosRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PersoInfosRepository::class)]
class PersoInfos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(
        message:"Le nom est requis",
    )]
    #[Assert\NotNull(
        message:"Le nom est requis",
    )]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(
        message:"Le prénom est requis",
    )]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $otherName = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(
        message:"Le genre est requis",
    )]
    private ?string $gender = null;

    #[Assert\NotBlank(
        message:"La ville est requise",
    )]
    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(
        message:"L'adresse est requise",
    )]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(
        message:"Le pays est requis",
    )]
    private ?string $country = null;

    #[ORM\Column(length: 255)]
    #[Assert\Email(
        message: "L'email '{{ value }}' n'est pas valide."
    )]
    private ?string $persoEmail = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(
        message:"Votre email professionel est requis",
    )]
    #[Assert\Email(
        message: "L'email '{{ value }}' n'est pas valide."
    )]
    private ?string $proEmail = null;

    #[ORM\Column(length: 255)]
    #[Assert\Regex(
        pattern:"/^\+(?:[0-9] ?){6,14}[0-9]$/",
        message:"Le numéro de téléphone doit commencer par '+' suivi de 6 à 15 chiffres."
    )]
    private ?string $persoNumber = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(
        message:"Votre numéro professionel est requis",
    )]
    #[Assert\Regex(
        pattern:"/^\+(?:[0-9] ?){6,14}[0-9]$/",
        message:"Le numéro de téléphone doit commencer par '+' suivi de 6 à 15 chiffres."
    )]
    private ?string $proNumber = null;

    #[ORM\Column(length: 255)]
    private ?string $whatsApp = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToOne(inversedBy: 'persoInfos', cascade: ['persist', 'remove'])]
    #[Assert\NotBlank(
        message:"Votre photo est requise",
    )]
    private ?Photo $photo = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(
        message:"Votre nationalité est requise",
    )]
    private ?string $nationality = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(
        message:"Votre civilité est requise",
    )]
    private ?string $civility = null;

    #[ORM\OneToOne(mappedBy: 'persoInfos', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getOtherName(): ?string
    {
        return $this->otherName;
    }

    public function setOtherName(string $otherName): static
    {
        $this->otherName = $otherName;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): static
    {
        $this->gender = $gender;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getPersoEmail(): ?string
    {
        return $this->persoEmail;
    }

    public function setPersoEmail(string $persoEmail): static
    {
        $this->persoEmail = $persoEmail;

        return $this;
    }

    public function getProEmail(): ?string
    {
        return $this->proEmail;
    }

    public function setProEmail(string $proEmail): static
    {
        $this->proEmail = $proEmail;

        return $this;
    }

    public function getPersoNumber(): ?string
    {
        return $this->persoNumber;
    }

    public function setPersoNumber(string $persoNumber): static
    {
        $this->persoNumber = $persoNumber;

        return $this;
    }

    public function getProNumber(): ?string
    {
        return $this->proNumber;
    }

    public function setProNumber(string $proNumber): static
    {
        $this->proNumber = $proNumber;

        return $this;
    }

    public function getWhatsApp(): ?string
    {
        return $this->whatsApp;
    }

    public function setWhatsApp(string $whatsApp): static
    {
        $this->whatsApp = $whatsApp;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getPhoto(): ?Photo
    {
        return $this->photo;
    }

    public function setPhoto(?Photo $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(string $nationality): static
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getCivility(): ?string
    {
        return $this->civility;
    }

    public function setCivility(string $civility): static
    {
        $this->civility = $civility;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setPersoInfos(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getPersoInfos() !== $this) {
            $user->setPersoInfos($this);
        }

        $this->user = $user;

        return $this;
    }
}

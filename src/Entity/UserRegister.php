<?php

namespace App\Entity;

use App\Repository\UserRegisterRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRegisterRepository::class)]
class UserRegister
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

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(
        message:"Le nom de l'entreprise est requis",
    )]
    private ?string $companyName = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(
        message:"Le secteur est requis",
    )]
    private ?string $secteur = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(
        message:"L'adresse de l'entreprise est requis",
    )]
    private ?string $companyAdress = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(
        message:"La ville est requise",
    )]
    private ?string $city = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(
        message:"Le pays est requis",
    )]
    private ?string $country = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(
        message:"Le code postal est requis",
    )]
    private ?string $zipCode = null;

    #[ORM\Column(length: 255)]
    private ?string $userAdress = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(
        message: "L'adresse email est requise !",
    )]
    #[Assert\Email(
        message: "L'email {{ value }} est invalide !",
    )]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(
        message: "votre contact est requise !",
    )]
    private ?string $contact = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank(
        message:"Le type d'inscription est requis",
    )]
    private ?string $registerAs = null;

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

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(?string $companyName): static
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getSecteur(): ?string
    {
        return $this->secteur;
    }

    public function setSecteur(?string $secteur): static
    {
        $this->secteur = $secteur;

        return $this;
    }

    public function getCompanyAdress(): ?string
    {
        return $this->companyAdress;
    }

    public function setCompanyAdress(string $companyAdress): static
    {
        $this->companyAdress = $companyAdress;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): static
    {
        $this->city = $city;

        return $this;
    }

       /**
     * Get the value of country
     */ 
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the value of country
     *
     * @return  self
     */ 
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(?string $zipCode): static
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getUserAdress(): ?string
    {
        return $this->userAdress;
    }

    public function setUserAdress(string $userAdress): static
    {
        $this->userAdress = $userAdress;

        return $this;
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

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(?string $contact): static
    {
        $this->contact = $contact;

        return $this;
    }

    public function getRegisterAs(): ?string
    {
        return $this->registerAs;
    }

    public function setRegisterAs(?string $registerAs): static
    {
        $this->registerAs = $registerAs;

        return $this;
    }

}

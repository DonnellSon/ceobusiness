<?php

namespace App\Entity;

use App\Repository\ProInfosRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProInfosRepository::class)]
class ProInfos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $entrepriseName = null;

    #[ORM\Column(length: 255)]
    private ?string $entrepriseTitle = null;

    #[ORM\Column(length: 255)]
    private ?string $entrepriseSize = null;

    #[ORM\Column(length: 255)]
    private ?string $entrepriseActivity = null;

    #[ORM\Column(length: 255)]
    private ?string $region = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\OneToOne(mappedBy: 'proInfos', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntrepriseName(): ?string
    {
        return $this->entrepriseName;
    }

    public function setEntrepriseName(string $entrepriseName): static
    {
        $this->entrepriseName = $entrepriseName;

        return $this;
    }

    public function getEntrepriseTitle(): ?string
    {
        return $this->entrepriseTitle;
    }

    public function setEntrepriseTitle(string $entrepriseTitle): static
    {
        $this->entrepriseTitle = $entrepriseTitle;

        return $this;
    }

    public function getEntrepriseSize(): ?string
    {
        return $this->entrepriseSize;
    }

    public function setEntrepriseSize(string $entrepriseSize): static
    {
        $this->entrepriseSize = $entrepriseSize;

        return $this;
    }

    public function getEntrepriseActivity(): ?string
    {
        return $this->entrepriseActivity;
    }

    public function setEntrepriseActivity(string $entrepriseActivity): static
    {
        $this->entrepriseActivity = $entrepriseActivity;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): static
    {
        $this->region = $region;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setProInfos(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getProInfos() !== $this) {
            $user->setProInfos($this);
        }

        $this->user = $user;

        return $this;
    }
}

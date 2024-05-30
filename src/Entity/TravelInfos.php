<?php

namespace App\Entity;

use App\Repository\TravelInfosRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TravelInfosRepository::class)]
class TravelInfos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $travelAssistance = null;

    #[ORM\Column(length: 255)]
    private ?string $hotelReservation = null;

    #[ORM\Column(length: 255)]
    private ?string $airportTransfer = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $otherTravelDetails = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTravelAssistance(): ?string
    {
        return $this->travelAssistance;
    }

    public function setTravelAssistance(string $travelAssistance): static
    {
        $this->travelAssistance = $travelAssistance;

        return $this;
    }

    public function getHotelReservation(): ?string
    {
        return $this->hotelReservation;
    }

    public function setHotelReservation(string $hotelReservation): static
    {
        $this->hotelReservation = $hotelReservation;

        return $this;
    }

    public function getAirportTransfer(): ?string
    {
        return $this->airportTransfer;
    }

    public function setAirportTransfer(string $airportTransfer): static
    {
        $this->airportTransfer = $airportTransfer;

        return $this;
    }

    public function getOtherTravelDetails(): ?string
    {
        return $this->otherTravelDetails;
    }

    public function setOtherTravelDetails(?string $otherTravelDetails): static
    {
        $this->otherTravelDetails = $otherTravelDetails;

        return $this;
    }
}

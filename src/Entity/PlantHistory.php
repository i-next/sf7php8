<?php

namespace App\Entity;

use App\Repository\PlantHistoryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlantHistoryRepository::class)]
class PlantHistory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'plantHistories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Plant $plant_id = null;

    #[ORM\Column(length: 255, enumType: EnumStates::class)]
    private ?string $state = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlantId(): ?Plant
    {
        return $this->plant_id;
    }

    public function setPlantId(?Plant $plant_id): static
    {
        $this->plant_id = $plant_id;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): static
    {
        $this->state = $state;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }
}

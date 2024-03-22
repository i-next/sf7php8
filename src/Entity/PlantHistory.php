<?php

namespace App\Entity;

use App\Repository\PlantHistoryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlantHistoryRepository::class)]
#[ORM\HasLifecycleCallbacks]
class PlantHistory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'plantHistories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Plant $plant_id = null;

    #[ORM\Column(type: "string", length: 255, enumType: EnumStates::class)]
    private EnumStates $state;

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

    public function getState(): EnumStates
    {
        return $this->state;
    }

    public function setState(EnumStates $state): static
    {
        $this->state = $state;

        return $this;
    }


    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    #[ORM\PrePersist]
    public function setDate(): static
    {
        $this->date = new \DateTimeImmutable();

        return $this;
    }
}

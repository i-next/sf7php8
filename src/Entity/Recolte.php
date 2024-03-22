<?php

namespace App\Entity;

use App\Repository\RecolteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecolteRepository::class)]
class Recolte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(targetEntity: Plant::class, inversedBy: 'recolte', cascade: ['persist', 'remove'], fetch: 'EAGER')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Plant $plant = null;

    #[ORM\ManyToOne(inversedBy: 'recoltes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $userid = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $weight = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $notes = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $date_recolte = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlant(): ?Plant
    {
        return $this->plant;
    }

    public function setPlant(Plant $plant): static
    {
        $this->plant = $plant;

        return $this;
    }

    public function getUserid(): ?User
    {
        return $this->userid;
    }

    public function setUserid(?User $userid): static
    {
        $this->userid = $userid;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(?int $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): static
    {
        $this->notes = $notes;

        return $this;
    }

    public function getDateRecolte(): ?\DateTimeImmutable
    {
        return $this->date_recolte;
    }

    public function setDateRecolte(\DateTimeImmutable $date_recolte): static
    {
        $this->date_recolte = $date_recolte;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\MySeedsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MySeedsRepository::class)]
class MySeeds
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?Strain $strain = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $seeder = null;

    #[ORM\ManyToOne(inversedBy: 'mySeeds')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $userid = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column]
    private ?int $duration = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne]
    private ?Breeder $breeder = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStrain(): ?Strain
    {
        return $this->strain;
    }

    public function setStrain(?Strain $strain): static
    {
        $this->strain = $strain;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSeeder(): ?string
    {
        return $this->seeder;
    }

    public function setSeeder(?string $seeder): static
    {
        $this->seeder = $seeder;

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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getBreeder(): ?Breeder
    {
        return $this->breeder;
    }

    public function setBreeder(?Breeder $breeder): static
    {
        $this->breeder = $breeder;

        return $this;
    }
}

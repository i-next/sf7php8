<?php

namespace App\Entity;

use App\Repository\StrainRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StrainRepository::class)]
class Strain
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'strains')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Breeder $breeder = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $name_id = null;

    #[ORM\Column]
    private ?bool $auto = null;

    #[ORM\Column(nullable: true)]
    private ?int $duration = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getNameId(): ?string
    {
        return $this->name_id;
    }

    public function setNameId(string $name_id): static
    {
        $this->name_id = $name_id;

        return $this;
    }

    public function isAuto(): ?bool
    {
        return $this->auto;
    }

    public function setAuto(bool $auto): static
    {
        $this->auto = $auto;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

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
}

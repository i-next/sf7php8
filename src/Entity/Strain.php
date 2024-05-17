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

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $url_photo = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descriptionen = null;

    #[ORM\ManyToOne(inversedBy: 'strains')]
    private ?User $userid = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $logo = null;

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

    public function getUrlPhoto(): ?string
    {
        return $this->url_photo;
    }

    public function setUrlPhoto(?string $url_photo): static
    {
        $this->url_photo = $url_photo;

        return $this;
    }

    public function getDescriptionen(): ?string
    {
        return $this->descriptionen;
    }

    public function setDescriptionen(?string $descriptionen): static
    {
        $this->descriptionen = $descriptionen;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getUserId(): ?User
    {
        return $this->userid;
    }

    public function setUserId(?User $userid): static
    {
        $this->userid = $userid;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }
}

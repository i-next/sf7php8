<?php

namespace App\Entity;

use App\Entity\Traits\TimeStampableTrait;
use App\Repository\MyPlantsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MyPlantsRepository::class)]
class MyPlants
{
    use TimeStampableTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'myPlants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MySeeds $my_seeds = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $duration = null;



    #[ORM\ManyToOne(inversedBy: 'myPlants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $userid = null;

    #[ORM\Column(nullable: false)]

    private bool $finished = false;

    #[ORM\OneToOne(mappedBy: 'my_plants', cascade: ['persist', 'remove'])]
    private ?Germination $germination = null;

    #[ORM\OneToOne(mappedBy: 'my_plants', cascade: ['persist', 'remove'])]
    private ?Growths $growths = null;

    #[ORM\OneToOne(mappedBy: 'my_plants',cascade: ['persist', 'remove'])]
    private ?Preblooms $preblooms;

        #[ORM\OneToOne( mappedBy: 'my_plants', cascade: ['persist', 'remove'])]
    private ?Blooms $blooms;

    #[ORM\OneToOne(mappedBy: 'my_plants', cascade: ['persist', 'remove'])]
    private Harvests $harvests;


    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMySeeds(): ?MySeeds
    {
        return $this->my_seeds;
    }

    public function setMySeeds(?MySeeds $my_seeds): static
    {
        $this->my_seeds = $my_seeds;

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

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): static
    {
        $this->duration = $duration;

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

    public function isFinished(): ?bool
    {
        return $this->finished;
    }

    public function setFinished(bool $finished = false): static
    {
        $this->finished = $finished;

        return $this;
    }

    public function getGermination(): ?Germination
    {
        return $this->germination;
    }

    public function setGermination(?Germination $germination): void
    {
        $this->germination = $germination;
    }

    public function getGrowths(): ?Growths
    {
        return $this->growths;
    }

    public function setGrowths(?Growths $growths): void
    {
        $this->growths = $growths;
    }

    public function getPreblooms(): ?Preblooms
    {
        return $this->preblooms;
    }

    public function setPreblooms(?Preblooms $preblooms): void
    {
        $this->preblooms = $preblooms;
    }

    public function getBlooms(): ?Blooms
    {
        return $this->blooms;
    }

    public function setBlooms(?Blooms $blooms): void
    {
        $this->blooms = $blooms;
    }

    public function getHarvests(): Harvests
    {
        return $this->harvests;
    }

    public function setHarvests(Harvests $harvests): void
    {
        $this->harvests = $harvests;
    }


}

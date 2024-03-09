<?php

namespace App\Entity;

use App\Repository\PlantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlantRepository::class)]
class Plant
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "SEQUENCE")]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'plants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $userid = null;

    #[ORM\ManyToOne(inversedBy: 'plants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Seed $seedid = null;

    #[ORM\Column(length: 255, enumType: EnumStates::class)]
    private ?string $state = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_created = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_updated = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_flo = null;

    #[ORM\OneToMany(targetEntity: PlantHistory::class, mappedBy: 'plant_id')]
    private Collection $plantHistories;

    public function __construct()
    {
        $this->plantHistories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSeedid(): ?Seed
    {
        return $this->seedid;
    }

    public function setSeedid(?Seed $seedid): static
    {
        $this->seedid = $seedid;

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

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->date_created;
    }

    public function setDateCreated(\DateTimeInterface $date_created): static
    {
        $this->date_created = $date_created;

        return $this;
    }

    public function getDateUpdated(): ?\DateTimeInterface
    {
        return $this->date_updated;
    }

    public function setDateUpdated(\DateTimeInterface $date_updated): static
    {
        $this->date_updated = $date_updated;

        return $this;
    }

    public function getDateFlo(): ?\DateTimeInterface
    {
        return $this->date_flo;
    }

    public function setDateFlo(?\DateTimeInterface $date_flo): static
    {
        $this->date_flo = $date_flo;

        return $this;
    }

    /**
     * @return Collection<int, PlantHistory>
     */
    public function getPlantHistories(): Collection
    {
        return $this->plantHistories;
    }

    public function addPlantHistory(PlantHistory $plantHistory): static
    {
        if (!$this->plantHistories->contains($plantHistory)) {
            $this->plantHistories->add($plantHistory);
            $plantHistory->setPlantId($this);
        }

        return $this;
    }

    public function removePlantHistory(PlantHistory $plantHistory): static
    {
        if ($this->plantHistories->removeElement($plantHistory)) {
            // set the owning side to null (unless already changed)
            if ($plantHistory->getPlantId() === $this) {
                $plantHistory->setPlantId(null);
            }
        }

        return $this;
    }
}

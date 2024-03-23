<?php

namespace App\Entity;

use App\Repository\PlantRepository;
use App\Entity\Traits\TimeStampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Recolte;

#[ORM\Entity(repositoryClass: PlantRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Plant
{
    use TimeStampableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'plants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $userid = null;

    #[ORM\ManyToOne(fetch: 'EAGER', inversedBy: 'plants')]
    #[ORM\JoinColumn(nullable: false)]
    #[ORM\OrderBy(['name' => "ASC"])]
    private ?Seed $seedid = null;

    #[ORM\Column(type: "string", length: 255, enumType: EnumStates::class)]
    private EnumStates $state;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_flo = null;

    #[ORM\OneToMany(targetEntity: PlantHistory::class, mappedBy: 'plant_id')]
    private Collection $plantHistories;

    #[ORM\OneToOne(targetEntity: Recolte::class, mappedBy: 'plant', cascade: ['persist', 'remove'])]
    private ?Recolte $recolte = null;

    public function __construct()
    {
        $this->plantHistories = new ArrayCollection();
        $this->state = EnumStates::GERM;
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

    public function getState(): EnumStates
    {
        return $this->state;
    }

    public function setState(EnumStates $state): static
    {
        $this->state = $state;

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

    public function getRecolte(): ?Recolte
    {
        return $this->recolte;
    }

    public function setRecolte(Recolte $recolte): static
    {
        // set the owning side of the relation if necessary
        if ($recolte->getPlant() !== $this) {
            $recolte->setPlant($this);
        }

        $this->recolte = $recolte;

        return $this;
    }
}

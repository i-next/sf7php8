<?php

namespace App\Entity;

use App\Repository\SeedRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeedRepository::class)]
class Seed
{
    #[ORM\Id]
    #[ORM\GeneratedValue()]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'seeds')]
    private ?Seeder $seeder = null;

    #[ORM\ManyToOne(inversedBy: 'seeds')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $userid = null;

    #[ORM\Column]
    private ?int $Quantity = null;

    #[ORM\Column]
    private ?int $Duration = null;

    #[ORM\OneToMany(targetEntity: Plant::class, mappedBy: 'seedid', fetch: 'EAGER', orphanRemoval: true)]
    private Collection $plants;

    public function __construct()
    {
        $this->plants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSeeder(): ?Seeder
    {
        return $this->seeder;
    }

    public function setSeeder(?Seeder $seeder): static
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
        return $this->Quantity;
    }

    public function setQuantity(int $Quantity): static
    {
        $this->Quantity = $Quantity;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->Duration;
    }

    public function setDuration(int $Duration): static
    {
        $this->Duration = $Duration;

        return $this;
    }

    /**
     * @return Collection<int, Plant>
     */
    public function getPlants(): Collection
    {
        return $this->plants;
    }

    public function addPlant(Plant $plant): static
    {
        if (!$this->plants->contains($plant)) {
            $this->plants->add($plant);
            $plant->setSeedid($this);
        }

        return $this;
    }

    public function removePlant(Plant $plant): static
    {
        if ($this->plants->removeElement($plant)) {
            // set the owning side to null (unless already changed)
            if ($plant->getSeedid() === $this) {
                $plant->setSeedid(null);
            }
        }

        return $this;
    }
}

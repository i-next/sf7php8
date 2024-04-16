<?php

namespace App\Entity;

use App\Repository\BreederRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BreederRepository::class)]
class Breeder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $url_photo = null;

    #[ORM\Column(length: 255)]
    private ?string $name_id = null;

    #[ORM\OneToMany(targetEntity: Strain::class, mappedBy: 'breeder', orphanRemoval: true)]
    private Collection $strains;

    #[ORM\Column(nullable: true)]
    private ?int $quantity = null;

    public function __construct()
    {
        $this->strains = new ArrayCollection();
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

    public function getUrlPhoto(): ?string
    {
        return $this->url_photo;
    }

    public function setUrlPhoto(string $url_photo): static
    {
        $this->url_photo = $url_photo;

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

    /**
     * @return Collection<int, Strain>
     */
    public function getStrains(): Collection
    {
        return $this->strains;
    }

    public function addStrain(Strain $strain): static
    {
        if (!$this->strains->contains($strain)) {
            $this->strains->add($strain);
            $strain->setBreeder($this);
        }

        return $this;
    }

    public function removeStrain(Strain $strain): static
    {
        if ($this->strains->removeElement($strain)) {
            // set the owning side to null (unless already changed)
            if ($strain->getBreeder() === $this) {
                $strain->setBreeder(null);
            }
        }

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }
}

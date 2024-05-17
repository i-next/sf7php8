<?php

namespace App\Entity;

use App\Repository\MySeedsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MySeedsRepository::class)]
#[ORM\UniqueConstraint(name: 'unique_strain_user', columns: ['strain_id','userid_id'])]
class MySeeds
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?Strain $strain = null;

    #[ORM\ManyToOne(inversedBy: 'mySeeds')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $userid = null;

    #[ORM\Column]
    private ?int $quantity = null;

    /**
     * @var Collection<int, MyPlants>
     */
    #[ORM\OneToMany(targetEntity: MyPlants::class, mappedBy: 'my_seeds', orphanRemoval: true)]
    private Collection $myPlants;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $comment = null;

    public function __construct()
    {
        $this->myPlants = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, MyPlants>
     */
    public function getMyPlants(): Collection
    {
        return $this->myPlants;
    }

    public function addMyPlant(MyPlants $myPlant): static
    {
        if (!$this->myPlants->contains($myPlant)) {
            $this->myPlants->add($myPlant);
            $myPlant->setMySeeds($this);
        }

        return $this;
    }

    public function removeMyPlant(MyPlants $myPlant): static
    {
        if ($this->myPlants->removeElement($myPlant)) {
            // set the owning side to null (unless already changed)
            if ($myPlant->getMySeeds() === $this) {
                $myPlant->setMySeeds(null);
            }
        }

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }
}

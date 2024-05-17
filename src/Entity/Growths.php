<?php

namespace App\Entity;

use App\Entity\Traits\TimeStampableTrait;
use App\Entity\Traits\UserTrait;
use App\Repository\GrowthsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GrowthsRepository::class)]
class Growths
{
    use TimeStampableTrait;
    use UserTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?bool $finished = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_active = null;

    #[ORM\ManyToOne(inversedBy: 'growths')]
    private ?User $userid = null;

    #[ORM\OneToOne(inversedBy: 'growths', cascade: ['persist', 'remove'])]
    private ?MyPlants $my_plants = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isFinished(): ?bool
    {
        return $this->finished;
    }

    public function setFinished(?bool $finished): static
    {
        $this->finished = $finished;

        return $this;
    }

    public function getDateActive(): ?\DateTimeInterface
    {
        return $this->date_active;
    }

    public function setDateActive(?\DateTimeInterface $date_active): static
    {
        $this->date_active = $date_active;

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

    public function getMyPlants(): ?MyPlants
    {
        return $this->my_plants;
    }

    public function setMyPlants(?MyPlants $my_plants): static
    {
        $this->my_plants = $my_plants;

        return $this;
    }
}

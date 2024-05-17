<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['email'], message: 'security.register.error.login')]
class User implements UserInterface, PasswordAuthenticatedUserInterface, PasswordUpgraderInterface
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\OneToMany(targetEntity: Seed::class, mappedBy: 'userid', orphanRemoval: true)]
    private Collection $seeds;

    #[ORM\OneToMany(targetEntity: Plant::class, mappedBy: 'userid', orphanRemoval: true)]
    private Collection $plants;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $date_last_login = null;

    #[ORM\OneToMany(targetEntity: Recolte::class, mappedBy: 'userid', orphanRemoval: true)]
    private Collection $recoltes;

    #[ORM\OneToMany(targetEntity: MySeeds::class, mappedBy: 'userid', orphanRemoval: true)]
    private Collection $mySeeds;

    /**
     * @var Collection<int, Strain>
     */
    #[ORM\OneToMany(targetEntity: Strain::class, mappedBy: 'userid')]
    private Collection $strains;

    /**
     * @var Collection<int, Breeder>
     */
    #[ORM\OneToMany(targetEntity: Breeder::class, mappedBy: 'userid')]
    private Collection $breeders;

    /**
     * @var Collection<int, Germination>
     */
    #[ORM\OneToMany(targetEntity: Germination::class, mappedBy: 'userid', orphanRemoval: true)]
    private Collection $germinations;

    /**
     * @var Collection<int, MyPlants>
     */
    #[ORM\OneToMany(targetEntity: MyPlants::class, mappedBy: 'userid', orphanRemoval: true)]
    private Collection $myPlants;

    /**
     * @var Collection<int, Growths>
     */
    #[ORM\OneToMany(targetEntity: Growths::class, mappedBy: 'userid')]
    private Collection $growths;

    /**
     * @var Collection<int, Preblooms>
     */
    #[ORM\OneToMany(targetEntity: Preblooms::class, mappedBy: 'userid')]
    private Collection $preblooms;

    /**
     * @var Collection<int, Blooms>
     */
    #[ORM\OneToMany(targetEntity: Blooms::class, mappedBy: 'userid')]
    private Collection $blooms;

    /**
     * @var Collection<int, Harvests>
     */
    #[ORM\OneToMany(targetEntity: Harvests::class, mappedBy: 'userid')]
    private Collection $harvests;

    public function __construct()
    {
        $this->seeds = new ArrayCollection();
        $this->plants = new ArrayCollection();
        $this->recoltes = new ArrayCollection();
        $this->mySeeds = new ArrayCollection();
        $this->strains = new ArrayCollection();
        $this->breeders = new ArrayCollection();
        $this->germinations = new ArrayCollection();
        $this->myPlants = new ArrayCollection();
        $this->growths = new ArrayCollection();
        $this->preblooms = new ArrayCollection();
        $this->blooms = new ArrayCollection();
        $this->harvests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        // TODO: Implement upgradePassword() method.
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    /**
     * @return Collection<int, Seed>
     */
    public function getSeeds(): Collection
    {
        return $this->seeds;
    }

    public function addSeed(Seed $seed): static
    {
        if (!$this->seeds->contains($seed)) {
            $this->seeds->add($seed);
            $seed->setUserid($this);
        }

        return $this;
    }

    public function removeSeed(Seed $seed): static
    {
        if ($this->seeds->removeElement($seed)) {
            // set the owning side to null (unless already changed)
            if ($seed->getUserid() === $this) {
                $seed->setUserid(null);
            }
        }

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
            $plant->setUserid($this);
        }

        return $this;
    }

    public function removePlant(Plant $plant): static
    {
        if ($this->plants->removeElement($plant)) {
            // set the owning side to null (unless already changed)
            if ($plant->getUserid() === $this) {
                $plant->setUserid(null);
            }
        }

        return $this;
    }

    public function getDateLastLogin(): ?\DateTimeImmutable
    {
        return $this->date_last_login;
    }

    public function setDateLastLogin(?\DateTimeImmutable $date_last_login): static
    {
        $this->date_last_login = $date_last_login;

        return $this;
    }

    /**
     * @return Collection<int, Recolte>
     */
    public function getRecoltes(): Collection
    {
        return $this->recoltes;
    }

    public function addRecolte(Recolte $recolte): static
    {
        if (!$this->recoltes->contains($recolte)) {
            $this->recoltes->add($recolte);
            $recolte->setUserid($this);
        }

        return $this;
    }

    public function removeRecolte(Recolte $recolte): static
    {
        if ($this->recoltes->removeElement($recolte)) {
            // set the owning side to null (unless already changed)
            if ($recolte->getUserid() === $this) {
                $recolte->setUserid(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MySeeds>
     */
    public function getMySeeds(): Collection
    {
        return $this->mySeeds;
    }

    public function addMySeed(MySeeds $mySeed): static
    {
        if (!$this->mySeeds->contains($mySeed)) {
            $this->mySeeds->add($mySeed);
            $mySeed->setUserid($this);
        }

        return $this;
    }

    public function removeMySeed(MySeeds $mySeed): static
    {
        if ($this->mySeeds->removeElement($mySeed)) {
            // set the owning side to null (unless already changed)
            if ($mySeed->getUserid() === $this) {
                $mySeed->setUserid(null);
            }
        }

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
            $strain->setUserId($this);
        }

        return $this;
    }

    public function removeStrain(Strain $strain): static
    {
        if ($this->strains->removeElement($strain)) {
            // set the owning side to null (unless already changed)
            if ($strain->getUserId() === $this) {
                $strain->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Breeder>
     */
    public function getBreeders(): Collection
    {
        return $this->breeders;
    }

    public function addBreeder(Breeder $breeder): static
    {
        if (!$this->breeders->contains($breeder)) {
            $this->breeders->add($breeder);
            $breeder->setUserId($this);
        }

        return $this;
    }

    public function removeBreeder(Breeder $breeder): static
    {
        if ($this->breeders->removeElement($breeder)) {
            // set the owning side to null (unless already changed)
            if ($breeder->getUserId() === $this) {
                $breeder->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Germination>
     */
    public function getGerminations(): Collection
    {
        return $this->germinations;
    }

    public function addGermination(Germination $germination): static
    {
        if (!$this->germinations->contains($germination)) {
            $this->germinations->add($germination);
            $germination->setUserid($this);
        }

        return $this;
    }

    public function removeGermination(Germination $germination): static
    {
        if ($this->germinations->removeElement($germination)) {
            // set the owning side to null (unless already changed)
            if ($germination->getUserid() === $this) {
                $germination->setUserid(null);
            }
        }

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
            $myPlant->setUserid($this);
        }

        return $this;
    }

    public function removeMyPlant(MyPlants $myPlant): static
    {
        if ($this->myPlants->removeElement($myPlant)) {
            // set the owning side to null (unless already changed)
            if ($myPlant->getUserid() === $this) {
                $myPlant->setUserid(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Growths>
     */
    public function getGrowths(): Collection
    {
        return $this->growths;
    }

    public function addGrowth(Growths $growth): static
    {
        if (!$this->growths->contains($growth)) {
            $this->growths->add($growth);
            $growth->setUserid($this);
        }

        return $this;
    }

    public function removeGrowth(Growths $growth): static
    {
        if ($this->growths->removeElement($growth)) {
            // set the owning side to null (unless already changed)
            if ($growth->getUserid() === $this) {
                $growth->setUserid(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Preblooms>
     */
    public function getPreblooms(): Collection
    {
        return $this->preblooms;
    }

    public function addPrebloom(Preblooms $prebloom): static
    {
        if (!$this->preblooms->contains($prebloom)) {
            $this->preblooms->add($prebloom);
            $prebloom->setUserid($this);
        }

        return $this;
    }

    public function removePrebloom(Preblooms $prebloom): static
    {
        if ($this->preblooms->removeElement($prebloom)) {
            // set the owning side to null (unless already changed)
            if ($prebloom->getUserid() === $this) {
                $prebloom->setUserid(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Blooms>
     */
    public function getBlooms(): Collection
    {
        return $this->blooms;
    }

    public function addBloom(Blooms $bloom): static
    {
        if (!$this->blooms->contains($bloom)) {
            $this->blooms->add($bloom);
            $bloom->setUserid($this);
        }

        return $this;
    }

    public function removeBloom(Blooms $bloom): static
    {
        if ($this->blooms->removeElement($bloom)) {
            // set the owning side to null (unless already changed)
            if ($bloom->getUserid() === $this) {
                $bloom->setUserid(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Harvests>
     */
    public function getHarvests(): Collection
    {
        return $this->harvests;
    }

    public function addHarvest(Harvests $harvest): static
    {
        if (!$this->harvests->contains($harvest)) {
            $this->harvests->add($harvest);
            $harvest->setUserid($this);
        }

        return $this;
    }

    public function removeHarvest(Harvests $harvest): static
    {
        if ($this->harvests->removeElement($harvest)) {
            // set the owning side to null (unless already changed)
            if ($harvest->getUserid() === $this) {
                $harvest->setUserid(null);
            }
        }

        return $this;
    }
}

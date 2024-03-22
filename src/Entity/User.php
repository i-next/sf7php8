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
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface, PasswordUpgraderInterface
{
    //strategy: "SEQUENCE"

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

    public function __construct()
    {
        $this->seeds = new ArrayCollection();
        $this->plants = new ArrayCollection();
        $this->recoltes = new ArrayCollection();
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
}

<?php

namespace App\Entity;

use App\Repository\CircuitsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CircuitsRepository::class)]
class Circuits
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $pays = null;

    #[ORM\OneToMany(mappedBy: 'circuits', targetEntity: Sessions::class)]
    private Collection $sessions;

    #[ORM\ManyToMany(targetEntity: Classements::class, mappedBy: 'circuit')]
    private Collection $classements;

    public function __construct()
    {
        $this->sessions = new ArrayCollection();
        $this->classements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): static
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * @return Collection<int, Sessions>
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }

    public function addSession(Sessions $session): static
    {
        if (!$this->sessions->contains($session)) {
            $this->sessions->add($session);
            $session->setCircuits($this);
        }

        return $this;
    }

    public function removeSession(Sessions $session): static
    {
        if ($this->sessions->removeElement($session)) {
            // set the owning side to null (unless already changed)
            if ($session->getCircuits() === $this) {
                $session->setCircuits(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Classements>
     */
    public function getClassements(): Collection
    {
        return $this->classements;
    }

    public function addClassement(Classements $classement): static
    {
        if (!$this->classements->contains($classement)) {
            $this->classements->add($classement);
            $classement->addCircuit($this);
        }

        return $this;
    }

    public function removeClassement(Classements $classement): static
    {
        if ($this->classements->removeElement($classement)) {
            $classement->removeCircuit($this);
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\VoituresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoituresRepository::class)]
class Voitures
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $categorie = null;

    #[ORM\OneToMany(mappedBy: 'voitures', targetEntity: Sessions::class)]
    private Collection $sessions;

    #[ORM\ManyToMany(targetEntity: Classements::class, mappedBy: 'voiture')]
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

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): static
    {
        $this->categorie = $categorie;

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
            $session->setVoitures($this);
        }

        return $this;
    }

    public function removeSession(Sessions $session): static
    {
        if ($this->sessions->removeElement($session)) {
            // set the owning side to null (unless already changed)
            if ($session->getVoitures() === $this) {
                $session->setVoitures(null);
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
            $classement->addVoiture($this);
        }

        return $this;
    }

    public function removeClassement(Classements $classement): static
    {
        if ($this->classements->removeElement($classement)) {
            $classement->removeVoiture($this);
        }

        return $this;
    }
}

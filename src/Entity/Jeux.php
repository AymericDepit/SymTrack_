<?php

namespace App\Entity;

use App\Repository\JeuxRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JeuxRepository::class)]
class Jeux
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $type = null;

    #[ORM\OneToMany(mappedBy: 'jeux', targetEntity: Sessions::class)]
    private Collection $sessions;

    #[ORM\OneToMany(mappedBy: 'jeu', targetEntity: Classements::class)]
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

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
            $session->setJeux($this);
        }

        return $this;
    }

    public function removeSession(Sessions $session): static
    {
        if ($this->sessions->removeElement($session)) {
            // set the owning side to null (unless already changed)
            if ($session->getJeux() === $this) {
                $session->setJeux(null);
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
            $classement->setJeu($this);
        }

        return $this;
    }

    public function removeClassement(Classements $classement): static
    {
        if ($this->classements->removeElement($classement)) {
            // set the owning side to null (unless already changed)
            if ($classement->getJeu() === $this) {
                $classement->setJeu(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\ClassementsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClassementsRepository::class)]
class Classements
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Utilisateurs::class, inversedBy: 'classements')]
    private Collection $utilisateur;

    #[ORM\ManyToMany(targetEntity: Circuits::class, inversedBy: 'classements')]
    private Collection $circuit;

    #[ORM\ManyToOne(inversedBy: 'classements')]
    private ?Jeux $jeu = null;

    #[ORM\ManyToMany(targetEntity: Voitures::class, inversedBy: 'classements')]
    private Collection $voiture;

    #[ORM\OneToMany(mappedBy: 'classements', targetEntity: Sessions::class)]
    private Collection $temps;

    public function __construct()
    {
        $this->utilisateur = new ArrayCollection();
        $this->circuit = new ArrayCollection();
        $this->voiture = new ArrayCollection();
        $this->temps = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Utilisateurs>
     */
    public function getUtilisateur(): Collection
    {
        return $this->utilisateur;
    }

    public function addUtilisateur(Utilisateurs $utilisateur): static
    {
        if (!$this->utilisateur->contains($utilisateur)) {
            $this->utilisateur->add($utilisateur);
        }

        return $this;
    }

    public function removeUtilisateur(Utilisateurs $utilisateur): static
    {
        $this->utilisateur->removeElement($utilisateur);

        return $this;
    }

    /**
     * @return Collection<int, Circuits>
     */
    public function getCircuit(): Collection
    {
        return $this->circuit;
    }

    public function addCircuit(Circuits $circuit): static
    {
        if (!$this->circuit->contains($circuit)) {
            $this->circuit->add($circuit);
        }

        return $this;
    }

    public function removeCircuit(Circuits $circuit): static
    {
        $this->circuit->removeElement($circuit);

        return $this;
    }

    public function getJeu(): ?Jeux
    {
        return $this->jeu;
    }

    public function setJeu(?Jeux $jeu): static
    {
        $this->jeu = $jeu;

        return $this;
    }

    /**
     * @return Collection<int, Voitures>
     */
    public function getVoiture(): Collection
    {
        return $this->voiture;
    }

    public function addVoiture(Voitures $voiture): static
    {
        if (!$this->voiture->contains($voiture)) {
            $this->voiture->add($voiture);
        }

        return $this;
    }

    public function removeVoiture(Voitures $voiture): static
    {
        $this->voiture->removeElement($voiture);

        return $this;
    }

    /**
     * @return Collection<int, Sessions>
     */
    public function getTemps(): Collection
    {
        return $this->temps;
    }

    public function addTemp(Sessions $temp): static
    {
        if (!$this->temps->contains($temp)) {
            $this->temps->add($temp);
            $temp->setClassements($this);
        }

        return $this;
    }

    public function removeTemp(Sessions $temp): static
    {
        if ($this->temps->removeElement($temp)) {
            // set the owning side to null (unless already changed)
            if ($temp->getClassements() === $this) {
                $temp->setClassements(null);
            }
        }

        return $this;
    }
}

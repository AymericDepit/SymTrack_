<?php

namespace App\Entity;

use App\Repository\SessionsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SessionsRepository::class)]
class Sessions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Creneaux $creneau = null;

    #[ORM\ManyToOne(inversedBy: 'sessions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Jeux $jeux = null;

    #[ORM\ManyToOne(inversedBy: 'sessions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Circuits $circuits = null;

    #[ORM\ManyToOne(inversedBy: 'sessions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Voitures $voitures = null;

    #[ORM\Column]
    private ?int $temps = null;

    #[ORM\ManyToOne(inversedBy: 'temps')]
    private ?Classements $classements = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreneau(): ?Creneaux
    {
        return $this->creneau;
    }

    public function setCreneau(Creneaux $creneau): static
    {
        $this->creneau = $creneau;

        return $this;
    }

    public function getJeux(): ?Jeux
    {
        return $this->jeux;
    }

    public function setJeux(?Jeux $jeux): static
    {
        $this->jeux = $jeux;

        return $this;
    }

    public function getCircuits(): ?Circuits
    {
        return $this->circuits;
    }

    public function setCircuits(?Circuits $circuits): static
    {
        $this->circuits = $circuits;

        return $this;
    }

    public function getVoitures(): ?Voitures
    {
        return $this->voitures;
    }

    public function setVoitures(?Voitures $voitures): static
    {
        $this->voitures = $voitures;

        return $this;
    }

    public function getTemps(): ?int
    {
        return $this->temps;
    }

    public function setTemps(int $temps): static
    {
        $this->temps = $temps;

        return $this;
    }

    public function getClassements(): ?Classements
    {
        return $this->classements;
    }

    public function setClassements(?Classements $classements): static
    {
        $this->classements = $classements;

        return $this;
    }
}

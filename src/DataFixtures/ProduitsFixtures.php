<?php

namespace App\DataFixtures;

use App\Entity\Produits;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProduitsFixtures extends Fixture
{
    public function __construct(private SluggerInterface $slugger){}

    public function load(ObjectManager $manager): void
    {
        $produit = new Produits();
        $produit->setNom('Base R5');
        $produit->setDescription('Base R5');
        $produit->setSlug($this->slugger->slug($produit->getNom())->lower());
        $produit->setPrix('30000');
        $produit->setStock('10');
        $categorie = $this->getReference('cat-'. rand(1, 11));
        $produit->setCategories($categorie);
        $this->setReference('prod-', $categorie);
        $manager->persist($produit);

        $produit = new Produits();
        $produit->setNom('Base R9');
        $produit->setDescription('Base R9');
        $produit->setSlug($this->slugger->slug($produit->getNom())->lower());
        $produit->setPrix('50000');
        $produit->setStock('4');
        $categorie = $this->getReference('cat-'. rand(1, 11));
        $produit->setCategories($categorie);
        $this->setReference('prod-', $categorie);
        $manager->persist($produit);

        $produit = new Produits();
        $produit->setNom('Base R12');
        $produit->setDescription('Base R12');
        $produit->setSlug($this->slugger->slug($produit->getNom())->lower());
        $produit->setPrix('80000');
        $produit->setStock('2');
        $categorie = $this->getReference('cat-'. rand(1, 11));
        $produit->setCategories($categorie);
        $this->setReference('prod-', $categorie);
        $manager->persist($produit);

        $produit = new Produits();
        $produit->setNom('Base R16');
        $produit->setDescription('Base R16');
        $produit->setSlug($this->slugger->slug($produit->getNom())->lower());
        $produit->setPrix('100000');
        $produit->setStock('5');
        $categorie = $this->getReference('cat-'. rand(1, 11));
        $produit->setCategories($categorie);
        $this->setReference('prod-', $categorie);
        $manager->persist($produit);

        $produit = new Produits();
        $produit->setNom('Base R21');
        $produit->setDescription('Base R21');
        $produit->setSlug($this->slugger->slug($produit->getNom())->lower());
        $produit->setPrix('120000');
        $produit->setStock('1');
        $categorie = $this->getReference('cat-'. rand(1, 11));
        $produit->setCategories($categorie);
        $this->setReference('prod-', $categorie);
        $manager->persist($produit);

        $manager->flush();
    }
}

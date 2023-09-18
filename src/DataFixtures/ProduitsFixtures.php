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
        $produit->setNom('Moza R5');
        $produit->setDescription('Moza R5');
        $produit->setSlug($this->slugger->slug($produit->getNom())->lower());
        $produit->setPrix('34900');
        $produit->setStock('10');
        // On va chercher une categorie reference
        $categorie = $this->getReference('cat-'. rand(1, 11));
        $produit->setCategories($categorie);
        $this->setReference('prod-'.'1', $produit);
        $manager->persist($produit);

        $produit = new Produits();
        $produit->setNom('Moza R9');
        $produit->setDescription('Moza R9');
        $produit->setSlug($this->slugger->slug($produit->getNom())->lower());
        $produit->setPrix('46900');
        $produit->setStock('4');
        $categorie = $this->getReference('cat-'. rand(1, 11));
        $produit->setCategories($categorie);
        $manager->persist($produit);

        $produit = new Produits();
        $produit->setNom('Moza R12');
        $produit->setDescription('Moza R12');
        $produit->setSlug($this->slugger->slug($produit->getNom())->lower());
        $produit->setPrix('64900');
        $produit->setStock('2');
        $categorie = $this->getReference('cat-'. rand(1, 11));
        $produit->setCategories($categorie);
        $manager->persist($produit);

        $produit = new Produits();
        $produit->setNom('Moza R16');
        $produit->setDescription('Moza R16');
        $produit->setSlug($this->slugger->slug($produit->getNom())->lower());
        $produit->setPrix('86900');
        $produit->setStock('5');
        $categorie = $this->getReference('cat-'. rand(1, 11));
        $produit->setCategories($categorie);
        $manager->persist($produit);

        $produit = new Produits();
        $produit->setNom('Moza R21');
        $produit->setDescription('Moza R21');
        $produit->setSlug($this->slugger->slug($produit->getNom())->lower());
        $produit->setPrix('109900');
        $produit->setStock('5');
        $categorie = $this->getReference('cat-'. rand(1, 11));
        $produit->setCategories($categorie);
        $manager->persist($produit);

        $produit = new Produits();
        $produit->setNom('CSL DD (5Nm)');
        $produit->setDescription('CSL DD (5Nm)');
        $produit->setSlug($this->slugger->slug($produit->getNom())->lower());
        $produit->setPrix('34995');
        $produit->setStock('1');
        $categorie = $this->getReference('cat-'. rand(1, 11));
        $produit->setCategories($categorie);
        $manager->persist($produit);

        $produit = new Produits();
        $produit->setNom('CSL DD (8Nm)');
        $produit->setDescription('CSL DD (8Nm)');
        $produit->setSlug($this->slugger->slug($produit->getNom())->lower());
        $produit->setPrix('49995');
        $produit->setStock('3');
        $categorie = $this->getReference('cat-'. rand(1, 11));
        $produit->setCategories($categorie);
        $manager->persist($produit);

        $produit = new Produits();
        $produit->setNom('Gran Turismo DD Pro Wheel Base (8Nm)');
        $produit->setDescription('Gran Turismo DD Pro Wheel Base (8Nm)');
        $produit->setSlug($this->slugger->slug($produit->getNom())->lower());
        $produit->setPrix('59995');
        $produit->setStock('7');
        $categorie = $this->getReference('cat-'. rand(1, 11));
        $produit->setCategories($categorie);
        $manager->persist($produit);

        $produit = new Produits();
        $produit->setNom('Podium Wheel Base DD1');
        $produit->setDescription('Podium Wheel Base DD1');
        $produit->setSlug($this->slugger->slug($produit->getNom())->lower());
        $produit->setPrix('119995');
        $produit->setStock('4');
        $categorie = $this->getReference('cat-'. rand(1, 11));
        $produit->setCategories($categorie);
        $manager->persist($produit);

        $produit = new Produits();
        $produit->setNom('Podium Wheel Base DD2');
        $produit->setDescription('Podium Wheel Base DD2');
        $produit->setSlug($this->slugger->slug($produit->getNom())->lower());
        $produit->setPrix('149995');
        $produit->setStock('6');
        $categorie = $this->getReference('cat-'. rand(1, 11));
        $produit->setCategories($categorie);
        $manager->persist($produit);

        $produit = new Produits();
        $produit->setNom('T818');
        $produit->setDescription('T818');
        $produit->setSlug($this->slugger->slug($produit->getNom())->lower());
        $produit->setPrix('64999');
        $produit->setStock('2');
        $categorie = $this->getReference('cat-'. rand(1, 11));
        $produit->setCategories($categorie);
        $manager->persist($produit);

        $manager->flush();
    }
}

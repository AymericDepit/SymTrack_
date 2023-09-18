<?php

namespace App\DataFixtures;

use App\Entity\Images;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ImagesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker =Factory::create('fr_FR');

        for ($img = 1; $img<=30; $img++){
            $image = new Images();
            $image->setNom($faker->image(null, 640, 480));
            $produit = $this->getReference('prod-' .'1');
            $image->setProduits($produit);
            $manager->persist($image);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [ProduitsFixtures::class];
    }
}

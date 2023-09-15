<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;
use function Webmozart\Assert\Tests\StaticAnalysis\null;

class CategoriesFixtures extends Fixture
{
    private $counter = 1;
    public function __construct(private SluggerInterface $slugger)
    {

    }
    public function load(ObjectManager $manager): void
    {
         $parent = $this->createCategorie('Materiels de simulation', null, $manager);
         $this->createCategorie('Bases volants', $parent,$manager);
         $this->createCategorie('Volants', $parent,$manager);
         $this->createCategorie('Pedaliers', $parent,$manager);
         $this->createCategorie('Boite de vitesse', $parent,$manager);
         $this->createCategorie('Frein a main', $parent,$manager);
         $this->createCategorie('Accessoires', $parent,$manager);

         $parent = $this->createCategorie('Sieges et chassis', null, $manager);
         $this->createCategorie('Playseat', $parent, $manager);
         $this->createCategorie('Oplite', $parent,$manager);
         $this->createCategorie('Rseat', $parent,$manager);

         $manager->flush();
    }

    public function createCategorie(string $nom, Categories $parent = null,
                                    ObjectManager $manager)
    {
        $categorie = new Categories();
        $categorie->setNom($nom);
        $categorie->setSlug($this->slugger->slug($categorie->getNom())->lower());
        $categorie->setParent($parent);
        $manager->persist($categorie);

        $this->addReference('cat-'.$this->counter, $categorie);
        $this->counter++;

        return $categorie;
    }
}

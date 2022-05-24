<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategorieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $categ = new Categorie();
        $categ->setNom('Peinture');
        $categ->setDescription('Aquarelle,Fusain,Huile');
        $categ->setCtgOvr(null);

        $manager->persist($categ);
        $manager->flush();
    }
}

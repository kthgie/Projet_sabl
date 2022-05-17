<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategorieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $categorie = new Categorie();
        $categorie->setNom("Tableau")
        ->setDescription("une toile peinte tendue sur un cadre");
        $manager->persist($categorie);

        $categorie = new Categorie();
        $categorie->setNom("Sculpture")
        ->setDescription("un bloc de pierre taillé afin de lui donner la forme souhaitée");
        $manager->persist($categorie);

        $categorie = new Categorie();
        $categorie->setNom("Poterie")
        ->setDescription("une fabrication humaine destinée à faire office de récipient");
        $manager->persist($categorie);

        $manager->flush();
    }
}

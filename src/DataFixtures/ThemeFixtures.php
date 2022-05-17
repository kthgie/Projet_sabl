<?php

namespace App\DataFixtures;

use App\Entity\Theme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ThemeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $theme = new Theme();
        $theme->setNom("Egypte Antique")
        ->setDescription("du temps des grands pharaons");
        $manager->persist($theme);

        $theme = new Theme();
        $theme->setNom("Préhistoire")
        ->setDescription("vestiges datant d'avant l'écriture");
        $manager->persist($theme);

        $theme = new Theme();
        $theme->setNom("Empire Romain")
        ->setDescription("de César à Augustin");
        $manager->persist($theme);

        $theme = new Theme();
        $theme->setNom("Corps féminins")
        ->setDescription("la femme à travers le temps");
        $manager->persist($theme);

        $manager->flush();
    }
}

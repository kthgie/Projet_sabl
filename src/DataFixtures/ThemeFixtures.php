<?php

namespace App\DataFixtures;

use App\Entity\Theme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ThemeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $theme = new Theme();
        $theme->setNom('Renaissance');
        $theme->setDescription('XIVᵉ au XVIᵉ');

        $manager->flush();
    }
}

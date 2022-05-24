<?php

namespace App\DataFixtures;

use App\Entity\Oeuvre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OeuvreFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $oeuvre = new Oeuvre();
        $oeuvre->setNom('La nuit étoilé');
        $oeuvre->setDescription('lbhsfhozruhfofhf');
        $oeuvre->setArtiste('Vincent Van Gogh');
        $oeuvre->setAnnée('1889');
        $oeuvre->setImage('Image1');

        $manager->persist($oeuvre);
        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\Interfaces\IRoles;
use App\Entity\Utilisateur;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface ;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UtilisateurFixtures extends Fixture implements IRoles
{
    private $userPasswordHasher;
    public function __construct(UserPasswordHasherInterface $userPasswordHasher) 
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $user = new Utilisateur();
        $user->setEmail('lele@lulu.com');
        $user->addRoles(self::ROLE_ADMIN);
        $user->setPassword($this->userPasswordHasher->hashPassword(
            $user,
            "leledu77"
        )
        );
        $manager->persist($user);

        $manager->flush();
    }
}

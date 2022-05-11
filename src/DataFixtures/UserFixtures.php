<?php

namespace App\DataFixtures;

use App\Entity\Interfaces\IRoles;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements IRoles
{
    private $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail("member@member.fr");
        // $user->SetNom("username"); On a pas fait le Setter
        // $user->SetPrenom("name");  On a pas fait le Setter
        $user->setPassword($this->userPasswordHasher->hashPassword(
            $user,
            "coucou"
        )
        );
        $manager->persist($user); // Ajoute cet nouvel user dans le sac

        $user = new User();
        $user->setEmail("admin@admin.fr");
        // $user->SetNom("username"); On a pas fait le Setter
        // $user->SetPrenom("name");  On a pas fait le Setter
        $user->addRoles(self::ROLE_ADMIN);
        $user->setPassword($this->userPasswordHasher->hashPassword(
            $user,
            "raikette"
            )
        );
        $manager->persist($user); // Ajoute cet nouvel user dans le sac
        $manager->flush(); // Le flush ajoute ,après on fait le d:f:l
    }



}

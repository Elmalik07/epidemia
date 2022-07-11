<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
     private $passwordHasher;

     public function __construct(UserPasswordHasherInterface $passwordHasher)
     {
         $this->passwordHasher = $passwordHasher;
     }
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail("a.fall@gmail.com");
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->passwordHasher->hashPassword($user, "passer"));

        $manager->persist($user);

        $user1 = new User();
        $user1->setEmail("agent@gmail.com");
        $user1->setRoles(['ROLE_USER']);
        $user1->setPassword($this->passwordHasher->hashPassword($user1, "passer"));

        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail("vendeur@gmail.com");
        $user2->setRoles(['ROLE_AGENT']);
        $user2->setPassword($this->passwordHasher->hashPassword($user2, "passer"));

        $manager->persist($user2);
        $manager->flush();
        
    }
}

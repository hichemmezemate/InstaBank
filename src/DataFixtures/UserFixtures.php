<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $EncoderPassword;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->EncoderPassword = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0 ; $i < 20 ; $i++)
        {
            $user = new User();
            $user->setRoles(['ROLE_USER']);
            $user->setPrenom($faker->name);
            $user->setNom($faker->lastName);
            $user->setEmail($faker->email);
            $user->setPassword($this->EncoderPassword->hashPassword($user,'password'));
            $this->addReference('user_' . $i, $user);
            $manager->persist($user);
        }

        $manager->flush();
    }
}

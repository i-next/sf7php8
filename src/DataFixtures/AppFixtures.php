<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Seeder;
use App\Entity\Seed;
use App\Entity\User;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('test@test.fr');
        $user->setPassword('$2y$13$canU1KQIGlH4661Bpu3d8urhHX/3zMlByL1T.Z8LwXz72wdvgBUAC');
        $manager->persist($user);
        $seeder = new Seeder();
        $seeder->setName('testseederfix');
        $manager->persist($seeder);
        $manager->flush();
        $seed = new Seed();
        $seed->setUserid($user);
        $seed->setSeeder($seeder);
        $seed->setName('testseedfix');
        $seed->setDuration(8);
        $seed->setQuantity(2);
        $manager->persist($seed);
        $manager->flush();
    }
}

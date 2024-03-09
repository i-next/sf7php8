<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use App\Repository\SeederRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SeedControllerTest extends WebTestCase
{
    public function testSeedIndex(): void
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);

        // retrieve the test user
        $testUser = $userRepository->findOneByEmail('test@test.fr');

        // simulate $testUser being logged in
        $client->loginUser($testUser);

        $crawler = $client->request('GET', '/seed');
        $this->assertGreaterThan(
            0,
            $crawler->filter('td:contains("testseedfix")')->count()
        );
        $this->assertResponseIsSuccessful();
    }

     public function testSeedAdd(): void
     {
         $client = static::createClient();
         $userRepository = static::getContainer()->get(UserRepository::class);
         // retrieve the test user
         $testUser = $userRepository->findOneByEmail('test@test.fr');

         $seederRepository = static::getContainer()->get(SeederRepository::class);
         $testSeeder = $seederRepository->findOneByName('testseederfix');
         // simulate $testUser being logged in
         $client->loginUser($testUser);
         $crawler = $client->request('GET', '/seed/new');
         $form = $crawler->filter('form[name="seed"]')->form();
         $client->submit($form, [
             'seed[name]'       => 'testseed',
             'seed[seeder]'     => $testSeeder->getId(),
             'seed[Quantity]'   => 2,
             'seed[Duration]'   => 8
         ]);
         $this->assertResponseStatusCodeSame('303');
     }
}

<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SeederControllerTest extends WebTestCase
{
    public function testSeederInder(): void
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);

        // retrieve the test user
        $testUser = $userRepository->findOneByEmail('test@test.fr');

        // simulate $testUser being logged in
        $client->loginUser($testUser);
        $crawler = $client->request('GET', '/seeder');

        $this->assertGreaterThan(
            0,
            $crawler->filter('td:contains("testseederfix")')->count()
        );
        $this->assertResponseIsSuccessful();
    }

    public function testSeederAdd(): void
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);

        // retrieve the test user
        $testUser = $userRepository->findOneByEmail('test@test.fr');

        // simulate $testUser being logged in
        $client->loginUser($testUser);
        $crawler = $client->request('GET', '/seeder/new');
        $form = $crawler->filter('form[name="seeder"]')->form();
        $client->submit($form, [
            'seeder[name]' => 'testseeder'
        ]);
        $this->assertResponseStatusCodeSame('303');
    }

}

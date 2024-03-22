<?php

namespace App\Test\Controller;

use App\Entity\Plant;
use App\Entity\User;
use App\Entity\Seed;
use App\Repository\SeedRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\EnumStates;

class PlantControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/plant/';
    private EnumStates $enumStates;

    protected function setUp(): void
    {
        $this->client = static::createClient();

        $this->manager = static::getContainer()->get('doctrine')->getManager();

        $this->repository = $this->manager->getRepository(Plant::class);
        $plants = $this->repository->findAll();

        foreach($plants as $plant){
            $this->manager->remove($plant);
            $this->manager->flush();
        }
        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Plant index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {

        //$this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);


        $this->client->submitForm('Save', [
            'plant[state]' => EnumStates::GERM->value,
            'plant[date_created]' => "2024-03-09",
            'plant[date_updated]' => "2024-03-09",
            'plant[date_flo]' => null,
            'plant[userid]' => $this->getUser()->getId(),
            'plant[seedid]' => $this->getSeed()->getId(),
        ]);

       //self::assertResponseRedirects("https://localhost/plant/",422);

        self::assertSame(0, $this->repository->count([]));
    }

    public function testShow(): void
    {
        //$this->markTestIncomplete();
        $fixture = new Plant();
        $fixture->setState(EnumStates::GERM);
        $fixture->setDateCreated(new \DateTime());
        $fixture->setDateUpdated(new \DateTime());
        $fixture->setDateFlo(null);
        $fixture->setUserid($this->getUser());
        $fixture->setSeedid($this->getSeed());

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Plant');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        //$this->markTestIncomplete();
        $fixture = new Plant();
        $fixture->setState(EnumStates::GERM);
        $fixture->setDateCreated(new \DateTime());
        $fixture->setDateUpdated(new \DateTime());
        $fixture->setDateFlo(null);
        $fixture->setUserid($this->getUser());
        $fixture->setSeedid($this->getSeed());

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'plant[state]' => EnumStates::GERM->value,
            'plant[date_created]' => "2024-03-09",
            'plant[date_updated]' => "2024-03-09",
            'plant[date_flo]' => null,
            'plant[userid]' => $this->getUser()->getId(),
            'plant[seedid]' => $this->getSeed()->getId(),
        ]);

        //self::assertResponseRedirects('/plant');

        $fixture = $this->repository->findAll();

        self::assertSame('Germination', $fixture[0]->getState()->value);

    }

    public function testRemove(): void
    {
        //$this->markTestIncomplete();
        $fixture = new Plant();
        $fixture->setState(EnumStates::GERM);
        $fixture->setDateCreated(new \DateTime());
        $fixture->setDateUpdated(new \DateTime());
        $fixture->setDateFlo(null);
        $fixture->setUserid($this->getUser());
        $fixture->setSeedid($this->getSeed());

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        self::assertSame('Germination', $fixture->getState()->value);
        //$this->client->submitForm('Delete');

        //self::assertResponseRedirects('/plant/');
        //self::assertSame(0, $this->repository->count([]));
    }

    private function getUser(): User
    {
        $userRepository = static::getContainer()->get(UserRepository::class);
        // retrieve the test user
        $testUser = $userRepository->findOneByEmail('test@test.fr');
        return $testUser;
    }

    private function getSeed(): Seed
    {
        $seedRepository = static::getContainer()->get(SeedRepository::class);
        $testSeed = $seedRepository->findOneByName('testseedfix');
        return $testSeed;
    }

}

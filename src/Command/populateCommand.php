<?php

namespace App\Command;

use App\Entity\Breeder;
use App\Entity\Strain;
use App\Repository\BreederRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Doctrine\ORM\EntityManagerInterface;

#[AsCommand(name: 'app:populate', description: 'Populate breeder strain', hidden: false)]
class populateCommand extends Command
{

    public function __construct(private readonly HttpClientInterface $httpClient, private readonly EntityManagerInterface $entityManager, private readonly BreederRepository $breederRepository)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $breedersAPI = $this->httpClient->request('GET','https://fr.seedfinder.eu/api/json/ids.json?br=all&strains=1&ac=2b9ff84d30c910dbd1b988a176107f49');
        foreach ($breedersAPI->toArray() as $name_breeder_id => $breederData){
            $output->writeln('Breeder: '.$breederData['name']);
            $oldBreeder = $this->breederRepository->findBy(['name' => $breederData['name']]);
            if(!$oldBreeder){
                $breeder = new Breeder();
                $breeder->setNameId($name_breeder_id);
                $breeder->setName($breederData['name']);
                $breeder->setUrlPhoto('https://fr.seedfinder.eu/pics/00breeder/'.$breederData['logo']);
                $this->entityManager->persist($breeder);
                $this->entityManager->flush();
                foreach($breederData['strains'] as $name_strain_id => $strain){
                    $strainAPI = $this->httpClient->request('GET','https://fr.seedfinder.eu/api/json/strain.json?br='.$name_breeder_id.'&str='.$name_strain_id.'&lng=fr&ac=2b9ff84d30c910dbd1b988a176107f49');
                    $strainData =$strainAPI->toArray();
                    $strain = new Strain();
                    $output->writeln('Strain: '.$strainData['name']);
                    $strain->setBreeder($breeder);
                    $strain->setName($strainData['name']);
                    $strain->setNameId($strainData['id']);
                    $strain->setType($strainData['brinfo']['type']);
                    $strain->setDuration($strainData['brinfo']['flowering']['days']);
                    $strain->setAuto($strainData['brinfo']['flowering']['auto']);
                    $strain->setDescription(mb_convert_encoding($strainData['brinfo']['descr'], 'UTF-8', 'ISO-8859-1')??'');
                    $this->entityManager->persist($strain);
                    $this->entityManager->flush();
                }
            }
        }
        return Command::SUCCESS;
    }

}

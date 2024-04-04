<?php

namespace App\Command;

use App\Entity\Breeder;
use App\Entity\Strain;
use App\Repository\BreederRepository;
use PHPUnit\Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Logging\Middleware;
use Psr\Log\NullLogger;

#[AsCommand(name: 'app:populate', description: 'Populate breeder strain', hidden: false)]
class populateCommand extends Command
{

    public function __construct(private readonly HttpClientInterface $httpClient, private readonly EntityManagerInterface $entityManager, private readonly BreederRepository $breederRepository)
    {
        parent::__construct();
    }

    /**
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws TransportExceptionInterface
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->entityManager->getConnection()->getConfiguration()->setMiddlewares([new Middleware(new NullLogger())]);
        $breedersAPI = $this->httpClient->request('GET','https://fr.seedfinder.eu/api/json/ids.json?br=all&strains=1&ac=2b9ff84d30c910dbd1b988a176107f49');
        foreach ($breedersAPI->toArray() as $name_breeder_id => $breederData){
            $output->writeln('Breeder: '.$breederData['name']);
            $output->writeln(memory_get_usage());
            $output->writeln(memory_get_peak_usage());
            $oldBreeder = $this->breederRepository->findBy(['name' => $breederData['name']]);
            if(!$oldBreeder && array_key_exists('name',$breederData)){
                $breeder = new Breeder();

                $breeder->setNameId($name_breeder_id);
                $breeder->setName($breederData['name']);
                $breeder->setUrlPhoto('https://fr.seedfinder.eu/pics/00breeder/'.$breederData['logo']);
                $this->entityManager->persist($breeder);

                foreach($breederData['strains'] as $name_strain_id => $strain){

                    $strainAPI = $this->httpClient->request('GET','https://fr.seedfinder.eu/api/json/strain.json?br='.$name_breeder_id.'&str='.$name_strain_id.'&lng=fr&ac=2b9ff84d30c910dbd1b988a176107f49');
                    try{
                        $strainData = $strainAPI->toArray();
                    }catch (\Throwable $t){
                        continue;
                    }
                    if(array_key_exists('name',$strainData)){
                        $strain = new Strain();
                        $output->writeln('Strain: '.$strainData['name']);
                        $strain->setBreeder($breeder);
                        $strain->setName($strainData['name']);
                        $strain->setNameId($strainData['id']);
                        $strain->setType($strainData['brinfo']['type']);
                        $strain->setDuration($strainData['brinfo']['flowering']['days']);
                        $strain->setAuto($strainData['brinfo']['flowering']['auto']);
                        $strain->setDescription(mb_convert_encoding(json_encode($strainData['brinfo']['descr'], JSON_INVALID_UTF8_IGNORE), 'UTF-8', 'UTF-8')??'');
                        $this->entityManager->persist($strain);

                        $strain = $strainData = null;
                    }

                }
                $this->entityManager->flush();
                $this->entityManager->detach($breeder);
                $this->entityManager->clear();
                $breeder = null;
                gc_collect_cycles();
            }


        }
        return Command::SUCCESS;
    }

}

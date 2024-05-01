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
use Symfony\Component\HttpKernel\KernelInterface;
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

    public function __construct(private readonly HttpClientInterface $httpClient, private readonly EntityManagerInterface $entityManager, private readonly BreederRepository $breederRepository, private readonly KernelInterface $kernel)
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
            $oldBreeder = $this->breederRepository->findBy(['name' => $breederData['name']]);
            if(!$oldBreeder && array_key_exists('name',$breederData)){
            $breeder = new Breeder();

            $breeder->setNameId($name_breeder_id);
            $breeder->setName($breederData['name']);
            $breeder->setUrlPhoto('https://fr.seedfinder.eu/pics/00breeder/'.$breederData['logo']);
            $urlPhoto = $breederData['logo'];
            $folderDest = $this->kernel->getProjectDir();
            $this->entityManager->persist($breeder);
            $this->entityManager->flush();
            if($urlPhoto){
                $output->writeln('Breeder: ' . $breeder->getUrlPhoto());
                $tmpfile = explode('.', $breeder->getUrlPhoto());
                $output->writeln('ext: ' . end($tmpfile));
                $destfile = $folderDest . '/public/upload/images/breeder/' . $breeder->getId() . '.' . end($tmpfile);
                $destname = 'upload/images/breeder/' . $breeder->getId() . '.' . end($tmpfile);
                $ch = curl_init($breeder->getUrlPhoto());
                @curl_exec($ch);
                $fp = fopen($destfile, 'wb');
                curl_setopt($ch, CURLOPT_FILE, $fp);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_exec($ch);
                curl_close($ch);
                fclose($fp);
                $breeder->setLogo($destname);

            }
            $breeder->setQuantity(count($breederData['strains']));
            $this->entityManager->persist($breeder);

            foreach($breederData['strains'] as $name_strain_id => $strain){

                $strainAPI = $this->httpClient->request('GET','https://fr.seedfinder.eu/api/json/strain.json?br='.$name_breeder_id.'&str='.$name_strain_id.'&lng=fr&reviews=1&ac=2b9ff84d30c910dbd1b988a176107f49');
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
                    //$strain->setDescription(html_entity_decode($strainData['brinfo']['descr']));
                    $strain->setDescription(mb_convert_encoding(json_encode($strainData['brinfo']['descr'], JSON_INVALID_UTF8_IGNORE), 'UTF-8', 'UTF-8')??'');
                    $strain->setUrlPhoto($strainData['brinfo']['pic']);
                    $urlPhoto = $strainData['brinfo']['pic'];
                    $folderDest = $this->kernel->getProjectDir();
                    $this->entityManager->persist($strain);
                    $this->entityManager->flush();
                    if($urlPhoto){
                        $output->writeln('Strain: ' . $strain->getUrlPhoto());
                        $tmpfile = explode('.', $strain->getUrlPhoto());
                        $output->writeln('ext: ' . end($tmpfile));
                        $destfile = $folderDest . '/public/upload/images/strain/' . $strain->getId() . '.' . end($tmpfile);
                        $destname = 'upload/images/strain/' . $strain->getId() . '.' . end($tmpfile);
                        $ch = curl_init($strain->getUrlPhoto());
                        @curl_exec($ch);
                        $fp = fopen($destfile, 'wb');
                        curl_setopt($ch, CURLOPT_FILE, $fp);
                        curl_setopt($ch, CURLOPT_HEADER, 0);
                        curl_exec($ch);
                        curl_close($ch);
                        fclose($fp);
                        $strain->setLogo($destname);

                    }
                    $this->entityManager->persist($strain);
                    $strainAPIen = $this->httpClient->request('GET','https://fr.seedfinder.eu/api/json/strain.json?br='.$name_breeder_id.'&str='.$name_strain_id.'&lng=en&ac=2b9ff84d30c910dbd1b988a176107f49');
                    try{
                        $strainDataen = $strainAPIen->toArray();
                        //$strain->setDescriptionen(html_entity_decode($strainDataen['brinfo']['descr']));
                        $strain->setDescriptionen(mb_convert_encoding(json_encode($strainDataen['brinfo']['descr'], JSON_INVALID_UTF8_IGNORE), 'UTF-8', 'UTF-8')??'');
                        $this->entityManager->persist($strain);
                    }catch (\Throwable $t){
                        continue;
                    }


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

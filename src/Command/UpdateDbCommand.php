<?php

namespace App\Command;

use App\Entity\Breeder;
use App\Entity\Strain;
use App\Repository\BreederRepository;
use App\Repository\StrainRepository;
use Doctrine\DBAL\Logging\Middleware;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\NullLogger;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(
    name: 'app:update-db',
    description: 'Add a short description for your command',
)]
class UpdateDbCommand extends Command
{
    public function __construct(private readonly HttpClientInterface $httpClient, private readonly EntityManagerInterface $entityManager, private readonly BreederRepository $breederRepository,private readonly StrainRepository $strainRepository, private readonly KernelInterface $kernel)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
       /* $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;*/
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
       /* $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');*/
        $this->entityManager->getConnection()->getConfiguration()->setMiddlewares([new Middleware(new NullLogger())]);
        $folderDest = $this->kernel->getProjectDir();
        $breedersAPI = $this->httpClient->request('GET', 'https://fr.seedfinder.eu/api/json/ids.json?br=all&strains=1&ac=2b9ff84d30c910dbd1b988a176107f49');
        /* Breeders */
        $add= false;
        foreach ($breedersAPI->toArray() as $name_breeder_id => $breederData) {
            if($breederData['name'] === 'Seattle Chronic Seeds'){
                $add = true;
            }
            if($add){
            $oldBreeder = $this->breederRepository->findOneBy(['name_id' => $name_breeder_id]);
            if(!$oldBreeder && array_key_exists('name', $breederData)) {
                $output->writeln('New Breeder: ' . $breederData['name']);
                $breeder = new Breeder();
                $breeder->setNameId($name_breeder_id);
                $breeder->setName($breederData['name']);
                $this->entityManager->persist($breeder);
                if($breederData['logo']){
                    $output->writeln('Breeder logo: ' . $breederData['logo']);
                    $breeder->setUrlPhoto('https://fr.seedfinder.eu/pics/00breeder/'.$breederData['logo']);
                    $tmpfile = explode('.', $breeder->getUrlPhoto());
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
                $this->entityManager->flush();
            }else{
                $breeder = $oldBreeder;
                $output->writeln('Breeder: ' . $breeder->getName());
            }
            $strains = $breederData['strains'];
            $breeder->setQuantity(count($strains));
            $this->entityManager->persist($breeder);
            $this->entityManager->flush();
            /* Strains*/
            foreach($strains as $name_strain_id => $strain) {
                $strainAPI = $this->httpClient->request('GET', 'https://fr.seedfinder.eu/api/json/strain.json?br=' . $name_breeder_id . '&str=' . $name_strain_id . '&lng=fr&reviews=1&ac=2b9ff84d30c910dbd1b988a176107f49');
                try {
                    $strainData = $strainAPI->toArray();
                } catch (\Throwable $t) {
                    continue;
                }
                $oldStrain = $this->strainRepository->findOneBy(['name_id' => $name_strain_id,'breeder' => $breeder]);
                if(!$oldStrain && array_key_exists('name',$strainData)){
                    $output->writeln('New Strain: ' . $strainData['name']);
                    $strain = new Strain();
                    $strain->setBreeder($breeder);
                    $strain->setName($strainData['name']);
                    $strain->setNameId($strainData['id']);
                    $strain->setType($strainData['brinfo']['type']);
                    $strain->setDuration($strainData['brinfo']['flowering']['days']);
                    $strain->setAuto($strainData['brinfo']['flowering']['auto']);
                    $output->writeln('Strain logo: ' . $strainData['brinfo']['pic']);
                    $strain->setUrlPhoto($strainData['brinfo']['pic']);
                    $this->entityManager->persist($strain);

                    $urlPhoto = $strainData['brinfo']['pic'];
                    if($urlPhoto) {
                        $tmpfile = explode('.', $strain->getUrlPhoto());
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
                    $this->entityManager->flush();
                }else{
                    $strain = $oldStrain;
                    if(array_key_exists('name',$strainData)) {
                        $output->writeln('Strain: ' . $strain->getName() ?: null);
                        $output->writeln($strain->getId());
                    }
                }

                if(array_key_exists('name',$strainData)){
                    $strain->setDescription(html_entity_decode($strainData['brinfo']['descr']));
                    $strainAPIen = $this->httpClient->request('GET', 'https://fr.seedfinder.eu/api/json/strain.json?br='.$name_breeder_id.'&str='.$name_strain_id.'&lng=en&ac=2b9ff84d30c910dbd1b988a176107f49');
                    try {
                        $strainDataen = $strainAPIen->toArray();
                        $strain->setDescriptionen(html_entity_decode($strainDataen['brinfo']['descr']));
                    } catch (\Throwable $t) {
                        continue;
                    }
                    $this->entityManager->persist($strain);
                }
                if($strain instanceof Strain){
                    $this->entityManager->flush();
                    $this->entityManager->detach($strain);
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

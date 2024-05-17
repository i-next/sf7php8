<?php

namespace App\Command;

use App\Repository\BreederRepository;
use App\Repository\StrainRepository;
use Doctrine\DBAL\Logging\Middleware;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\NullLogger;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(name: 'app:breeder:pictures', description: 'upload breeder image', hidden: false)]
class breederPicturesUpdateCommand extends Command
{
    public function __construct(private readonly HttpClientInterface $httpClient, private readonly EntityManagerInterface $entityManager, private readonly BreederRepository $breederRepository, private readonly KernelInterface $kernel, private readonly StrainRepository $strainRepository)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {


        $folderDest = $this->kernel->getProjectDir();
        $this->entityManager->getConnection()->getConfiguration()->setMiddlewares([new Middleware(new NullLogger())]);
        $breeders = $this->breederRepository->findAll();
        foreach ($breeders as $breeder) {
            $output->writeln('Breeder: ' . $breeder->getUrlPhoto());
            if ($breeder->getUrlPhoto()) {
                $tmpfile = explode('.', $breeder->getUrlPhoto());
                $output->writeln('ext: ' . end($tmpfile));

                //$fileTransfert = file_put_contents($folderDest.'/public/upload/images/breeder/'.$breeder->getId().'.'.end($tmpfile),file_get_contents($breeder->getUrlPhoto()));
                $destfile = $folderDest . '/public/upload/images/breeder/' . $breeder->getId() . '.' . end($tmpfile);
                $ch = curl_init($breeder->getUrlPhoto());
                //@curl_exec($ch);
                $fp = @fopen($destfile, 'wb');
                curl_setopt($ch, CURLOPT_FILE, $fp);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_VERBOSE, false);
                @curl_exec($ch);
                curl_close($ch);
                fclose($fp);
                /*$breeder->setLogo($destfile);
                $this->entityManager->persist($breeder);*/
            }
        }
        $strains = $this->strainRepository->findAll();
        foreach($strains as $strain) {
            $output->writeln('Strain: ' . $strain->getUrlPhoto());
            if($strain->getUrlPhoto()) {
                $tmpfile = explode('.', $strain->getUrlPhoto());
                $output->writeln('ext: ' . end($tmpfile));

                //$fileTransfert = file_put_contents($folderDest.'/public/upload/images/breeder/'.$breeder->getId().'.'.end($tmpfile),file_get_contents($breeder->getUrlPhoto()));
                $destfile = $folderDest . '/public/upload/images/strain/' . $strain->getId() . '.' . end($tmpfile);
                $ch = curl_init($strain->getUrlPhoto());
                //@curl_exec($ch);
                $fp = @fopen($destfile, 'wb');
                curl_setopt($ch, CURLOPT_FILE, $fp);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_VERBOSE, false);
                @curl_exec($ch);
                curl_close($ch);
                fclose($fp);
            }
        }
        /*$this->entityManager->flush();*/


        return Command::SUCCESS;
    }

}

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
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
#[AsCommand(name: 'app:strain:pictures', description: 'upload strain image', hidden: false)]
class strainPicturesUpdateCommand extends Command
{
    public function __construct(private readonly HttpClientInterface $httpClient, private readonly EntityManagerInterface $entityManager, private readonly StrainRepository $strainRepository, private readonly KernelInterface $kernel)
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
        $folderDest = $this->kernel->getProjectDir();
        foreach($this->strainRepository->findAll() as $strain){
            $urlPhoto = $strain->getUrlPhoto();

            if($urlPhoto){
                $output->writeln('Breeder: ' . $urlPhoto);
                $tmpfile = explode('.', $strain->getUrlPhoto());
                $destfile = $folderDest . '/public/upload/images/strain/' . $strain->getId() . '.' . end($tmpfile);
                $destname = 'upload/images/strain/' . $strain->getId() . '.' . end($tmpfile);
                $ch = curl_init($strain->getUrlPhoto());
                curl_exec($ch);
                $fp = fopen($destfile, 'wb');
                curl_setopt($ch, CURLOPT_FILE, $fp);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_exec($ch);
                curl_close($ch);
                fclose($fp);
                $strain->setLogo($destname);
                $this->entityManager->persist($strain);
                if(($strain->getId() % 100) == 0){
                    $this->entityManager->flush();
                }
            }
        }
        $this->entityManager->flush();
        return Command::SUCCESS;
    }
}

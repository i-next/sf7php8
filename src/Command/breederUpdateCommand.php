<?php

namespace App\Command;

use App\Repository\BreederRepository;
use Doctrine\DBAL\Logging\Middleware;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\NullLogger;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:breeder:update', description: 'update breeder quantity', hidden: false)]
class breederUpdateCommand extends Command
{
    public function __construct(private readonly EntityManagerInterface $entityManager, private readonly BreederRepository $breederRepository)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->entityManager->getConnection()->getConfiguration()->setMiddlewares([new Middleware(new NullLogger())]);
        $breeders = $this->breederRepository->findAll();
        foreach($breeders as $breeder) {
            $output->writeln('Breeder: '.$breeder->getName());
            $breeder->setQuantity(count($breeder->getStrains()));
            $this->entityManager->flush();
            $breeder = null;
            gc_collect_cycles();
        }
        return Command::SUCCESS;
    }

}

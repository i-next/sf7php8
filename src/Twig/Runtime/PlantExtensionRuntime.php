<?php

namespace App\Twig\Runtime;

use App\Entity\Blooms;
use App\Entity\Germination;
use App\Entity\Growths;
use App\Entity\MyPlants;
use App\Entity\Preblooms;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Extension\RuntimeExtensionInterface;
use Symfony\Bundle\SecurityBundle\Security;
use App\Entity\Plant;
use App\Repository\PlantRepository;
Use DateTime;

class PlantExtensionRuntime implements RuntimeExtensionInterface
{
    public function __construct(private readonly PlantRepository $plantRepository, private readonly Security $security, private readonly EntityManagerInterface $entityManager)
    {
        // Inject dependencies if needed
    }

    public function remainDuration(Plant $plant): string
    {
        $now = new \DateTimeImmutable();
        $diff = $now->diff($plant->getDateUpdated());
        $nbWeekPassed = ceil($diff->days / 7);
        $className = 'step4';
        if($nbWeekPassed < 2) {
            $className = 'step1';
        } elseif ($nbWeekPassed < 4) {
            $className = 'step2';
        } elseif ($nbWeekPassed < 6) {
            $className = 'step3';
        }
        return '<i class="bi bi-'.(int) $nbWeekPassed.'-circle-fill '.$className.'"></i>';
    }

    public function countPlant(string $state): bool
    {
        if(class_exists("App\\Entity\\" .$state)) {
            $user = $this->security->getUser();
            $repo = $this->entityManager->getRepository("App\\Entity\\" . $state);
            $count = $repo->countPlantsByState($user->getId());
            return (bool)$count;
        }
        return false;
    }

    public function stepPlant(Plant $plant): string
    {
        $nbDays = $this->getDaysRemained($plant);
        if($nbDays < 8) {
            return 'step4';
        }
        $delta = $nbDays / ($plant->getSeedid()->getDuration() * 7);
        if($delta > 0.75) {
            return 'step1';
        } elseif($delta > 0.5) {
            return 'step2';
        } elseif($delta > 0.25) {
            return 'step3';
        } else {
            return 'step4';
        }
    }

    public function getDaysRemained(Plant $plant): int
    {
        if(!$plant->getDateFlo()) {
            return 0;
        }
        $now = new \DateTimeImmutable();
        $nbDays = $plant->getDateFlo()->diff($now)->days;
        return (int) $nbDays;
    }

    public function formatDescription(string $description): string
    {
        return html_entity_decode($description);
    }

    public function getName(MyPlants $myPlant): string
    {
        $strainName = $myPlant->getMySeeds()->getStrain()->getName();
        if(str_contains($strainName,$myPlant->getName())){
            return $myPlant->getName();
        }else{
            return $myPlant->getName()." (".$strainName.")";
        }
    }

    public function getDaysDuration(Germination $germination): int
    {
        $dateStarted = $germination->getDateActive();
        if($germination->isFinished()){
            $dateEnd = $germination->getMyPlants()->getGrowths()->getDateActive();
        }else{
            $dateEnd =new \DateTimeImmutable();
        }
        return $dateEnd->diff($dateStarted)->days;
    }

    public function getWeeksDurationGrowth(Growths $growths): int
    {
        $dateStarted = $growths->getDateActive();
        if($growths->isFinished()){
            $dateEnd = $growths->getMyPlants()->getPreblooms()->getDateActive();
        }else{
            $dateEnd =new \DateTimeImmutable();
        }
        $interval = $dateEnd->diff($dateStarted);
        return floor($interval->days/7);
    }
    public function getWeeksDurationPrebloom(Preblooms $preblooms): int
    {
        $dateStarted = $preblooms->getDateActive();
        if($preblooms->isFinished()){
            $dateEnd = $preblooms->getMyPlants()->getBlooms()->getDateActive();
        }else{
            $dateEnd =new \DateTimeImmutable();
        }
        $interval = $dateEnd->diff($dateStarted);
        return $interval->days;
    }

    public function getWeeksDurationBloom(Blooms $blooms): int
    {
        $dateStarted = $blooms->getDateActive();
        if($blooms->isFinished()){
            $dateEnd = $blooms->getMyPlants()->getHarvests()->getDateActive();
        }else{
            $dateEnd =new \DateTimeImmutable();
        }
        $interval = $dateEnd->diff($dateStarted);
        return floor($interval->days/7);
    }

}

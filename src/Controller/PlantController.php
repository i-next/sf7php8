<?php

namespace App\Controller;

use App\Entity\EnumStates;
use App\Entity\Plant;
use App\Form\PlantType;
use App\Repository\PlantRepository;
use App\Repository\SeedRepository;
use DateInterval;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\EnumRequirement;

#[Route('/plant')]
class PlantController extends AbstractController
{
    public const STATES = ['GERM' => 'Croissance', 'CROIS' => 'Prefloraison', 'PREFLO' => 'Floraison', 'FLO' => 'Recolte'];


    #[Route('/', name: 'app_plant_index', methods: ['GET'])]
    public function index(PlantRepository $plantRepository): Response
    {
        return $this->render('plant/index.html.twig', [
            'plants' => $plantRepository->findby(['userid' => $this->getUser()]),
            'nav' => 'plant',
            'states' => EnumStates::toArray()
        ]);
    }

    #[Route('/list/{slug}', name: 'app_plant_list', requirements: ['slug' => new EnumRequirement(EnumStates::class)], methods: ['GET'])]
    public function list(PlantRepository $plantRepository, EnumStates $slug): Response
    {

        return $this->render('plant/index.html.twig', [
            'plants' => $plantRepository->findby(['userid' => $this->getUser(), 'state' => $slug]),
            'nav' => 'plant',
            'states' => EnumStates::toArray()
        ]);
    }

    /**
     * @throws Exception
     */
    #[Route('/change/{id}/{state}', name: 'app_plant_change', methods: ['GET'])]
    public function change(int $id, EnumStates $state, PlantRepository $plantRepository, EntityManagerInterface $entityManager): Response
    {

        $plant = $plantRepository->find($id);

        if ($plant instanceof Plant) {
            $plant->setState($state);
            $now = new \DateTimeImmutable();
            if($state === EnumStates::FLO){
                $durationDays = $plant->getSeedid()->getDuration()*7;
                $dateFlo = $now->add(new DateInterval('P'.$durationDays.'D'));
                $plant->setDateFlo($dateFlo);
            }
            $entityManager->persist($plant);
            $entityManager->flush();

            if( $state === EnumStates::REC){
                return $this->redirectToRoute('app_recolte_add', ['slug' => $plant], Response::HTTP_SEE_OTHER);
            }
        }

        return $this->redirectToRoute('app_plant_list', ['slug' => $state->value], Response::HTTP_SEE_OTHER);
    }


    #[Route('/new', name: 'app_plant_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SeedRepository $seedRepository, PlantRepository $plantRepository): Response
    {
        /*$ids = [19, 12, 1, 23, 20, 31, 24, 18];
        foreach ($ids as $seedId) {
            $plant = new Plant();
            $plant->setUserid($this->getUser());
            $seed = $seedRepository->find($seedId);
            $plant->setSeedid($seed);
            $dateCreated = new \DateTimeImmutable();
            $dateCreated = $dateCreated->setDate(2024, 2, 25);
            //dump($dateCreated);
            $plant->setDateCreated($dateCreated);
            $plant->setState(EnumStates::FLO);
            $durationDays = (int)$plant->getSeedid()->getDuration() * 7;
            //dump(DateInterval::createFromDateString($durationDays.' day'));
            //dd($durationDays,new DateInterval('P'.$durationDays.'D'));
            $plant->setDateFlo($dateCreated->add(DateInterval::createFromDateString($durationDays . ' day')));
            $entityManager->persist($plant);
            $entityManager->flush();
        }*/
        return $this->render('plant/index.html.twig', [
            'plants' => $plantRepository->findby(['userid' => $this->getUser()]),
            'nav' => 'plant',
            'states' => self::STATES
        ]);
    }

    #[Route('/{id}', name: 'app_plant_show', methods: ['GET'])]
    public function show(Plant $plant): Response
    {
        return $this->render('plant/show.html.twig', [
            'plant' => $plant,
            'nav' => 'plant'
        ]);
    }

    #[Route('/{id}/edit', name: 'app_plant_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Plant $plant, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PlantType::class, $plant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_plant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('plant/edit.html.twig', [
            'plant' => $plant,
            'form' => $form,
            'nav' => 'plant'
        ]);
    }

    #[Route('/delete/{id}', name: 'app_plant_delete', methods: ['GET'])]
    public function delete(Request $request, Plant $plant, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($plant);
        $entityManager->flush();

        return $this->redirectToRoute('app_plant_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/count/{state}', name: 'app_plant_count', methods: ['GET'])]
    public function countPlants(string $state, PlantRepository $plantRepository): Response
    {
        return new Response($plantRepository->countPlantsByState($state, $this->getUser()->getId()));
    }
}

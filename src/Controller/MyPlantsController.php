<?php

namespace App\Controller;

use App\Entity\EnumStates;
use App\Entity\Germination;
use App\Entity\MyPlants;
use App\Entity\Growths;
use App\Entity\Preblooms;
use App\Entity\Blooms;
use App\Entity\Harvests;
use App\Form\ChangeStateMyPlantsType;
use App\Form\DeletePlantType;
use App\Form\MyPlantsType;
use App\Repository\GerminationRepository;
use App\Repository\MyPlantsRepository;
use App\Repository\MySeedsRepository;
use App\Service\DatatablesServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\DBAL\Exception;

#[Route('/myplants', name: 'app_my_plants_')]
class MyPlantsController extends AbstractController
{
    #[Route('', name: 'index')]
    public function index(): Response
    {
        return $this->render('my_plants/index.html.twig', [
            'controller_name' => 'MyPlantsController',
        ]);
    }

    #[Route('/add', name: 'add')]
    public function add(Request $request, MySeedsRepository $mySeedsRepository, EntityManagerInterface $entityManager): JsonResponse|RedirectResponse
    {

        $myplant = new MyPlants();
        if ($idseed = array_key_exists('my_plants', $request->request->all()) ? $request->request->all()['my_plants']['seedid'] : $request->request->get('id')) {
            try {
                $myseed = $mySeedsRepository->find((int)$idseed);
            } catch (Exception $e) {
                $errorMessage = $e->getMessage();
            }

            $myplant->setMySeeds($myseed);
        }

        $form = $this->createForm(MyPlantsType::class, $myplant, [
            'require_seed_id' => $idseed,
            'action' => $this->generateUrl('app_my_plants_add'),
            'method' => 'POST',
            'data' => $myplant
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $germination = new Germination();
            $germination->setMyPlants($myplant);
            $dategerm = \DateTimeImmutable::createFromFormat('Y-m-d',$request->request->all()['my_plants']['date_germination']);
            $germination->setUserid($this->getUser());

            $germination->setDateActive($dategerm);

            $germination->setFinished(false);
            $myseed->setQuantity($myseed->getQuantity() - 1);
            $entityManager->persist($myplant);

            $entityManager->persist($germination);
            $entityManager->flush();
            return $this->redirectToRoute('app_my_seeds_index', [], Response::HTTP_SEE_OTHER);
        }
        $viewForm = $this->render('my_plants/_form.html.twig', [
            'form' => $form->createView()
        ]);
        return new JsonResponse(['form' => $viewForm->getContent()]);
    }

    #[Route('/count/{state}', name: 'count')]
    public function count(string $state, EntityManagerInterface $entityManager, MyPlantsRepository $myPlantsRepository, Security $security): Response
    {
        $count = 0;
        if (class_exists("App\\Entity\\" . $state)) {
            $repo = $entityManager->getRepository("App\\Entity\\" . $state);
            $count = $repo->countPlantsByState($this->getUser()->getId());
        } else if ($state == 'all') {
            $req = $myPlantsRepository->findBy(['userid' => $security->getUser(), 'finished' => false]);
            $count = count($req);
        }

        return new Response($count);
    }

    #[Route('/{slug}/list', name: 'list')]
    public function myplantsList(string $slug, EntityManagerInterface $entityManager, Security $security): Response
    {
        return $this->render('my_plants/index.html.twig', [
            'entity_name' => $slug,
            'nav' => 'plant'
        ]);
    }

    #[Route('/ajaxmyplants', name: 'ajax')]
    public function ajaxMyPlants(Request $request, EntityManagerInterface $entityManager, Security $security, DatatablesServiceInterface $datatablesService, MyPlantsRepository $myPlantsRepository, GerminationRepository $germinationRepository): JsonResponse
    {
        $entity = $request->request->get('entity');
        $result = [];
        if (class_exists("App\\Entity\\" . $entity)) {
            $repo = $entityManager->getRepository("App\\Entity\\" . $entity);
            $data = $repo->findBy(['userid' => $security->getUser(), 'finished' => false]);

            $result = $datatablesService->formatData($data, $request);
        }

        return new JsonResponse($result);
    }

    #[Route('/ajaxallmyplants', name: 'all_ajax')]
    public function ajaxAllMyPlants(Request $request, MyPlantsRepository $myPlantsRepository): JsonResponse
    {
        $entity = $request->request->get('entity');

        $result = [];
        $result['draw'] = $request->request->get('draw');
        if ($entity === 'all') {
            $myPlants = $myPlantsRepository->getAll();
            $result['recordsFiltered'] = count($myPlants);
            $result['recordsTotal'] = count($myPlants);
            $result['data'] = $myPlants;

        }

        return new JsonResponse($result);
    }

    #[Route('/changestate', name: 'changestate')]
    public function changeState(Request $request, EntityManagerInterface $entityManager, Security $security): JsonResponse|RedirectResponse
    {
        $dataAll = $request->request->all();

        $state = $request->request->get('state') ?: $dataAll['change_state_my_plants']['state'];
        $keyCurrentStep = array_search($state, $arraySteps = EnumStates::toArray());
        $idMyPlant = $request->request->get('id') ?: $dataAll['change_state_my_plants']['idmyplants'];
        if($state !== "all"){
            $repo = $entityManager->getRepository(("App\\Entity\\" . $state));
            $dataInfo = $repo->find($idMyPlant);
            $myPlant = $dataInfo->getMyPlants();
        }else{
            $myPlant = $entityManager->getRepository(("App\\Entity\\MyPlants"))->findOneBy(['id' => (int) $idMyPlant, 'userid' => $security->getUser()]);
            if($myPlant instanceof MyPlants) {
                $keyCurrentStep = 'GERM';
                $dataInfo = $myPlant->getGermination();
                if($myPlant->getGrowths()){
                    $keyCurrentStep = 'CROIS';
                    $dataInfo = $myPlant->getGrowths();
                }
                if($myPlant->getPreblooms()){
                    $keyCurrentStep = 'PREFLO';
                    $dataInfo = $myPlant->getPreblooms();
                }
                if($myPlant->getBlooms()){
                    $keyCurrentStep = 'FLO';
                    $dataInfo = $myPlant->getBlooms();
                }
            }
        }

        $plantName = $myPlant->getName() ?: $myPlant->getMySeeds()->getStrain()->getName();
        while (key($arraySteps) !== $keyCurrentStep) next($arraySteps);
        $nextStep = next($arraySteps);
        $urlAction = $this->generateUrl('app_my_plants_changestate');

        $data = [
            'data' => [
                'newstate' => $nextStep,
                'idmyplant' => $idMyPlant,
                'state' => $state,
            ],
            'action' => $urlAction,
        ];

        $form = $this->createForm(ChangeStateMyPlantsType::class, null, $data);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $dataInfo->setFinished(true);
            $className = "\\App\\Entity\\" . $dataAll['change_state_my_plants']['newstate'];
            $new = new $className;
            $new->setDateActive(new \DateTimeImmutable($dataAll['change_state_my_plants']['date_active']));
            $new->setMyPlants($myPlant);
            $new->setFinished(false);
            if($new instanceof Harvests){
                $new->setWeight($dataAll['change_state_my_plants']['weight']);
                $new->setNotes($dataAll['change_state_my_plants']['notes']);
                $myPlant->setFinished(true);
            }
            $entityManager->persist($dataInfo);
            $entityManager->persist($new);
            $entityManager->persist($myPlant);
            $entityManager->flush();
            return $this->redirectToRoute('app_my_plants_list', ['slug' => $state]);
        }

        $view = $this->render('my_plants/_formchangestate.html.twig', [
            'form' => $form->createView(),
            'nextstep' => current($arraySteps),
            'plantname' => $plantName
        ]);
        return new JsonResponse([
            'form' => $view->getContent(),

        ]);
    }

    #[Route('/delete', name: 'delete')]
    public function delete(Request $request, EntityManagerInterface $entityManager): JsonResponse|RedirectResponse
    {
        $dataAll = $request->request->all();
        if(array_key_exists('delete_plant',$dataAll)){
            $idMyPlant = $dataAll['delete_plant']['idmyplants'];
            $state = $dataAll['delete_plant']['state'];
        }else{
            $idMyPlant = $dataAll['idmyplants'];
            $state = $dataAll['state'];
        }
        $data = [
            'data' => [
                'idmyplant' => $idMyPlant,
                'state' => $state,
            ],
            'action' => $this->generateUrl('app_my_plants_delete'),
        ];
        $repo = $entityManager->getRepository("\\App\\Entity\\".$state);
        $plant = $repo->find($idMyPlant);
        $myPlant = $plant->getMyPlants();
        $plantName= $myPlant->getName()?:$myPlant->getMySeeds()->getStrain()-getName();

        $form = $this->createForm(DeletePlantType::class,null,$data);
        $form->handleRequest($request);

        if($form->isSubmitted() && array_key_exists('delete_plant',$dataAll)){
            $plant->setFinished(true);
            $myPlant->setFinished(true);
            $entityManager->persist($plant);
            $entityManager->persist($myPlant);
            $entityManager->flush();
            return $this->redirectToRoute('app_my_plants_list',['slug' => $state]);
        }
        $view = $this->render('my_plants/_formdelete.html.twig', [
            'form' => $form->createView(),
            'plant_name' => $plantName,
        ]);

        //dd($view->getContent());
        return new JsonResponse([
            'form' => $view->getContent()]);
    }


    #[Route('/info', name: 'info')]
    public function info(Request $request, MyPlantsRepository $myPlantsRepository): JsonResponse
    {
        $myPlant = $myPlantsRepository->find($request->request->get('idmyplants'));
        $view = $this->render('my_plants/_info.html.twig',[
            'my_plant' => $myPlant
        ]);
        return new JsonResponse( ['data' => $view->getContent()]);
    }
}

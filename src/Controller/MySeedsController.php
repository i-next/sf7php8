<?php

namespace App\Controller;

use App\Entity\MySeeds;
use App\Form\AddMySeedsType;
use App\Form\MySeedsType;
use App\Repository\MySeedsRepository;
use App\Repository\StrainRepository;
use App\Service\DatatablesServiceInterface;
use App\Service\MySeedsServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/myseeds', name: 'app_my_seeds_')]
class MySeedsController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(): Response
    {

        return $this->render('my_seeds/index.html.twig', [
            'nav'       => 'myseeds',
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, MySeedsServiceInterface $mySeedsService): Response
    {
        $mySeed = new MySeeds();
        $form = $this->createForm(MySeedsType::class, $mySeed);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $data = $request->request->all();
            $mySeed = $mySeedsService->create($data['my_seeds'], $mySeed);
            if(!$mySeed) {
                $form->addError(new FormError('Invalid Form'));
            } else {
                $entityManager->persist($mySeed);
                $entityManager->flush();
                return $this->redirectToRoute('app_my_seeds_index', [], Response::HTTP_SEE_OTHER);
            }
        }

        return $this->render('my_seeds/new.html.twig', [
            'my_seed' => $mySeed,
            'form' => $form,
            'nav'       => 'myseeds'
        ]);
    }


    #[Route('/add', name: 'add')]
    public function add(Request $request, StrainRepository $strainRepository, EntityManagerInterface $entityManager): JsonResponse|RedirectResponse
    {
        $newSeed = new MySeeds();

        if($strainId = array_key_exists('add_my_seeds',$request->request->all()) ? $request->request->all()['add_my_seeds']['strainId'] : $request->request->get('strainId')) {
            $strain = $strainRepository->find($strainId);
            $newSeed->setStrain($strain);
        } else {
            return new JsonResponse(['error' => 'error']);
        }

        $form = $this->createForm(AddMySeedsType::class, $newSeed, [
            'require_strain_id' => $strainId,
            'action' => $this->generateUrl('app_my_seeds_add'),
            'method' => 'POST',
        ]);


        $form->handleRequest($request);
        if($form->isSubmitted()) {
            $entityManager->persist($newSeed);
            $entityManager->flush();
            return $this->redirectToRoute('app_my_seeds_index', [], Response::HTTP_SEE_OTHER);
        }
        $viewForm = $this->render('my_seeds/_add.html.twig', [
            'form' => $form->createView(),
            'strain' => $strain
        ]);
        return new JsonResponse(['form' => $viewForm->getContent()]);
    }

    #[Route('/ajaxmyseeds', name: 'ajax')]
    public function ajaxMySeeds(Request $request, DatatablesServiceInterface $datatablesService): JsonResponse
    {

        $queryResult = $datatablesService->getData('MySeeds', $request, ['strain']);

        $queryResult['admin'] = false;
        if (in_array('ROLE_ADMIN', $this->getUser()->getRoles(), true)) {
            $queryResult['admin'] = true;
        }

        return new JsonResponse($queryResult);
    }

    #[Route('/show/{id}', name: 'show', methods: ['GET'])]
    public function show(MySeeds $mySeed): Response
    {
        return $this->render('my_seeds/show.html.twig', [
            'my_seed' => $mySeed,
            'nav'       => 'myseeds'
        ]);
    }

    #[Route('/edit/{id}', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MySeeds $mySeed, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MySeedsType::class, $mySeed);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_my_seeds_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('my_seeds/edit.html.twig', [
            'my_seed' => $mySeed,
            'form' => $form,
            'nav'       => 'myseeds'
        ]);
    }

    #[Route('/delete/{id}', name: 'delete', methods: ['GET'])]
    public function delete(Request $request, MySeeds $mySeed, EntityManagerInterface $entityManager): Response
    {
        //if ($this->isCsrfTokenValid('delete'.$mySeed->getId(), $request->request->get('_token'))) {
        $entityManager->remove($mySeed);
        $entityManager->flush();
        //}

        return $this->redirectToRoute('app_my_seeds_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/changeqty', name:'changeqty')]
    public function changeqty(Request $request, MySeedsServiceInterface $mySeedsService): JsonResponse
    {
        $result = $mySeedsService->changeqty($request->request->all());
        return new JsonResponse(['result' => $result]);
    }

    #[Route('/changecomment', name:'changecomment')]
    public function changecomment(Request $request, MySeedsServiceInterface $mySeedsService): JsonResponse
    {
        $result = $mySeedsService->changecomment($request->request->all());
        return new JsonResponse(['result' => $result]);
    }

    #[Route('/info', name: 'info')]
    public function info(Request $request, MySeedsRepository $mySeedsRepository): JsonResponse
    {
        $mySeed= $mySeedsRepository->find($request->request->get('idseed'));
        $view = $this->render('my_seeds/_info.html.twig',[
            'my_seed' => $mySeed,
        ]);
        return new JsonResponse(['data' => $view->getContent()]);
    }

}

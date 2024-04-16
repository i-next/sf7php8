<?php

namespace App\Controller;

use App\Entity\MySeeds;
use App\Form\MySeedsType;
use App\Repository\MySeedsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Omines\DataTablesBundle\Adapter\ArrayAdapter;
use Omines\DataTablesBundle\Column\TextColumn;
use Omines\DataTablesBundle\DataTableFactory;

#[Route('/myseeds')]
class MySeedsController extends AbstractController
{
    #[Route('/', name: 'app_my_seeds_index', methods: ['GET'])]
    public function index(Request $request, MySeedsRepository $mySeedsRepository, DataTableFactory $dataTableFactory): Response
    {
        $table = $dataTableFactory->create()
            ->add('firstName', TextColumn::class)
            ->add('lastName', TextColumn::class)
            ->createAdapter(ArrayAdapter::class, [
                ['firstName' => 'Donald', 'lastName' => 'Trump'],
                ['firstName' => 'Barack', 'lastName' => 'Obama'],
            ])
            ->handleRequest($request);

        if ($table->isCallback()) {
            return $table->getResponse();
        }
        return $this->render('my_seeds/index.html.twig', [
            'my_seeds'  => $mySeedsRepository->findAll(),
            'nav'       => 'myseeds',
            'datatable' => $table
        ]);
    }

    #[Route('/new', name: 'app_my_seeds_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $mySeed = new MySeeds();
        $form = $this->createForm(MySeedsType::class, $mySeed);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($mySeed);
            $entityManager->flush();

            return $this->redirectToRoute('app_my_seeds_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('my_seeds/new.html.twig', [
            'my_seed' => $mySeed,
            'form' => $form,
            'nav'       => 'myseeds'
        ]);
    }

    #[Route('/{id}', name: 'app_my_seeds_show', methods: ['GET'])]
    public function show(MySeeds $mySeed): Response
    {
        return $this->render('my_seeds/show.html.twig', [
            'my_seed' => $mySeed,
            'nav'       => 'myseeds'
        ]);
    }

    #[Route('/{id}/edit', name: 'app_my_seeds_edit', methods: ['GET', 'POST'])]
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

    #[Route('/{id}', name: 'app_my_seeds_delete', methods: ['POST'])]
    public function delete(Request $request, MySeeds $mySeed, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mySeed->getId(), $request->request->get('_token'))) {
            $entityManager->remove($mySeed);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_my_seeds_index', [], Response::HTTP_SEE_OTHER);
    }
}

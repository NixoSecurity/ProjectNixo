<?php

namespace App\Controller;

use App\Repository\ClientRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    #[Route('/client/professionnel', name: 'app_client_prof')]
    public function index(ClientRepository $clientRepository, ProjectRepository $projectRepository): Response
    {
        $client = $clientRepository->findBy(['name' => 'professionnel']);
        $profProjects = $projectRepository->findBy(['client' => $client]);


        return $this->render('client/prof.html.twig', [
            'profProjects' => $profProjects,
         ]);
    }

    #[Route('/client/particulier', name: 'app_client_partic')]
    public function showPartic(ClientRepository $clientRepository, CategoryRepository $categoryRepository): Response
    {
        $client = $clientRepository->findBy(['name' => 'particulier']);
        // $profProjects = $projectRepository->findBy(['client' => $client]);
        $particCategories = $categoryRepository->findBy(['category' => $category]);


        return $this->render('client/partic.html.twig', [
            'particCategories' => $particCategories,
         ]);
    }
}

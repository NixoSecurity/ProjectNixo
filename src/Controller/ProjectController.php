<?php

namespace App\Controller;

use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    // #[Route('/project', name: 'app_project')]
    public function index(ProjectRepository $projectRepository): Response
    {        
        $projects = $projectRepository->findAll();
        // insert new column in DB, in case project is special , it will appear in intro page (only 5 projects)
        // $introProjects = $projectRepository->findBy(['special' => true]);

        return $this->render('project/index.html.twig', [
            'projects' => $projects,
        ]);
    }    
}



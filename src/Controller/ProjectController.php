<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Project;
use App\Repository\ClientRepository;
use App\Repository\ProjectRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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



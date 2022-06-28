<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProjectRepository;

class ProjectController extends AbstractController
{
    #[Route('/project', name: 'app_project')]
    public function index(ProjectRepository $projectRepository): Response
    {
        $projects = $projectRepository->findAll();
        return $this->render('project/project.html.twig', [
            'projects' => $projects,
        ]);
    }
}

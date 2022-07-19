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
    #[Route('/admin/project/{filter}', name: 'app_project')]
    public function index(ProjectRepository $projectRepository,ClientRepository $clientRepository,string $filter = null,PaginatorInterface $paginatorInterface , Request $request): Response
    {
    //    dd($filter);
        if($filter){
        
           
            $client = $clientRepository->findby(['name' =>$filter]);
            $projectAll = $projectRepository->findby(['client'=>$client]);
            dd($projectAll);

        }else {
             $projectAll = $projectRepository->findAll();
        }

       $projects = $paginatorInterface->paginate(
            $projectAll,
            $request->query->getInt('page',1),5
            
        );


        return $this->render('project/index.html.twig', [
            'projects' => $projects,
        ]);
    }
    
}



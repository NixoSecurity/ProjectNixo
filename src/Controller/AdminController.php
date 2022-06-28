<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Project;
use App\Repository\CategoryRepository;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ProjectFormType;
use App\Form\CategoryFormType;
use Knp\Component\Pager\PaginatorInterface;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

/**
 * CRUD Category
 */
    #[Route('/admin/category/new', name: 'app_admin_newCat')]
    public function addCat(Request $request,CategoryRepository $categoryRepository): Response
    {
        $cat = new Category;
        $form = $this->createForm(CategoryFormType::class, $cat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $categoryRepository->add($cat, true);

            $this->addFlash('success', 'Votre categorie à bien été enregistré !');

          
           
            return $this->redirectToRoute('app_home');
            
        }

        return $this->render('category/newCategory.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * CRUD Project
     */
    #[Route('/admin/projects', name: 'app_admin_projects')]
    public function projectsAll(ProjectRepository $projectRepository,PaginatorInterface $paginatorInterface,Request $request): Response
    {
        $projects = $paginatorInterface->paginate(
            $projectRepository->findAll(),
            $request->query->getInt('page',1),5
        );
       

        return $this->render('admin/projects.html.twig', [
            'projects' => $projects,
        ]);
    }

    #[Route('/admin/project/new', name: 'app_admin_newProject')]
    public function addProject(Request $request,ProjectRepository $projectRepository): Response
    {
        $project = new Project;
        $form = $this->createForm(ProjectFormType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $projectRepository->add($project, true);

            $this->addFlash('success', 'Votre projet à bien été enregistré !');

          
           
            return $this->redirectToRoute('app_home');
            
        }

        return $this->render('project/newProject.html.twig', [
            'form' => $form->createView()
        ]);
    }
    #[Route('/admin/project/edit/{id}', name: 'app_editProject', requirements: ['id' => '\d+'])]
    public function update(Project $project, Request $request, ProjectRepository $projectRepository): Response
    {

        $form = $this->createForm(ProjectFormType::class, $project);
        $form->handleRequest($request);
       
       
        if ($form->isSubmitted() && $form->isValid()) {
          
            $projectRepository->add($project, true);

            $this->addFlash('success', 'Le project :' . $project->getname() . 'mis a jour !');
            
            return $this->redirectToRoute('app_account');
        }

        return $this->render('project/newProject.html.twig', [
            'form' => $form->createView(),

        ]);
    }
}

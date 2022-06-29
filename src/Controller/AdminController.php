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
use Symfony\Component\HttpFoundation\RedirectResponse;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(ProjectRepository $projectRepository,CategoryRepository $categoryRepository,PaginatorInterface $paginatorInterface,Request $request): Response
    {
        $projects = $paginatorInterface->paginate(
            $projectRepository->findAll(),
            $request->query->getInt('page',1),5
        );
        $cats = $paginatorInterface->paginate(
            $categoryRepository->findAll(),
            $request->query->getInt('page',1),5
        );
       

        return $this->render('admin/index.html.twig', [
            'projects' => $projects,
            'cats' => $cats,
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

          
           
            return $this->redirectToRoute('app_admin');
            
        }

        return $this->render('category/newCategory.html.twig', [
            'form' => $form->createView()
        ]);

        
    }

    #[Route('/admin/cat/edit/{id}', name: 'app_admin_editCat', requirements: ['id' => '\d+'])]
    public function updateCat(Category $category, Request $request, CategoryRepository $categoryRepository): Response
    {

        $form = $this->createForm(CategoryFormType::class, $category);
        $form->handleRequest($request);
       
       
        if ($form->isSubmitted() && $form->isValid()) {
          
            $categoryRepository->add($category, true);

            $this->addFlash('success', 'Le category :' . $category->getname() . 'mis a jour !');
            
            return $this->redirectToRoute('app_admin');
        }

        return $this->render('category/newcategory.html.twig', [
            'form' => $form->createView(),

        ]);
    }
    #[Route('/admin/category/delete/{id}', name: 'app_admin_deleteCat', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function deleteCat(Category $category, Request $request, CategoryRepository $categoryRepository): RedirectResponse
    {

        $tokenCsrf = $request->request->get('token');

        if ($this->isCsrfTokenValid('delete-project-' . $category->getId(), $tokenCsrf)) {
            $categoryRepository->remove($category, true);
            $this->addFlash('success', 'La catégorie à bien été supprimée');
            $success = true;
        }

        return $this->redirectToRoute('app_admin', [
            'success' => $success
        ]);
    }




    /**
     * CRUD Project
     */
    #[Route('/admin/project/new', name: 'app_admin_newProject')]
    public function addProject(Request $request,ProjectRepository $projectRepository): Response
    {
        $project = new Project;
        $form = $this->createForm(ProjectFormType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $projectRepository->add($project, true);

            $this->addFlash('success', 'Votre projet à bien été enregistré !');

          
           
            return $this->redirectToRoute('app_admin');
            
        }

        return $this->render('project/newProject.html.twig', [
            'form' => $form->createView()
        ]);
    }
    #[Route('/admin/project/edit/{id}', name: 'app_admin_editProject', requirements: ['id' => '\d+'])]
    public function updateProject(Project $project, Request $request, ProjectRepository $projectRepository): Response
    {

        $form = $this->createForm(ProjectFormType::class, $project);
        $form->handleRequest($request);
       
       
        if ($form->isSubmitted() && $form->isValid()) {
          
            $projectRepository->add($project, true);

            $this->addFlash('success', 'Le project :' . $project->gettitle() . 'mis a jour !');
            
            return $this->redirectToRoute('app_admin');
        }

        return $this->render('project/newProject.html.twig', [
            'form' => $form->createView(),

        ]);
    }

    #[Route('/admin/project/delete/{id}', name: 'app_admin_deleteProject', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function deleteProject(Project $project, Request $request, ProjectRepository $projectRepository): Response
    {

        $tokenCsrf = $request->request->get('token');

        if ($this->isCsrfTokenValid('delete-project-'. $project->getId(), $tokenCsrf)) {
        
           $projectRepository->remove($project,true);
            $this->addFlash('success', 'Le projet à bien été supprimée');
            $success = true;
        }

        return $this->redirectToRoute('app_admin', [
            'success' => $success
        ]);
    }
}

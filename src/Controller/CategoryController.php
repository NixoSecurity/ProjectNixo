<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryFormType;
use App\Repository\CategoryRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/admin/category', name: 'app_category')]
    public function index(CategoryRepository $categoryRepository,PaginatorInterface $paginatorInterface,REquest $request): Response
    {
        $cats = $paginatorInterface->paginate(
            $categoryRepository->findAll(),
            $request->query->getInt('page',1),5
        );
        return $this->render('admin/CategoriesAll.html.twig', [
            'categories' => $cats,
        ]);
    }


    
}

<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserFormType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    // public function index(UserRepository $userRepository,Request $request): Response
    // {
    //     $user = new User;
    //     $form = $this->createForm(UserFormType::class, $user);
    //     $form->handleRequest($request);


    //     if ($form->isSubmitted() && $form->isValid()) {
            
    //         $userRepository->add($user, true);

    //         $this->addFlash('success', 'Votre utilisateur à bien été enregistré !');

          
           
    //         return $this->redirectToRoute('app_admin');
            
    //     }
    //     return $this->render('login/index.html.twig', [
    //         'form' => $form->createView()
    //     ]);
    // }
       public function index(AuthenticationUtils $authenticationUtils): Response
      {
         // get the login error if there is one
         $error = $authenticationUtils->getLastAuthenticationError();

         // last username entered by the user
         $lastUsername = $authenticationUtils->getLastUsername();

          return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
             'last_username' => $lastUsername,
             'error'         => $error,
          ]);
      }
}
 
<?php

namespace App\Controller;

use App\Repository\ClientRepository;
use App\Repository\CategoryRepository;
use App\Repository\ProjectRepository;
use App\Form\ContactFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\EmailService;
use Symfony\Component\HttpFoundation\Request;

class ClientController extends AbstractController
{
    #[Route('/client/professionnel', name: 'app_client_prof')]
    #[Route('/client/professionnel#contact', name: 'app_client_prof_contact')]
    public function index(ClientRepository $clientRepository, ProjectRepository $projectRepository, Request $request, EmailService $mail): Response
    {
        $client = $clientRepository->findBy(['name' => 'professionnel']);
        $profProjects = $projectRepository->findBy(['client' => $client]);
      
        $form = $this->createForm(ContactFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            
        $contactFormData = $form->getData();
        $date = date("F j, Y, g:i a");
        $context = '<p style = "color: black; font-family: sans-serif;"><span style="color: grey"> E-mail de l\'expéditeur: </span> ' . $contactFormData['email'].'</p>' .
            '<p style = "color: black; font-family: sans-serif;"><span style="color: grey"> Nom de l\'expéditeur: </span> ' .$contactFormData['firstname'] . ' '. $contactFormData['lastname'].'</p>' .
            '<p style = "color: black; font-family: sans-serif;"><span style="color: grey"> Date: </span> ' . $date .'</p>' .
            '<p style = "color: black; font-family: sans-serif;"><span style="color: grey"> Code Postal: </span> ' . $contactFormData['codePostal'] .'</p>' .
            '<p style = "color: black; font-family: sans-serif;"><span style="color: grey"> Sujet: </span> ' . $contactFormData['subject'] .'</p>' .
            '<p style = "color: black; font-family: sans-serif;"><span style="color: grey"> Message: </span> </p>' .                              
            '<p style = "color: black; font-family: sans-serif;">' . $contactFormData['message'] .'</p>' ;

        $mail->send(
            $contactFormData['email'],
            'nchevassu@nixo-dvt.fr',
            'Nouveau message de ' . $contactFormData['firstname'] . ' ' . $contactFormData['lastname'],
            $context               
        );

            $this->addFlash('success', 'Votre message a été envoyé');
            return $this->redirectToRoute('app_client_prof_contact');
          }

        return $this->render('client/prof.html.twig', [
            'profProjects' => $profProjects,
            'form' => $form->createView()
         ]);
    }

    #[Route('/client/particulier', name: 'app_client_partic')]
    public function showPartic(ClientRepository $clientRepository, CategoryRepository $categoryRepository): Response
    {
        return $this->render('client/partic.html.twig' );
    }
}

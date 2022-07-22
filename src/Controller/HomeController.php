<?php

namespace App\Controller;

use App\Repository\ProjectRepository;
use App\Form\ContactFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\EmailService;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ProjectRepository $projectRepository, Request $request, EmailService $mail): Response
    {

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
            return $this->redirectToRoute('app_home');
        }      

        return $this->render('home/index.html.twig',[
            'projects' => $projectRepository->findAll(),
            'form' => $form->createView()

        ]);
    }
}

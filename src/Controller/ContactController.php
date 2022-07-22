<?php

namespace App\Controller;

use App\Form\ContactFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Email;

class ContactController extends AbstractController
{
    // #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactFormType::class);
          $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $contactFormData = $form->getData();

            $date = date("F j, Y, g:i a");

            $message = (new Email())
                ->from($contactFormData['email'])
                ->to('nchevassu@nixo-dvt.fr')
                ->subject('Nouveau message de ' . $contactFormData['firstname'] . ' ' . $contactFormData['lastname'])
                ->html( '<p style = "color: black; font-family: sans-serif;"><span style="color: grey"> E-mail de l\'expéditeur: </span> ' . $contactFormData['email'].'</p>' .
                        '<p style = "color: black; font-family: sans-serif;"><span style="color: grey"> Nom de l\'expéditeur: </span> ' .$contactFormData['firstname'] . ' '. $contactFormData['lastname'].'</p>' .
                        '<p style = "color: black; font-family: sans-serif;"><span style="color: grey"> Date: </span> ' . $date .'</p>' .
                        '<p style = "color: black; font-family: sans-serif;"><span style="color: grey"> Code Postal: </span> ' . $contactFormData['codePostal'] .'</p>' .
                        '<p style = "color: black; font-family: sans-serif;"><span style="color: grey"> Sujet: </span> ' . $contactFormData['subject'] .'</p>' .
                        '<p style = "color: black; font-family: sans-serif;"><span style="color: grey"> Message: </span> </p>' .                              
                        '<p style = "color: black; font-family: sans-serif;">' . $contactFormData['message'] .'</p>' ,
                         'utf-8' 
                        );

            $mailer->send($message);

            $this->addFlash('success', 'Votre message a été envoyé');
            return $this->redirectToRoute('app_contact');
        }

        //     return $this->render('component/_contactForm.html.twig', [
        //         'form' => $form->createView()
        // ]);
    }
}

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
    #[Route('/contact', name: 'app_contact')]
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
                ->html( '<p style="color: gery">E-mail de l\'expéditeur: </p> '.  '<p style="color: blue">' . $contactFormData['email'].'</p>' .
                        '<p style="color: gery">Nom de l\'expéditeur:</p> ' . '<p style="color: blue">' .$contactFormData['firstname'] . ' '. $contactFormData['lastname'].'</p>' .
                        '<p style="color: gery">Date: </p>' . '<p style="color: blue">' . $date .'</p>' .
                        '<p style="color: gery">Message: </p>' .
                        '<p style="color: blue">' . $contactFormData['message'] .'</p>' , 'utf-8' 
                        );

            $mailer->send($message);

            $this->addFlash('success', 'Your message has been  sent');
            return $this->redirectToRoute('app_contact');
        }

            return $this->render('contact/contact.html.twig', [
                'form' => $form->createView()
        ]);
    }
}

<?php
namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class EmailService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function send(string $from, string $to, string $subject, string $context): void 
    {
        $message = (new Email())
            ->from($from)
            ->to($to)
            ->subject($subject)
            ->html( $context, 'utf-8' );

        $this->mailer->send($message);
    }       
}
<?php

namespace App\Controller;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class TestMailerController extends AbstractController
{
    #[Route('/test/mailer', name: 'app_test_mailer')]
    public function sendTestEmail(MailerInterface $mailer): Response
    {
        try {

            $email = (new Email())
            ->from('inscription@ceobusinessforum.io')
            ->to('donnellrajemson@gmail.com')
            ->subject('Test Email')
            ->text('This is a test email sent from Symfony.')
            ->html('<p>See Twig integration for better HTML integration!</p>');

            $mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            dd($e);
        }
        return new Response('Test email sent!');
    }
}

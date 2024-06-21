<?php

namespace App\Controller;

use App\Dto\EmailDto;
use App\Service\Formatter;
use Symfony\Component\Mime\Email;
use App\Entity\NewsLetterSubscriber;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class NewsLetterController extends AbstractController
{
    public function __construct(private EntityManagerInterface $em, private ValidatorInterface $validator, private Formatter $formatter)
    {
    }

    #[Route('/news-letter', name: 'news_letter')]
    public function index(Request $request): Response
    {
        extract($request->request->all());
        $subscriber = new NewsLetterSubscriber();
        $subscriber->setNewsLetterEmail($newLetterEmail ?? null);
        $errors = $this->validator->validate($subscriber);
        if (count($errors) > 0) {
            $errors = $this->formatter->formatErrors($errors);
            foreach ($errors as $error => $message) {
                $this->addFlash('globalErrors', $message);
            }
        } else {
            $this->em->persist($subscriber);
            $this->em->flush();
            $this->addFlash('globalSuccess', "Félicitation vous êtes maintenant inscrit à notre News Letter");
        }
        return $this->redirectToRoute('home');
    }
    #[Route('/email', name: 'email', methods: ['POST'])]
    public function sendEmail(Request $request, SerializerInterface $serializer, MailerInterface $mailer,Formatter $formatter): Response
    {
        extract($request->request->all());
        $dto = new EmailDto();
        $dto->msg_email = $msg_email ?? null;
        $dto->object = $object ?? null;
        $dto->message = $message ?? null;
        $errors = $this->validator->validate($dto);

        if (count($errors) <= 0) {
            try {

                $email = (new Email())
                ->from($dto->msg_email)
                ->to('register@ceobusinessforum.io')
                ->subject($dto->object)
                ->text('Nouveau message.')
                ->html("<p>$dto->message</p>");
    
                $mailer->send($email);
            } catch (TransportExceptionInterface $e) {
                dd($e);
            }
            $this->addFlash('globalSuccess', "Votre message a bien été reçu,vous allez bientôt recevoir un retour de notre part");
        }
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'errors'=>(isset($errors) && count($errors) > 0)  ? $formatter->formatErrors($errors) : []
        ]);
    }
}

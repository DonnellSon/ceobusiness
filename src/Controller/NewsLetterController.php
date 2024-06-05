<?php

namespace App\Controller;

use App\Entity\NewsLetterSubscriber;
use App\Service\Formatter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class NewsLetterController extends AbstractController
{
    public function __construct(private EntityManagerInterface $em, private ValidatorInterface $validator,private Formatter $formatter) 
    {
    }

    #[Route('/news-letter', name: 'news_letter')]
    public function index(Request $request): Response
    {
        extract($request->request->all());
        $subscriber=new NewsLetterSubscriber();
        $subscriber->setNewsLetterEmail($newLetterEmail ?? null);
        $errors=$this->validator->validate($subscriber);
        if(count($errors) > 0) {
            $errors=$this->formatter->formatErrors($errors);
            foreach($errors as $error => $message) {
                $this->addFlash('globalErrors', $message);
            }
        }else{
            $this->em->persist($subscriber);
            $this->em->flush();
            $this->addFlash('globalSuccess', "Félicitation vous êtes maintenant inscrit à notre News Letter");
        }
        return $this->redirectToRoute('home');
    }
}

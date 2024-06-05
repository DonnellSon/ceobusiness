<?php

namespace App\Controller;

use App\Entity\CompetitionSubscriber;
use App\Service\Formatter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CompetitionController extends AbstractController
{

    public function __construct(private EntityManagerInterface $em, private Formatter $formatter, private ValidatorInterface $validator)
    {
    }

    #[Route('/councours', name: 'competition')]
    public function index(Request $request): Response
    {
        if ($request->getMethod() === 'POST') {
            extract($request->request->all());
            $compSubscriber = new CompetitionSubscriber();
            $compSubscriber->setFirstName($firstName ?? null)
                ->setLastName($lastName ?? null)
                ->setInstitution($institution ?? null)
                ->setEmail($email ?? null)
                ->setNumber($number ?? null);
            $errors = $this->validator->validate($compSubscriber);
            if (count($errors) <= 0) {
                $this->em->persist($compSubscriber);
                $this->em->flush();
                $this->addFlash('globalSuccess', 'Félicitation vous êtes inscrit à la séance d\'information du 15 Juin 2024');
                $this->redirectToRoute('home');
            }
        }

        return $this->render('main/competition.html.twig', [
            'controller_name' => 'CompetitionController',
            'errors' => isset($errors) ? $this->formatter->formatErrors($errors) : [],
            'compSubscriber'=>isset($compSubscriber) ? $compSubscriber : null
        ]);
    }
}

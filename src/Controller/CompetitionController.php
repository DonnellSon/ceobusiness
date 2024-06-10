<?php

namespace App\Controller;

use App\Service\Formatter;
use App\Service\GoogleSheetsService;
use App\Entity\CompetitionSubscriber;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CompetitionController extends AbstractController
{

    public function __construct(private EntityManagerInterface $em, private Formatter $formatter, private ValidatorInterface $validator,private GoogleSheetsService $googleSheetsService)
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
                $list[] = [
                    $compSubscriber->getFirstName(),
                    $compSubscriber->getLastName(),
                    $compSubscriber->getInstitution(),
                    $compSubscriber->getEmail(),
                    $compSubscriber->getNumber(),
                ];

                $spreadsheetId = '1lS3vh-scfY_xZvJGRJfYAiwRDt4_VUrc_xpbCnQQp7U';
                $range = 'Inscription CEO Startuppers Awards 2024';

                $success = $this->googleSheetsService->appendToSpreadsheet($spreadsheetId, $range, $list);

                if (!$success) {
                    throw new \RuntimeException('Erreur lors de l\'insertion des données dans le Google Sheet.');
                }
                $this->googleSheetsService->autoResizeColumns($spreadsheetId);

                return $this->redirectToRoute('home');
            }
        }

        return $this->render('main/competition.html.twig', [
            'controller_name' => 'CompetitionController',
            'errors' => isset($errors) ? $this->formatter->formatErrors($errors) : [],
            'compSubscriber' => isset($compSubscriber) ? $compSubscriber : null
        ]);
    }
}

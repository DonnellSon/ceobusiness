<?php

namespace App\Controller;

use App\Entity\CompetitionSubscriber;
use App\Entity\User;
use App\Service\GoogleSheetsService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RegisterSheetsController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager,private GoogleSheetsService $googleSheetsService)
    {
    }


    #[Route('/register/sheets', name: 'app_register_sheets',methods: ['GET'])]
    public function index(): Response
    {
        $users = $this->entityManager->getRepository(User::class)->findAll();
       
        $confirmed=[
            ['Nom','Prénom','Autre nom','Genre','Ville','Adresse','Pays','Adresse email personnel','Adresse email professionnel',
             'Téléphone personnel','Téléphone professionnel','Contact WhatsApp','Nom de l\'entreprise','Titre dans l\'entreprise',
             'Taille de l\'entreprise','Activité de l\'entreprise','Région de l\'entreprise','Ville de l\'entreprise','Besoin d\'assistance',
             'Réservation d\'hotel','Transfert de l\'aéroport à l\'hotel','Autre détails']
        ];
        foreach( $users as $user ) {
            $persoInfos=$user->getPersoInfos();
            $proInfos=$user->getProInfos();
            $travelInfos=$user->getTravelInfos();
            if($persoInfos && $proInfos && $travelInfos){
                $confirmed[]=[
                    $persoInfos->getFirstName(),
                    $persoInfos->getLastName(),
                    $persoInfos->getOtherName() ?? 'Aucun',
                    $persoInfos->getGender(),
                    $persoInfos->getCity(),
                    $persoInfos->getAddress(),
                    $persoInfos->getCountry(),
                    $persoInfos->getPersoEmail() ?? 'Aucun',
                    $persoInfos->getProEmail(),
                    $persoInfos->getPersoNumber(),
                    $persoInfos->getProNumber(),
                    $persoInfos->getWhatsApp(),
                    $proInfos->getEntrepriseName(),
                    $proInfos->getEntrepriseTitle(),
                    $proInfos->getEntrepriseSize(),
                    $proInfos->getEntrepriseActivity(),
                    $proInfos->getRegion(),
                    $proInfos->getCity(),
                    $travelInfos->getTravelAssistance(),
                    $travelInfos->getHotelReservation(),
                    $travelInfos->getAirportTransfer(),
                    $travelInfos->getOtherTravelDetails() ?? 'Aucun'
                ];
            }
        }
      
           
        

        $spreadsheetId = '1lS3vh-scfY_xZvJGRJfYAiwRDt4_VUrc_xpbCnQQp7U';
        $range = 'Inscription CEO Business Forum IO'; // Ajustez selon votre structure de feuille de calcul

        // Videz le feuille de calcul
        $this->googleSheetsService->clearSheet($spreadsheetId, $range);

        // Préparez les données à insérer dans le Google Sheet
       
            
       

        // Insérez les données dans le Google Sheet
        $success = $this->googleSheetsService->appendToSpreadsheet($spreadsheetId, $range, $confirmed);

        if (!$success) {
            throw new \RuntimeException('Erreur lors de l\'insertion des données dans le Google Sheet.');
        }
        $this->googleSheetsService->autoResizeColumns($spreadsheetId);
        // Redirigez vers une page de confirmation ou renvoyez une réponse appropriée
       

        return new JsonResponse($confirmed);
    }

    #[Route('/competition/sheets', name: 'app_comp_sheets',methods: ['GET'])]
    public function competition(): Response
    {
        $subscribed = $this->entityManager->getRepository(CompetitionSubscriber::class)->findAll();
       
        $list=[
            ['Nom','Prénom','Institution','Email','Téléphone']
        ];
        foreach( $subscribed as $s ) {
                $list[]=[
                    $s->getFirstName(),
                    $s->getLastName(),
                    $s->getInstitution(),
                    $s->getEmail(),
                    $s->getNumber(),
                ];
        }
      
           
        

        $spreadsheetId = '1lS3vh-scfY_xZvJGRJfYAiwRDt4_VUrc_xpbCnQQp7U';
        $range = 'Inscription CEO Startuppers Awards 2024'; // Ajustez selon votre structure de feuille de calcul

        // Videz le feuille de calcul
        $this->googleSheetsService->clearSheet($spreadsheetId, $range);

        // Préparez les données à insérer dans le Google Sheet
       
            
       

        // Insérez les données dans le Google Sheet
        $success = $this->googleSheetsService->appendToSpreadsheet($spreadsheetId, $range, $list);

        if (!$success) {
            throw new \RuntimeException('Erreur lors de l\'insertion des données dans le Google Sheet.');
        }
        $this->googleSheetsService->autoResizeColumns($spreadsheetId);
        // Redirigez vers une page de confirmation ou renvoyez une réponse appropriée
       

        return new JsonResponse($list);
    }

}

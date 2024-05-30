<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Entity\ProInfos;
use App\Entity\PersoInfos;
use App\Entity\TravelInfos;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\ConstraintViolationListInterface;


class RegistrationController extends AbstractController
{

    public function __construct(private EntityManagerInterface $em,private ValidatorInterface $validator)
    {
    }
    public function formatErrors(ConstraintViolationListInterface $errors): array
    {
        $errorArray = [];
        foreach ($errors as $err){
            $errorArray[$err->getPropertyPath()] = $err->getMessage();
        }
        return $errorArray;
    }

    #[Route('/registration/informations-personnelles', name: 'personal_register')]
    public function index(Request $request): Response
    {
        if($request->getMethod()==="POST"){
            
            extract($request->request->all());
            $uploadedPhoto = $request->files->get('photo');
            $persoInfos=new PersoInfos();
            
            if(isset($uploadedPhoto)){
                $photo=new Photo();
                $photo->setFile($uploadedPhoto);
                $photo->setFileName('name.png');
                $photo->setFileSize(200);
                $persoInfos->setPhoto($photo);
                
                $this->em->persist($photo);
            }
            $persoInfos->setFirstName($firstName)
                ->setLastName($lastName)
                ->setOtherName($otherName)
                ->setGender($gender)
                ->setCity($city)
                ->setAddress($adress)
                ->setPersoEmail($persoMail)
                ->setProEmail($proMail)
                ->setPersoNumber($persoNumber)
                ->setProNumber($proNumber)
                ->setWhatsApp($whatsapp)
                ->setNationality($nationality)
                ->setCivility($civility)
                ->setCountry($country);
            
            $this->em->persist($persoInfos);

            $errors = $this->validator->validate($persoInfos);
               
                if(count($errors) > 0) {
                    
                }else{
                    $this->em->flush();
                    $this->addFlash(
                    'success',
                    'Inscription effectuer'
                    );
                    return $this->redirectToRoute('professional_register');
                }
        }

        
        return $this->render('registration/index.html.twig', [
            'controller_name' => 'RegistrationController',
            'persoInfos'=>isset($persoInfos) ? $persoInfos : null,
            'errors'=> (isset($errors) && count($errors)) > 0 ? $this->formatErrors($errors) : []
        ]);
    }
    #[Route('/registration/informations-professionnelles', name: 'professional_register')]
    public function professional_registration(Request $request): Response
    {

        if($request->getMethod()==="POST"){
            
            extract($request->request->all());
            $proInfos=new ProInfos();
            $proInfos->setEntrepriseName($entrepriseName)
                ->setEntrepriseTitle($entrepriseTitle)
                ->setEntrepriseSize($entrepriseSize)
                ->setEntrepriseActivity($entrepriseActivity)
                ->setRegion($region)
                ->setCity($city);
            
            $this->em->persist($proInfos);

            $errors = $this->validator->validate($proInfos);
               
                if(count($errors) > 0) {
                    
                }else{
                    $this->em->flush();
                    $this->addFlash(
                    'success',
                    'Inscription effectuer'
                    );
                    return $this->redirectToRoute('travel_register');
                }
        }

        return $this->render('registration/professional.html.twig', [
            'controller_name' => 'RegistrationController',
            'proInfos'=>isset($proInfos) ? $proInfos : null,
            'errors'=> (isset($errors) && count($errors)) > 0 ? $this->formatErrors($errors) : []
        ]);
    }
    #[Route('/registration/voyage', name: 'travel_register')]
    public function travel_registration(Request $request): Response
    {
        if($request->getMethod()==="POST"){
            
            extract($request->request->all());
            $travelInfos=new TravelInfos();
            $travelInfos->setTravelAssistance($travelAssistance)
                ->setAirportTransfer($airportTransfer)
                ->setHotelReservation($hotelReservation)
                ->setOtherTravelDetails($otherTravelDetails);
            
            $this->em->persist($travelInfos);

            $errors = $this->validator->validate($travelInfos);
               
                if(count($errors) > 0) {
                    
                }else{
                    $this->em->flush();
                    $this->addFlash(
                    'success',
                    'Inscription effectuer'
                    );
                    return $this->redirectToRoute('final_register');
                }
        }
        return $this->render('registration/voyage.html.twig', [
            'controller_name' => 'RegistrationController',
            'travelInfosInfos'=>isset($travelInfos) ? $travelInfos : null,
        ]);
    }
    #[Route('/registration/finalisation', name: 'final_register')]
    public function final_registration(Request $request): Response
    {
        if($request->getMethod()==="POST"){
            
            extract($request->request->all());
            //$verificationCode
            
            // $this->em->persist($travelInfos);

            // $errors = $this->validator->validate($travelInfos);
               
            //     if(count($errors) > 0) {
                    
            //     }else{
            //         $this->em->flush();
            //         $this->addFlash(
            //         'success',
            //         'Inscription effectuer'
            //         );
            //         return $this->redirectToRoute('final_register');
            //     }
        }
        return $this->render('registration/final.html.twig', [
            'controller_name' => 'RegistrationController',
        ]);
    }
}

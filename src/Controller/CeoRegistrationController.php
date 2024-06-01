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
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;


class CeoRegistrationController extends AbstractController
{

    public function __construct(private EntityManagerInterface $em,private ValidatorInterface $validator)
    {
    }

    public function generateConfirmationCode(): string
    {
        // Générer un UUID v4 (Universally Unique Identifier)
        $digits = [];
    for ($i = 0; $i < 6; $i++) {
        $digits[] = mt_rand(0, 9);
    }

    // Convertir les nombres en une seule chaîne
    $code = implode('', $digits);

    return $code;
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
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        if($this->getUser()->isConfirmed()){
            $this->redirectToRoute('home');
        }
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
            $persoInfos->
            setFirstName($firstName)
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
                ;
            $this->em->persist($persoInfos);
            $user=$this->getUser();
                $user->setPersoInfos($persoInfos);
            $this->em->persist($user);

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
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        if(!$this->getUser()->getPersoInfos()){
            $this->redirectToRoute('personal_register');
        }
        if($this->getUser()->isConfirmed()){
            $this->redirectToRoute('home');
        }
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
            $user=$this->getUser();
                $user->setProInfos($proInfos);
            $this->em->persist($user);

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
    public function travel_registration(Request $request,MailerInterface $mailer): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        if($this->getUser()->isConfirmed()){
            $this->redirectToRoute('home');
        }
        if(!$this->getUser()->getProInfos()){
            $this->redirectToRoute('professional_register');
        }
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
                    $user=$this->getUser();
                    $confirmationCode=$this->generateConfirmationCode();
                    $user->setConfirmationCode($confirmationCode)
                    ->setTravelInfos($travelInfos);
                    $this->em->persist($user);
                    $this->em->flush();
                    $email = (new Email())
                        ->from('inscription@ceobusinessforum.io')
                        ->to($this->getUser()->getPersoInfos()->getProEmail())
                        ->subject('Confirmation de votre inscription au CEO BUSINESS FORUM IO')
                        ->text('Votre inscription a bien été reçue')
                        ->html("<p>Veillez confimer votre inscription en communiquant votre code de confirmation: $confirmationCode</p>");
                    $mailer->send($email);
                    $this->addFlash(
                    'success',
                    'Inscription effectué'
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
    public function final_registration(Request $request,MailerInterface $mailer): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        if($this->getUser()->isConfirmed()){
            $this->redirectToRoute('home');
        }
        if(!$this->getUser()->getConfirmationCode()){
            $this->redirectToRoute('travel_register');
        }
        if($request->getMethod()==="POST"){
            
            extract($request->request->all());
            if($confirmationCode==$this->getUser()->getConfirmationCode()){
                $user=$this->getUser();
                $user->setConfirmed(true);
                $successEmail = (new TemplatedEmail())
                        ->from('inscription@ceobusinessforum.io')
                        ->to($this->getUser()->getPersoInfos()->getProEmail())
                        ->subject('Inscription au CEO BUSINESS FORUM IO')
                        ->text('Votre demande d\'inscription a été reçu avec succès')
                        ->htmlTemplate('emails/success.html.twig')
                        ->context([
                            'user' => $this->getUser(),
                        ]);
                    $mailer->send($successEmail);
                    $adminEmail = (new TemplatedEmail())
                    ->from('inscription@ceobusinessforum.io')
                    ->to('inscription@ceobusinessforum.io')
                    ->subject('Inscription au CEO BUSINESS FORUM IO')
                    ->htmlTemplate('emails/newuser.html.twig')
                    ->context([
                        'user' => $user,
                        'persoInfos'=>$user->getPersoInfos(),
                        'proInfos'=>$user->getProInfos(),
                        'photoFileName'=>$user->getPersoInfos()->getPhoto()->getFileName(),
                        'travelInfos'=>$user->getTravelInfos()
                    ]);
                    $mailer->send($adminEmail);
                return $this->render('registersuccess.html.twig', [
                    'controller_name' => 'RegistrationController',
                ]);

            }else {
                $errors['confirmationCode']='Votre code est incorrect';
            }
        }
        return $this->render('registration/final.html.twig', [
            'controller_name' => 'RegistrationController',
            'proEmail'=>$this->getUser()->getPersoInfos()->getProEmail(),
            'errors'=>isset($errors) ? $errors : []
        ]);
    }
}

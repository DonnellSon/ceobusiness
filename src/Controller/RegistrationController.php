<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Entity\PersoInfos;
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
                ->setWhatsApp($whatsapp);
            
            $this->em->persist($persoInfos);

            $errors = $this->validator->validate($user);
               
                if (count($errors) < 0) {
                    $this->em->flush();
                    $this->addFlash(
                    'success',
                    'Inscription effectuer');
                }  
        }

        
        return $this->render('registration/index.html.twig', [
            'controller_name' => 'RegistrationController',
            'errors'=> count($errors) > 0 ? $this->formatErrors($errors) : []
        ]);
    }
    #[Route('/registration/informations-professionnelles', name: 'professional_register')]
    public function professional_registration(): Response
    {
        return $this->render('registration/professional.html.twig', [
            'controller_name' => 'RegistrationController',
        ]);
    }
}

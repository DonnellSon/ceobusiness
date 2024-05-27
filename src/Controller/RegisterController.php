<?php

namespace App\Controller;

use App\Entity\UserRegister;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class RegisterController extends AbstractController
{
    

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager,private ValidatorInterface $validator)
    {
        $this->entityManager = $entityManager;
    }
    
    public function formatErrors(ConstraintViolationListInterface $errors): array
    {
        $errorArray = [];
        foreach ($errors as $err){
            $errorArray[$err->getPropertyPath()] = $err->getMessage();
        }
        return $errorArray;
    }

    #[Route('/inscription', name: 'register')]  
    public function register(Request $request): Response
    {
      
        
            if($request->getMethod()==='POST'){
                
                $formData = $request->request->all();
        
                $user = new UserRegister();
                
                $user->setFirstName($formData['firstName']) 
                ->setLastName($formData['lastName'])
                ->setCompanyName($formData['companyName'])
                ->setSecteur($formData['secteur'])
                ->setCompanyAdress($formData['companyAdress'])
                ->setCity($formData['city'])
                ->setCountry($formData['country'])
                ->setZipCode($formData['zipCode'])
                ->setUserAdress($formData['userAdress'])
                ->setEmail($formData['mail'])
                ->setContact($formData['contact'])
                ->setRegisterAs($formData['registerAs']);
               
                $this->entityManager->persist($user);

                $errors = $this->validator->validate($user);
               
                if (count($errors) > 0) {
                    // dd($this->formatErrors($errors));
                    return $this->render('register/index.html.twig', [
                        'errors' => $this->formatErrors($errors),
                    ]);
                }
                else{
                   
                    $this->entityManager->flush();
                    $this->addFlash(
                    'succes',
                    'Inscription effectuer'
                );
                return $this->render('registersucces.html.twig',[]);
                }
                
            }
                return $this->render('register/index.html.twig',[]);
            
            
    }
}

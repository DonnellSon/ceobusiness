<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserRegistrationController extends AbstractController
{
    
    public function __construct(private EntityManagerInterface $em, private ValidatorInterface $validator, private UserPasswordHasherInterface $passwordHasher)
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

    #[Route('/inscription', name: 'user_registration')]
    public function register(Request $request): Response
    {
      
        
            if($request->getMethod()==='POST'){
                
                extract($request->request->all());
        
                $user = new User();
                $user->setEmail($email)
                ->setPassword($password);


                $errors = $this->validator->validate($user);
               
                if (count($errors) <= 0) {
                    $hashedPassword = $this->passwordHasher->hashPassword(
                        $user,
                        $password
                    );
                    $user->setPassword($hashedPassword);
                    $this->em->persist($user);
                    $this->em->flush();
                    return $this->redirectToRoute('personal_register');
                }
                
             }
                return $this->render('user_registration/index.html.twig',[
                    'errors'=>(isset($errors) && count($errors)) > 0 ? $this->formatErrors($errors) : []
                ]);
            
    }
    
}

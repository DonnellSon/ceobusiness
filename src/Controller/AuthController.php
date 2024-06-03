<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AuthController extends AbstractController
{
    #[Route('/connexion', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
       $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
         $lastUsername = $authenticationUtils->getLastUsername();

         return $this->render('loginform/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
      }

    #[Route('/logout', name: 'app_logout', methods: ['GET'])]
    public function logout(): never
    {
        // controller can be blank: it will never be called!
        throw new \Exception('Logout');
    }
}
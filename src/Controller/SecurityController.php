<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     * @param AuthenticationUtils $authenticationUtils
     * @param AuthorizationCheckerInterface $authChecker
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils, AuthorizationCheckerInterface $authChecker): Response
    {
        if ($authChecker->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('homepage');
        }

        $errors = $authenticationUtils->getLastAuthenticationError();

        $lastUserName = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUserName,
            'error' => $errors,
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {

    }
}
<?php
namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @return Response
     */
    public function homeAction()
    {
        /** @var User $user */
        $user = $this->getUser();

        return $this->render("homepage/view.html.twig", [
            'username' => $user->getEmail()
        ]);
    }
}
<?php
namespace App\Controller;

use App\Form\Type\UserType;
use App\Service\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
    /** @var UserManager */
    private $userManager;

    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * @Route("/registration", name="user_registration")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function registrationAction(Request $request): Response
    {
        $user = $this->userManager->getNew();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password)
                ->eraseCredentials();
            $this->userManager->save($user);
            return $this->redirectToRoute('login');
        }
        return $this->render('user/registration.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

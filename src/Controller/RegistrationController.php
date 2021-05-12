<?php

namespace App\Controller;

use App\Entity\User;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    private $emailVerifier;
    private $em;

    public function __construct(EmailVerifier $emailVerifier, EntityManagerInterface $em)
    {
        $this->emailVerifier = $emailVerifier;
        $this->em = $em;
    }

    /**
     * @Route("/register", name="app_register")
     */
    public function indexRegister(): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('accueil');
        }
        return $this->render('registration/register.html.twig');
    }

    /**
     * @Route("/register/more-information", name="app_register_more_information")
     * @param Request $request
     */
    public function moreInformation(Request $request): Response
    {
        $email = $request->query->get('email');
        $password = $request->query->get('password');

        if ($this->getUser()) {
            return $this->redirectToRoute('accueil');
        }
        return $this->render('registration/register-moreInformation.html.twig');
    }

    /**
     * @Route("/register/validate", name="app_register_validate")
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @return Response
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $request = $request->request->all();
        $userExiste = $this->em->getRepository(User::class)->findOneBy(['email' => $request['email']]);
        if($userExiste instanceof User){
            $this->addFlash('error', 'L\'email est deja pris');
            return $this->render('registration/register.html.twig');
        }else{
            $user = new User($request['pseudo'], $request['email']);
            $hash = $encoder->encodePassword($user, $request['password']);
            $user->setPassword($hash);
            $user->setRoles(['ROLE_USER']);
            $this->em->persist($user);
            $this->em->flush();
            return $this->render('registration/register-moreInformation.html.twig');
        }


    }

    /**
     * @Route("/verify/email", name="app_verify_email")
     */
    public function verifyUserEmail(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $exception->getReason());

            return $this->redirectToRoute('app_register');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Your email address has been verified.');

        return $this->redirectToRoute('app_register');
    }
}

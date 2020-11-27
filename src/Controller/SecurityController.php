<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }

    /**
     * @Route("/login", name="app_login")
     * @return Response
     */
    public function indexLogin(): Response
    {
        return $this->render('login/login.html.twig');
    }

    /**
     * @Route("/login/validate", name="app_login_validate")
     * @param Request $request
     * @return Response
     */
    public function login(Request $request): Response
    {
        $request = $request->request->all();
        $this->em->getRepository(User::class)->findOneBy(['email' => $request['email'], 'password' => sha1($request['password'])]);
        return $this->render('login/login.html.twig');
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}

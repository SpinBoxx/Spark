<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class UserController extends AbstractController
{
    public function __construct()
    {
    }
    /**
     * @Route("/user", name="user")
     */
    public function index(): Response
    {
        /** @var User $current_user */
        $current_user = $this->getUser();
        $user_firstname = $current_user->getFirstname();
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'user_firstname' => $user_firstname
        ]);
    }
    /**
     * @Route("/user/modif", name="user")
     */
    public function modification(): Response
    {
        /** @var User $current_user */
        $current_user = $this->getUser();
        $user_firstname = $current_user->getFirstname();
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'user_firstname' => $user_firstname
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ErrorPageController extends AbstractController
{
    /**
     * @Route("/error404", name="error_page")
     */
    public function index(): Response
    {
        return $this->render('error_page/index.html.twig', [
            'controller_name' => 'ErrorPageController',
        ]);
    }
}

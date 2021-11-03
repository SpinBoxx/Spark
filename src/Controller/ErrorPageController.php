<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ErrorPageController extends AbstractController
{
    /**
     * @Route("/error404", name="error")
     */
    public function index(): Response
    {
        return $this->render('bundles/TwigBundle/Exception/error404.html.twig');
    }
}

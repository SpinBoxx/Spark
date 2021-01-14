<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FavoritePageController extends AbstractController
{
    /**
     * @Route("/mes-favoris", name="favoris")
     */
    public function index(): Response
    {
        return $this->render('favoris/favoris.html.twig', [

        ]);
    }
}

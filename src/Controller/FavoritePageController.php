<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FavoritePageController extends AbstractController
{
    /**
     * @Route("/favorite", name="favorite_page")
     */
    public function index(): Response
    {
        return $this->render('favorite_page/index.html.twig', [
            'controller_name' => 'FavoritePageController',
        ]);
    }
}

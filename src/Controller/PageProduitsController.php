<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageProduitsController extends AbstractController
{
    /**
     * @Route("/", name="page_produits")
     */


    public function index()
    {
        return $this->render('page_produits/index.html.twig', [
            'controller_name' => 'PageProduitsController',
        ]);
    }
}

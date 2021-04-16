<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductReturnController extends AbstractController
{
    /**
     * @Route("/produitRetour", name="product_return")
     */
    public function index(): Response
    {
        return $this->render('product_return/product_return.html.twig', [
            'controller_name' => 'ProductReturnController',
        ]);
    }
}

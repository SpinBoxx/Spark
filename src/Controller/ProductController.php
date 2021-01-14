<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/ajouter-un-produit", name="product_add")
     */
    public function index(): Response
    {
        $product = new Product();

        return $this->render('product/addproduct.html.twig', [

        ]);
    }



    /**
     * @Route("/produit/{id}", name="product")
     */
    public function display_product(): Response
    {
        return $this->render('product/view_product.html.twig', [
        ]);
    }
}

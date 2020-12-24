<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/ajouter-un-produit", name="add_product")
     */
    public function index(Request $request): Response
    {

        return $this->render('product/addproduct.html.twig', [

        ]);
    }
    /**
     * @Route("/ajouter-un-produit/validated", name="add_product_validate")
     */
    public function validate(Request $request): Response
    {
        $product = new Product();
        if ($this->isGranted('ROLE_USER') == false) {
            return  $this->redirectToRoute('app_login');
        }else{
            $request = $request->request->all();
            if($request['title'] != null){
                $product->setTitle($request['title']);
            }
            if($request['category'] != null){
                $product->setCategory($request['category'] );
            }
            if($request['price'] != null){
                $product->setPrice($request['price']);
            }
            if($request['color_primary'] != null){
                $product->setColorPrimary($request['color_primary']);
            }
            if($request['color_secondary'] != null){
                $product->setColorSecondary($request['color_secondary']);
            }
            if($request['size'] != null){
                $product->setSize($request['size']);
            }
            if($request['brand'] != null){
                $product->setBrand($request['brand']);
            }
            if($request['quality'] != null){
                $product->setQuality($request['quality']);
            }
            if($request['quality'] != null){
                $product->setQuality($request['quality']);
            }
            if($request['link'] != null){
                $product->setLink($request['link']);
            }
            if($request['gender'] != null){
                $product->setGender($request['gender']);
            }
            if($request['description'] != null){
                $product->setDescription($request['description']);
            }
            if($request['picture_product'] != null){
                $product->setPictureProduct($request['picture_product']);
            }
            $this->em->persist($product);
            $this->em->flush();
            return  $this->redirectToRoute('accueil');
        }

    }
}

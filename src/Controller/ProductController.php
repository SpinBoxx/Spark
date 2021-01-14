<?php

namespace App\Controller;

use App\Entity\Color;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class ProductController extends AbstractController
{
    private $em;
    private $security;
    public function __construct(EntityManagerInterface $em, Security $security)
    {
        $this->em = $em;
        $this->security = $security;
    }

    /**
     * @Route("/ajouter-un-produit", name="product_add")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        return $this->render('product/addproduct.html.twig', [
        ]);
    }

    /**
     * @Route("/prodcuct-insert", name="product_insert")
     * @param Request $request
     * @return Response
     */
    public function insertProduct(Request $request): Response
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
                // on cherche la couleur dans le repo
                $color = $this->em->getRepository(Color::class)->findOneBy(["hex_color" => $request['color_primary']]);
                // si elle existe pas on la créé
                if($color == null){
                    $newcolor = new Color();
                    $newcolor->setHexColor($request['color_primary']);
                    $this->em->persist($newcolor);
                    $newcolor->setCode("code");
                    $newcolor->setLabel("label");
                    $product->setColorPrimary($newcolor);
                }else{
                    $product->setColorPrimary($color);
                }

            }
            if($request['color_secondary'] != null){
                // on cherche la couleur dans le repo
                $color = $this->em->getRepository(Color::class)->findOneBy(["hex_color" => $request['color_secondary']]);
                // si elle existe pas on la créé
                if($color == null){
                    $newcolor = new Color();
                    $newcolor->setHexColor($request['color_secondary']);
                    $newcolor->setCode("code");
                    $newcolor->setLabel("label");
                    $this->em->persist($newcolor);
                    $product->setColorPrimary($newcolor);
                }else{
                    $product->setColorPrimary($color);
                }
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
            if($request['picture_product'] != null) {
                $product->setPictureProduct([$request['picture_product']]);
            }
            $product->setUserId($this->security->getUser());
            $this->em->persist($product);
            $this->em->flush();
            return  $this->redirect("/");
        }

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

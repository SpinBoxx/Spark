<?php

namespace App\Controller;

use App\Entity\Color;
use App\Entity\Gender;
use App\Entity\Product;
use App\Entity\Quality;
use App\Entity\State;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class ProductController extends AbstractController
{
    private $em;
    private $security;

    public function __construct(EntityManagerInterface $em, Security $security){
        $this->em = $em;
        $this->security = $security;
    }

    /**
     * @Route("/", name="accueil")
     * @return Response
     */
    public function index(): Response{
        $products = $this->em->getRepository(Product::class)->findAll();
        return $this->render('accueil/accueil.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/ajouter-un-produit", name="product_add")
     * @param Request $request
     * @return Response
     */
    public function addProduct(Request $request): Response
    {
        $genders = $this->em->getRepository(Gender::class)->findAll();
        $qualitys = $this->em->getRepository(Quality::class)->findAll();
        return $this->render('product/addproduct.html.twig', [
            'genders' => $genders,
            'qualitys' => $qualitys,
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
        $state = $this->em->getRepository(State::class)->findOneBy(['code'=>'in_sell']);
        $product->setState($state);
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
                $quality = $this->em->getRepository(Quality::class)->find($request['quality']);
                if($quality instanceof Quality){
                    $product->setQuality($quality);
                }
            }
            if($request['link'] != null){
                $product->setLink($request['link']);
            }
            if($request['gender'] != null){
                $gender = $this->em->getRepository(Gender::class)->find($request['gender']);
                if($gender instanceof Gender){
                    $product->setGender($gender);
                }
            }
            if($request['description'] != null){
                $product->setDescription($request['description']);
            }
            if($request['picture_product'] != null) {
                $product->setPictureProduct([$request['picture_product']]);
            }
            $product->setUser($this->security->getUser());
            $this->em->persist($product);
            $this->em->flush();
            return  $this->redirect("/");
        }

    }

    /**
     * @Route("/produit/{id}", name="product_show")
     * @param $id
     * @return Response
     * @throws Exception
     */
    public function show_product($id): Response
    {
        $product = $this->em->getRepository(Product::class)->find($id);
        if($product instanceof Product){
            return $this->render('product/view_product.html.twig', [
                'product' => $product,
            ]);
        }
        return $this->redirectToRoute('accueil');
    }
    /**
     * @Route("/produit/{id}/delete", name="product_delete")
     * @param $id
     * @return Response
     * @throws Exception
     */
    public function delete_and_redirect($id): Response
    {
        $product = $this->em->getRepository(Product::class)->find($id);
        $user = $product->getUser();
        $current_user = $this->security->getUser();
        if($user->getId() === $current_user->getId()){
            $this->em->remove($product);
            $this->em->flush();
            return new Response(200);
        }
        return new Response(500);
    }

    /**
     * @Route("/produit/{id}/buy", name="product_buy")
     * @param $id
     * @return Response
     * @throws Exception
     */
    public function buyProduct($id): Response
    {
        return $this->render('product/buy/buy.html.twig');
    }

}

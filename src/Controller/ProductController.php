<?php

namespace App\Controller;

use App\Entity\Color;
use App\Entity\Favorite;
use App\Entity\Gender;
use App\Entity\Product;
use App\Entity\Quality;
use App\Entity\State;
use App\Entity\User;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\FileBag;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class ProductController extends AbstractController
{
    private $em;
    private $security;
    private $kernel;

    /**
     * ProductController constructor.
     * @param EntityManagerInterface $em
     * @param Security $security
     * @param KernelInterface $kernel
     */
    public function __construct(EntityManagerInterface $em, Security $security, KernelInterface $kernel){
        $this->em = $em;
        $this->security = $security;
        $this->kernel = $kernel;
    }

    /**
     * @Route("/", name="accueil")
     * @param Request $request
     * @IsGranted("ROLE_USER")
     * @return Response
     */
    public function index(Request $request): Response{

        $sports = scandir($this->kernel->getProjectDir().'/public/images/accueil/sports/');
        unset($sports[0]);
        unset($sports[1]);

        foreach ($sports as $sport){
            $tab[] = $sport;
        }

        $products = $this->em->getRepository(Product::class)->findAll();
        $pathnameSports = ["arc.png", "rugby.png"];

        return $this->render('accueil/accueil.html.twig', [
            'products' => $products,
            'sports' => $tab,
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
     * @Route("/product-insert", name="product_insert")
     * @param Request $request
     * @return Response
     */
    public function insertProduct(Request $parent_request, FileUploader $fileUploader): Response
    {
        $product = new Product();
        $state = $this->em->getRepository(State::class)->findOneBy(['code'=>'in_sell']);
        $product->setState($state);
        if ($this->isGranted('ROLE_USER') == false) {
            return  $this->redirectToRoute('app_login');
        }else{
            /** @var Request $request */
            $request = $parent_request->request->all();
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



               //$file->getClientOriginalName();
                $file_array = [];



                $files = $parent_request->files->get('picture_product');


                if($files){
                    foreach ($files as $file) {
                        $fileName = $fileUploader->upload($file);
                        $file_array[] = $fileName;
                    }
                    $product->setPictureProduct($file_array);
                }



            $product->setUser($this->security->getUser());
            $this->em->persist($product);
            $this->em->flush();
            return $this->redirect("/");
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
            return new Response('',Response::HTTP_OK);
        }
        return new Response('',Response::HTTP_INTERNAL_SERVER_ERROR);
    }

  /**
   * @Route("/rechercher-un-product", name="product_search", methods={"GET"})
   */
    public function searchProduct(Request $request){
      $params = $request->query->all();
      if(isset($params['product_parameter_string'])){
        $products = $this->em->getRepository(Product::class)->findProductsByFilter($params['product_parameter_string']);
        $sports = scandir($this->kernel->getProjectDir().'/public/images/accueil/sports/');
        unset($sports[0]);
        unset($sports[1]);

        foreach ($sports as $sport){
          $tab[] = $sport;
        }
        return $this->render('accueil/accueil.html.twig', [
          'products' => $products,
          'sports' => $tab,
          'product_not_found' => 'Il y a 0 produit pour la recherche : ' . $params['product_parameter_string'],
        ]);
      } else {
        return $this->redirectToRoute('accueil');
      }
    }

  /**
   * @Route("/ajouter-un-favoris", name="product_add_or_delete_favorite", methods={"POST"})
   */
    public function addOrDeleteFavorite(Request $request){
      $params = $request->request->all();
      if(isset($params['productId'])){
        if(ctype_digit($params['productId'])){
          $product = $this->em->getRepository(Product::class)->find($params['productId']);
          $isFavoris = $this->em->getRepository(Favorite::class)->findOneBy(['user'=> $this->getUser(), 'product' => $product]);
          if ($isFavoris instanceof Favorite){
            $this->em->remove($isFavoris);
            $this->em->flush();
            return $this->json(['message' => 'Supprimé de vos favoris'], Response::HTTP_OK);
          } else {
            $favorite = new Favorite();
            $favorite->setProduct($product);
            $favorite->setUser($this->getUser());
            $this->em->persist($favorite);
            $this->em->flush();
            return $this->json(['message' => 'Ajouté dans vos favoris'], Response::HTTP_OK);
          }
        } else {
          return $this->json(['message' => 'Le product-id doit etre un nombre'], Response::HTTP_FORBIDDEN);
        }
      } else {
        return $this->json(['message' => 'Erreur'], Response::HTTP_FORBIDDEN);
      }
    }

}

<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Color;
use App\Entity\Favorite;
use App\Entity\Gender;
use App\Entity\Product;
use App\Entity\Quality;
use App\Entity\Size;
use App\Entity\State;
use App\Service\FileUploader;
use App\Service\MollieService;
use App\Service\SecurityCheckService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Mollie\Api\MollieApiClient;
use phpDocumentor\Reflection\Types\This;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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
  private SecurityCheckService $checkService;

  /**
   * ProductController constructor.
   * @param EntityManagerInterface $em
   * @param Security $security
   * @param KernelInterface $kernel
   * @param SecurityCheckService $checkService
   */
  public function __construct(EntityManagerInterface $em, Security $security, KernelInterface $kernel, SecurityCheckService $checkService){
    $this->em = $em;
    $this->security = $security;
    $this->kernel = $kernel;
    $this->checkService = $checkService;
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
    $categories = $this->em->getRepository(Category::class)->findAll();
    $colors = $this->em->getRepository(Color::class)->findAll();
    $sizes = $this->em->getRepository(Size::class)->findAll();
    return $this->render('product/addproduct.html.twig', [
      'genders' => $genders,
      'qualitys' => $qualitys,
      'categories' => $categories,
      'colors' => $colors,
      'sizes' => $sizes
    ]);
  }

  /**
   * @Route("/product-insert", name="product_insert")
   * @param Request $request
   * @return Response
   */
  public function insertProduct(Request $request, FileUploader $fileUploader): Response
  {
    if ($this->isGranted('ROLE_USER') === false) {
      return  $this->redirectToRoute('app_login');
    }else {
      $params = $request->request->all();
      if ($this->checkService->checkIssetNameRequest($params, ['name', 'brand', 'category', 'state', 'price', 'main_color', 'size', 'gender', 'description'])) {
        if ($this->checkService->checkNotEmptyNameRequest($params, ['name', 'brand', 'category', 'state', 'price', 'main_color', 'size', 'gender', 'description'])) {
          // THE PARAMS VERIFICATION IS OK
          $product = new Product();
          $state = $this->em->getRepository(State::class)->findOneBy(['code' => 'in_sell']);
          $mainColor = $this->em->getRepository(Color::class)->find($params['main_color']);
          (isset($params['secondary_color']) && !trim(empty($params['secondary_color']))) ?
            $secondaryColor = $this->em->getRepository(Size::class)->find($params['size']) : $secondaryColor = null;
          $size = $this->em->getRepository(Size::class)->find($params['size']);
          $gender = $this->em->getRepository(Gender::class)->find($params['gender']);
          $category = $this->em->getRepository(Category::class)->find($params['category']);
          $quality = $this->em->getRepository(Quality::class)->find($params['state']);

          $product->setState($state);
          $product->setColorPrimary($mainColor);
          $product->setColorSecondary($secondaryColor);
          $product->setSize($size);
          $product->setGender($gender);
          $product->setDescription($params['description']);
          $product->setCategory($category);
          $product->setQuality($quality);
          $product->setTitle($params['name']);
          $product->setBrand($params['brand']);
          $product->setPrice($params['price']);
          $product->setLink($params['link']);
          $product->setUser($this->getUser());
          $this->em->persist($product);
          $this->em->flush();
          $product->setImagePath($fileUploader->getTargetDirectory() . "/" . $this->getUser()->getId() . "/" . $product->getId());
          $fileUploader->setTargetDirectory($fileUploader->getTargetDirectory() . "/" . $this->getUser()->getId() . "/" . $product->getId());
          $images = $request->files->get('images');
          foreach ($images as $image){
            if($image instanceof UploadedFile){
              if($image->getError() === 0){
                if($image->getMimeType() === "image/jpeg" || $image->getMimeType() === "image/png" || $image->getMimeType() === "image/jpg"){
                  $fileUploader->upload($image);
                }
              }
            }
          }
          $this->em->persist($product);
          $this->em->flush();
        } else {
          return $this->redirectToRoute('product_add');
        }
      } else {
        // THE PARAMS VERIFICATION IS NOT OK
        var_dump("pasok");
        die();
        return $this->redirectToRoute('product_add');
      }
    }
    return $this->redirectToRoute('product_add');
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
   * @Route("/produit/{id}/buy", name="product_buy")
   * @return Response
   * @throws Exception
   */
  public function buy($id, $site_url){
    $this->mollieService->init();
    $redirectUrl = $this->redirectToRoute('product_show', ['id' => $id])->getTargetUrl();
    $mollie = $this->mollieService->createPayement("22.02",$site_url . $redirectUrl, "");

    return $this->redirect($mollie->getCheckoutUrl());
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

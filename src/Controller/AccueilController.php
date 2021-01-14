<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    private $em;

    /**
     * AccueilController constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }
    /**
     * @Route("/", name="accueil")
     */
    public function index(): Response
    {
        $produits = $this->em->getRepository(Product::class)->findAll();
        return $this->render('accueil/accueil.html.twig', [
            'produits' => $produits,
        ]);
    }
}

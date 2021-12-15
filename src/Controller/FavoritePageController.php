<?php

namespace App\Controller;

use App\Entity\Favorite;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FavoritePageController extends AbstractController
{
  private EntityManagerInterface $em;

  /**
   * @param EntityManagerInterface $em
   */
  public function __construct(EntityManagerInterface $em)
  {
    $this->em = $em;
  }

  /**
     * @Route("/mes-favoris", name="favoris")
     */
    public function index(): Response
    {
      $favorites = $this->em->getRepository(Favorite::class)->findAll();
        return $this->render('favoris/favoris.html.twig', [
          'productsFavorite' => $favorites
        ]);
    }
}

<?php
namespace App\Twig;

use App\Entity\Favorite;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class Favoris extends AbstractExtension{
  private EntityManagerInterface $em;
  private Security $security;

  /**
   * @param EntityManagerInterface $em
   */
  public function __construct(EntityManagerInterface $em, Security $security)
  {
    $this->em = $em;
    $this->security = $security;
  }

  public function getFunctions(){
    return [
      new TwigFunction('isFavoris', [$this, 'isFavoris']),
    ];
  }

  public function isFavoris($productId)
  {
    $product = $this->em->getRepository(Product::class)->find($productId);
    if ($product instanceof Product) {
      $favoris = $this->em->getRepository(Favorite::class)->findOneBy(['user' => $this->security->getUser(), 'product' => $product]);
      if ($favoris instanceof Favorite) {
        return true;
      }
      return false;
    }
    return false;
  }
}
<?php

namespace App\Twig;

use App\Entity\Brand;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class BrandTwig extends AbstractExtension
{
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

    public function getFunctions()
    {
        return [
            new TwigFunction('getAllBrands', [$this, 'getAllBrands']),
        ];
    }

    public function getAllBrands()
    {
        $brands = $this->em->getRepository(Brand::class)->findAll();


        return $brands;
    }
}

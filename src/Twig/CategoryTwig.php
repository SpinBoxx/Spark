<?php

namespace App\Twig;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class CategoryTwig extends AbstractExtension
{
    private EntityManagerInterface $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('getAllCategories', [$this, 'getAllCategories']),
        ];
    }

    public function getAllCategories()
    {
        $category = $this->em->getRepository(Category::class)->findAll();

        return $category;
    }
}

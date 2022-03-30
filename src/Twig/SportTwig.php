<?php

namespace App\Twig;

use App\Entity\Brand;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class SportTwig extends AbstractExtension
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
            new TwigFunction('getAllSports', [$this, 'getAllSports']),
        ];
    }

    public function getAllSports()
    {
        $sports = $this->em->getRepository(Sport::class)->findAll();

        return $sports;
    }
}

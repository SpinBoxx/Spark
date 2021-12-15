<?php

namespace App\DataFixtures;


use App\Entity\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BrandFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $brands = [
            ['NIK', 'Nike'],
            ['ADI', 'Adidas'],
            ['ELE', 'Element'],
        ];
        foreach ($brands as $brand) {
            $_brand = $manager->getRepository(Brand::class)->findOneBy(['code' => $brand[0]]);
            if (!$_brand instanceof Brand) {
                $brand_object = new Brand();
                $brand_object->setCode($brand[0]);
                $brand_object->setLabel($brand[1]);
                $manager->persist($brand_object);
                $manager->flush();
            }
        }
        echo "Loaded BrandFixtures with success !\r\n";
    }
}

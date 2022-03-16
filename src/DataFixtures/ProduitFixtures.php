<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Color;
use App\Entity\Gender;
use App\Entity\Product;
use App\Entity\Quality;
use App\Entity\State;
use App\Entity\User;
use App\Entity\Brand;
use App\Entity\Size;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProduitFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $admin = $manager->getRepository(User::class)->findOneBy(['username' => 'admin']);
        $state = $manager->getRepository(State::class)->findOneBy(['code' => 'en_vente']);
        $gender = $manager->getRepository(Gender::class)->findOneBy(['code' => 'homme']);
        $color = $manager->getRepository(Color::class)->findOneBy(['code' => 'red']);
        $quality = $manager->getRepository(Quality::class)->findOneBy(['code' => 'neuf_avec_etiquette']);
        $brand = $manager->getRepository(Brand::class)->findOneBy(['code' => 'ADI']);
        $size = $manager->getRepository(Size::class)->findOneBy(['code' => 'M']);
        $category = $manager->getRepository(Category::class)->findOneBy(['code' => "short"]);


        $products = [
            [$admin, $state, $gender, $color, "article", "description", $size, $brand, $category, 100, $quality],
            [$admin, $state, $gender, $color, "article", "description", $size, $brand,  $category, 100, $quality],
            [$admin, $state, $gender, $color, "article", "description", $size, $brand,  $category, 100, $quality],
        ];
        $i = 0;
        foreach ($products as $product) {
            $_product = $manager->getRepository(Product::class)->findOneBy(['title' => $product[4] . $i]);
            if (!$_product instanceof Product) {
                $_product = new Product();
                $_product->setUser($product[0]);
                $_product->setState($product[1]);
                $_product->setGender($product[2]);
                $_product->setColorPrimary($product[3]);
                $_product->setTitle($product[4]);
                $_product->setDescription($product[5]);
                $_product->setSize($product[6]);
                $_product->setBrand($product[7]);
                $_product->setCategory($product[8]);
                $_product->setPrice($product[9]);
                $_product->setQuality($product[10]);
                $manager->persist($_product);
                $manager->flush();
                $i++;
            }
        }
        echo "Loaded ProductFixtures with success ! ( $i )\n";
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            StateFixtures::class,
            CategoryFixtures::class,
            SizeFixtures::class,
            QualityFixtures::class,
        ];
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\Color;
use App\Entity\Gender;
use App\Entity\Product;
use App\Entity\Quality;
use App\Entity\State;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProduitFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $admin = $manager->getRepository(User::class)->findOneBy(['username' => 'admin']);
        $state = $manager->getRepository(State::class)->findOneBy(['code'=>'en_vente']);
        $gender = $manager->getRepository(Gender::class)->findOneBy(['code'=> 'homme']);
        $color = $manager->getRepository(Color::class)->findOneBy(['code'=> 'red']);
        $quality = $manager->getRepository(Quality::class)->findOneBy(['code'=> 'neuf_avec_etiquette']);

        $products = [
            [$admin, $state, $gender, $color, "article", "description", '12','Nike', 100, "chaussures", $quality],
            [$admin, $state, $gender, $color, "article", "description", '12','Nike', 100, "chaussures", $quality],
            [$admin, $state, $gender, $color, "article", "description", '12','Nike', 100, "chaussures", $quality],
        ];
        $i = 0;
        foreach ($products as $product){
            $_product = $manager->getRepository(Product::class)->findOneBy(['title' => $product[4] . $i]);
            if(!$_product instanceof Product){
                $_product = new Product($product[0],$product[1], $product[2], $product[3], $product[4], $product[5], $product[6] , $product[7], $product[8], $product[9], $product[10]);
                $manager->persist($_product);
                $manager->flush();
            }
        }
        echo "Loaded GenderFixtures with success ! ( $i )\n";
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            StateFixtures::class,
            QualityFixtures::class,
        ];
    }
}

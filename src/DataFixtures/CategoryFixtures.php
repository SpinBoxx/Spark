<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $categories = [
            ['short', 'Short'],
            ['tshirt', 'T-shirt'],
            ['chaussure', 'Chaussure'],
        ];
        $i = 0;
        foreach ($categories as $category){
            $_category = $manager->getRepository(Category::class)->findOneBy(['code' => $category[0]]);
            if(!($_category instanceof Category)){
                $manager->persist(new Category($category[0], $category[1]));
                $manager->flush();
                $i++;
            }
        }
        echo "Loaded CategoryFixtures with success ! ( $i )\n";
    }
}

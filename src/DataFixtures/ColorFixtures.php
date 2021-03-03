<?php

namespace App\DataFixtures;

use App\Entity\Color;
use App\Entity\Gender;
use App\Entity\State;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ColorFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $array = [
            ['red','Red','#FF0000'],
            ['blue','Blue','#0000FF'],
        ];
        $i = 0;
        foreach ($array as $val){
            $color = $manager->getRepository(Color::class)->findOneBy(['code' => $val[0]]);
            if(!$color instanceof Color){
                $color = new Color();
                $color->setCode($val[0]);
                $color->setLabel($val[1]);
                $color->setHexColor($val[2]);
                $manager->persist($color);
                $manager->flush();
                $i++;
            }
        }
        echo "Loaded ColorFixtures with success ( $i )!\n";
    }
}

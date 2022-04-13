<?php

namespace App\DataFixtures;

use App\Entity\Size;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SizeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $sizes = [
            ['xxxl', 'XXXL'],
            ['xxl', 'XXL'],
            ['xl', 'XL'],
            ['l', 'L'],
            ['m', 'M'],
            ['s', 'S'],
            ['xs', 'XS'],
            ['xxs', 'XXS'],
            ['xxxs', 'XXXS']
        ];
        $i = 0;
        foreach ($sizes as $size) {
            $_size = $manager->getRepository(Size::class)->findOneBy(['code' => $size[0]]);
            if (!($_size instanceof Size)) {
                $size = new Size();
                $size->setCode($size[0]);
                $size->setLabel($size[1]);
                $manager->persist($size);

                $manager->flush();
                $i++;
            }
        }
        echo "Loaded SizeFixtures with success ! ( $i )\n";
    }
}

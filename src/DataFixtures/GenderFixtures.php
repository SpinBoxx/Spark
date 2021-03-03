<?php

namespace App\DataFixtures;

use App\Entity\Gender;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GenderFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $genders = [
            ['homme', 'Homme'],
            ['femme', 'Femme']
        ];
        $i = 0;
        foreach ($genders as $gender){
            $_gender = $manager->getRepository(Gender::class)->findOneBy(['code' => $gender[0]]);
            if(!$_gender instanceof Gender){
                $manager->persist(new Gender($gender[0], $gender[1]));
                $manager->flush();
                $i++;
            }
        }
        echo "Loaded GenderFixtures with success ! ( $i )\n";
    }
}

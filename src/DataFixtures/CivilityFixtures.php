<?php

namespace App\DataFixtures;

use App\Entity\Civility;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CivilityFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $civilitys = [
            ['m', 'M.'],
            ['mme', 'Mme.']
        ];
        foreach ($civilitys as $civility){
            $_civility = $manager->getRepository(Civility::class)->findOneBy(['code' => $civility[0]]);
            if(!$_civility instanceof Civility){
                $manager->persist(new Civility($civility[0], $civility[1]));
                $manager->flush();
            }
        }
        echo "Loaded CivilityFixtures with success !\n";
    }
}

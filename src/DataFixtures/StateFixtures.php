<?php

namespace App\DataFixtures;

use App\Entity\Civility;
use App\Entity\State;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StateFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $states = [
            ['en_vente', 'En vente'],
            ['achete', 'Acheté']
        ];
        foreach ($states as $state){
            $_state = $manager->getRepository(State::class)->findOneBy(['code' => $state[0]]);
            if(!$_state instanceof State){
                $manager->persist(new State($state[0], $state[1]));
                $manager->flush();
            }
        }
        echo "Loaded StateFixtures with success !\n";
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\Civility;
use App\Entity\Quality;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class QualityFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $qualites = [
            ['neuf_avec_etiquettes', 'Neuf avec étiquettes'],
            ['neuf_sans_etiquettes', 'Neuf sans étiquettes'],
            ['tres_bon_etat', 'Très bon état'],
            ['bon_etat', 'bon état'],
            ['satisfaisant', 'Satisfaisant'],
            ['usage', 'Usagé'],

        ];
        foreach ($qualites as $qualite){
            $_qualite = $manager->getRepository(Quality::class)->findOneBy(['code' => $qualite[0]]);
            if(!$_qualite instanceof Quality){
                $manager->persist(new Quality($qualite[0], $qualite[1]));
                $manager->flush();
            }
        }
        echo "Loaded QualityFixtures with success !\r\n";
    }
}

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
            ['neuf_avec_etiquette', 'Neuf avec étiquette'],
            ['neuf_sans_etiquette', 'Neuf sans étiquette'],
            ['tres_bon_etat', 'Très bon état'],
            ['bon_etat', 'Bon état'],
            ['satisfaisant', 'Satisfaisant'],
            ['usage', 'Usagé'],

        ];
        foreach ($qualites as $qualite) {
            $_qualite = $manager->getRepository(Quality::class)->findOneBy(['code' => $qualite[0]]);
            if (!$_qualite instanceof Quality) {
                $new_quality = new Quality();
                $new_quality->setCode($qualite[0]);
                $new_quality->setLabel($qualite[1]);
                $manager->persist($new_quality);
                $manager->flush();
            }
        }
        echo "Loaded QualityFixtures with success !\r\n";
    }
}

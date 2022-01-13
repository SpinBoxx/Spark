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
          ['blanc','Blanc','#FFFFFF'],
          ['noir','Noir','#000000'],
          ['rouge','Rouge','#FF0000'],
          ['bleu','Bleu','#0000FF'],
          ['bleu_fonce','Bleu foncé','#000080'],
          ['vert','Vert','#00FF00'],
          ['vert_epinard','Vert épinard','#175732'],
          ['jaune','Jaune','#FFFF00'],
          ['orange','Orange','#FFA500'],
          ['violet','Violet','#EE82EE'],
          ['mauve','Mauve','#D473D4'],
          ['lilas','Lilas','#B666D2'],
          ['gris','Gris','#808080'],
          ['argent','Argent','#C0C0C0'],
          ['rose','Rose','#FD6C9E'],
          ['marron','Marron','#582900'],
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

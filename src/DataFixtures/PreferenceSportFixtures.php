<?php

namespace App\DataFixtures;

use App\Entity\Sport;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpKernel\KernelInterface;

class PreferenceSportFixtures extends Fixture
{
    private $kernel;

    /**
     * @param KernelInterface $kernel
     */
    public function __construct(KernelInterface $kernel){

        $this->kernel = $kernel;
     }

    public function load(ObjectManager $manager)
    {
        $sports = scandir($this->kernel->getProjectDir().'/public/images/accueil/sports/');
        unset($sports[0]);
        unset($sports[1]);

        foreach ($sports as $sport){
            $sportTmp = $manager->getRepository(Sport::class)->findOneBy(['path' => $sport]);
            if(!$sportTmp instanceof Sport){
                $manager->persist(new Sport($sport));
                $manager->flush();
            }
        }
        echo "Loaded SportFixtures with success !\n";
    }
}

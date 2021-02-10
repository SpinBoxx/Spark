<?php

namespace App\DataFixtures;

use App\Entity\Civility;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    /**
     * UserFixtures constructor.
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager )
    {
        $admin = ['admin', 'admin@admin.fr', 'admin'];

        $adminExist = $manager->getRepository(User::class)->findOneBy(['username' => 'admin']);
        if(!$adminExist instanceof User){
            $newUser = new User($admin[0],$admin[1]);
            $hash = $this->encoder->encodePassword($newUser, $admin[2]);
            $newUser->setPassword($hash);
            $newUser->setRoles(['ROLE_ADMIN']);
            $manager->persist($newUser);
            $manager->flush();
        }
        echo "Loaded UserFixtures with success !\n";
    }
}

<?php


namespace App\Service;


use App\Entity\Product;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class UserService
{
    private $em;

    private $security;
    public function __construct(EntityManagerInterface $em, Security $security)
    {
        $this->em = $em;
        $this->security = $security;
    }

    public function get_user_ads(UserInterface $user)
    {
        $product_repo = $this->em->getRepository(Product::class);
        /** @var User $user_id */
        $user = $this->security->getUser();
        $user_id = $user->getId();
        //findby = cherche parmi les champs de products ici "user" qui ont la valeur de $user_id (id de l'utilisateur actuelle)

        $user_ads = $product_repo->findBy(['user' => $user_id]);
        if($user_ads != null){
            return $user_ads;
        }else{
            return null;
        }
    }

}
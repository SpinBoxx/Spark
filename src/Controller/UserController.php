<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/user", name="user")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('user/profil/index.html.twig', [
            'controller_name' => 'UserController']);
    }

    /**
     * @Route("/user/update", name="user_update")
     * @param Request $req
     * @return Response
     */
    public function update(Request $req): Response
    {
        /** @var User $current_user */
        $current_user = $this->getUser();
        $request = $req->request->all();
        if ($request["firstname"]) {
            // on enregistre en minuscule
            $current_user->setFirstname(strtolower($request["firstname"]));
        }
        if ($request["lastname"]) {
            // on enregistre en minuscule
            $current_user->setLastname(strtolower($request["lastname"]));
        }
        if ($request["city"]) {
            $current_user->setCity($request["city"]);
        }
        if ($request["phone"]) {
            $current_user->setPhone($request["phone"]);
        }
        if ($request["department"]) {
            $current_user->setDepartment($request["department"]);
        }
        if ($request["postal_code"]) {
            $current_user->setPostal_Code($request["postal_code"]);
        }
        if ($request["postal_address"]) {
            $current_user->setPostal_Address($request["postal_address"]);
        }
        $this->em->flush();
        $user_firstname = $current_user->getFirstname();
        return $this->redirectToRoute("user");
    }

    /**
     * @Route("/user/mes-annonces", name="user_ads")
     * @return Response
     */
    public function user_ad(): Response
    {
        $product_repo = $this->em->getRepository(Product::class);
        /** @var User $user_id */
        $user = $this->getUser();
        $user_id = $user->getId();
        //findby = cherche parmi les champs de products ici "user" qui ont la valeur de $user_id (id de l'utilisateur actuelle)
        $user_ads = $product_repo->findBy(['user' => $user_id]);
        return $this->render('user/user_ad.html.twig', [
            'controller_name' => 'UserController','ads' => $user_ads]);
    }
}

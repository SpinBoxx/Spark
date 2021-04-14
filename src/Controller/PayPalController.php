<?php

namespace App\Controller;


use App\Entity\OrderTest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class PayPalController extends AbstractController
{
    private $em;
    private $security;

    public function __construct(EntityManagerInterface $em, Security $security){
        $this->em = $em;
        $this->security = $security;
    }

    /**
     * @Route("/buy", name="buy")
     * @param Request $request
     */
    public function index(Request $request){
        $params = $request->request->all();
        $orderTest = new OrderTest();
        $orderTest->setIdBuyer($params);
        $this->em->persist($orderTest);
        $this->em->flush();
        return new Response('',200);
    }



}

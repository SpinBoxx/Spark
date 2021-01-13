<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VisionArticleController extends AbstractController
{
    /**
     * @Route("/visionarticle", name="vision_article")
     */
    public function index(): Response
    {
        return $this->render('vision_article/index.html.twig', [
            'controller_name' => 'VisionArticleController',
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MessagingController extends AbstractController
{
    /**
     * @Route("/mes-messages", name="messages")
     */
    public function messages(): Response
    {
        return $this->render('messages/messages.html.twig', [

        ]);
    }
}

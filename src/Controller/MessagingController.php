<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MessagingController extends AbstractController
{
    /**
     * @Route("/messaging/no-messages", name="no-messages")
     */
    public function noMessages(): Response
    {
        return $this->render('messaging/no-messages.html.twig', [
            'controller_name' => 'MessagingController',
        ]);
    }

    /**
     * @Route("/messaging/messages", name="messages")
     */
    public function messages(): Response
    {
        return $this->render('messaging/messages.html.twig', [
            'controller_name' => 'MessagingController',
        ]);
    }
}

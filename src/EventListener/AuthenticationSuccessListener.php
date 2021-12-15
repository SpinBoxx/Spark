<?php

namespace App\EventListener;

use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @param AuthenticationSuccessEvent $event
 */

class AuthenticationSuccessListener
{
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        $data = $event->getData();
        $user = $event->getUser();

        if (!$user instanceof User) {
            return;
        }

        $data['lastname'] = $user->getLastname();
        $data['firstname'] = $user->getFirstName();
        $data['email'] = $user->getEmail();
        $event->setData($data);
    }
}

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
        $data['username'] = $user->getUsername();
        $data['phone'] = $user->getPhone();
        $data['city'] = $user->getCity();
        $data['country'] = $user->getCountry();

        $event->setData($data);
    }
}

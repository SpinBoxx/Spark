<?php

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Product;
use App\Entity\User;
use App\Entity\Brand;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Doctrine\ORM\EntityManagerInterface;

class PostProductSubscriber implements EventSubscriberInterface
{

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(TokenStorageInterface $tokenStorage, EntityManagerInterface $em)
    {

        $this->tokenStorage = $tokenStorage;
        $this->em = $em;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['attachOwner', EventPriorities::PRE_WRITE],

        ];
    }

    public function attachOwner(ViewEvent $event)
    {
        $product = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();


        if (!$product instanceof Product || Request::METHOD_POST !== $method) {

            // Only handle Article entities (Event is called on any Api entity)
            return;
        }

        // maybe these extra null checks are not even needed
        $token = $this->tokenStorage->getToken();
        if (!$token) {
            return;
        }
        $owner = $token->getUser();
        if (!$owner instanceof User) {
            return;
        }


        $product->setUser($owner);
    }

    public function attachEntities(ViewEvent $event)
    {
        $product = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();
        $body =  json_decode($event->getRequest()->getContent(), true);
        if (!$product instanceof Product || Request::METHOD_POST !== $method) {

            // Only handle Article entities (Event is called on any Api entity)
            return;
        }

        // maybe these extra null checks are not even needed
        $token = $this->tokenStorage->getToken();
        if (!$token) {
            return;
        }
        $owner = $token->getUser();
        if (!$owner instanceof User) {
            return;
        }

        $repository = $this->em->getRepository(Brand::class);
        $brand = $repository->find($body["brand"]);
        $product->setBrand($brand->getId());
    }
}

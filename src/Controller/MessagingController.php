<?php

namespace App\Controller;

use App\Entity\Message;
use App\Entity\Product;
use App\Entity\User;
use App\Service\SecurityCheckService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class MessagingController extends AbstractController
{
    private $em;
    private $check;

    /**
     * MessagingController constructor.
     * @param EntityManagerInterface $em
     * @param SecurityCheckService $check
     */
    public function __construct(EntityManagerInterface $em, SecurityCheckService $check){
        $this->em = $em;
        $this->check = $check;
    }

    /**
     * @Route("/mes-messages", name="messages")
     * @param UserInterface $user
     * @return Response
     */
    public function messages(UserInterface $user): Response
    {
        $messages = $this->em->getRepository(Message::class)->findBy(['recipient' => $user->getId()]);
        $urlFctAjax = sha1('/mes-messages/delete/');
        return $this->render('messages/messages.html.twig', [
            'messages' => $messages,
            'urlFctAjax' => $urlFctAjax,
        ]);
    }

    /**
     * @Route("/mes-messages/envoyer", name="messages_send")
     * @param Request $request
     * @return Response
     */
    public function sendMessage( Request $request): Response
    {
        $submittedToken = htmlentities($request->request->get('token'));
        $params = $request->request->all();
        if($this->check->checkCSRF('send-message', $submittedToken) &&
            $this->check->checkIssetNameRequest($params, ['message', 'seller'])
        ){
            $user = $this->getUser();
            if($user instanceof User){
                $params = $request->request->all();
                $object = $this->em->getRepository(Product::class)->find($params['seller']);
                if($object instanceof Product){
                    $seller = $this->em->getRepository(User::class)->find($object->getUser()->getId());
                    if($seller instanceof User){
                        $message = new Message($user, $seller, $object->getTitle(), $params['message']);
                        $this->em->persist($message);
                        $this->em->flush();
                    }
                }
            }
        }
        return new Response('',200);
    }

    /**
     * @Route("/mes-messages/delete/{id}", name="messages_delete")
     * @param $id
     */
    public function deleteMessage($id): Response
    {
        if(isset($id)){
            if(is_numeric($id)) {
                $message = $this->em->getRepository(Message::class)->find($id);
                if ($message instanceof Message) {
                    $this->em->remove($message);
                    $this->em->flush();
                    return new Response('', 200);
                }
            }

        }
        return new Response('',Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}

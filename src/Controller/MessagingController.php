<?php

namespace App\Controller;

use App\Entity\Message;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class MessagingController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }

    /**
     * @Route("/mes-messages", name="messages")
     * @param UserInterface $user
     * @return Response
     */
    public function messages(UserInterface $user): Response
    {

        $messages = $this->em->getRepository(Message::class)->findBy(['recipient' => $user->getId()]);
        return $this->render('messages/messages.html.twig', [
            'messages' => $messages,
        ]);
    }

    /**
     * @Route("/mes-messages/delete/{id}", name="messages_delete")
     * @param $id
     */
    public function deleteMessage($id){
        if(isset($id)){
            if(is_numeric($id)){
                $message = $this->em->getRepository(Message::class)->find($id);
                if($message instanceof Message){
                    $this->em->remove($message);
                    $this->em->flush();
                }else{
                    $this->addFlash('error', 'Impossible de supprimer le message');
                }
            }else{
                $this->addFlash('error', 'Impossible de supprimer le message');
            }
        }else{
            $this->addFlash('error', 'Impossible de supprimer le message');
        }
        return $this->redirectToRoute('messages');
    }
}

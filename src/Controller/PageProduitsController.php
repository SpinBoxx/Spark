<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

class PageProduitsController extends AbstractController
{
    /**
     * @Route("/", name="page_produits")
     * @param MailerInterface $mailer
     * @return Response
     * @throws TransportExceptionInterface
     */
    public function index(MailerInterface $mailer){
        setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8');
        $date = DateTime::createFromFormat('j-M-Y', date('j-M-Y'));
        $date->modify('10 day');
        $date2 =  strftime('%e %A %B %Y', strtotime($date->format('j F Y')));

        $email = (new TemplatedEmail())
            ->from('quentin.mimault@orange.fr')
            ->to('you@example.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->htmlTemplate('registration/confirmation_email.html.twig')
            ->context([
                'expiration_date' => $date2,
                'username' => 'foo',
            ]);
            $mailer->send($email);
        return $this->render('page_produits/index.html.twig', [

        ]);
    }
}

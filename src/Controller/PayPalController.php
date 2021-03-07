<?php

namespace App\Controller;


use Doctrine\ORM\EntityManagerInterface;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @return Response
     */
    public function index(){
        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                'Aczn1cpYzebNjdjzTYcTTXejPG6bHouaabkdckMb_QZ4IETxlKXUZIgw3-_-rL2PYZbP5bTb8e3rQuUC',     // ClientID
                'EHhFa1Pl2OsbuQ5RyM-mM_siHyY89BYegnnYoqx1IOHHpsyw73k1IbmL-n6Eh1AkW9VeyKSz8WdPKZae'      // ClientSecret
            )
        );

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new Amount();
        $amount->setTotal('10');
        $amount->setCurrency('EUR');

        $transaction = new Transaction();
        $transaction->setAmount($amount);

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("http://spark.fr/buy")
            ->setCancelUrl("http://spark.fr/buy");

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);

        // After Step 3
        try {
            $payment->create($apiContext);
            echo $payment;

            echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";
        }
        catch (\PayPal\Exception\PayPalConnectionException $ex) {
            // This will print the detailed information on the exception.
            //REALLY HELPFUL FOR DEBUGGING
            echo $ex->getData();
        }
//        return $this->redirectToRoute("accueil");
    }



}

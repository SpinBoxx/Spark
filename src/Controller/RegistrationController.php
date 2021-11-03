<?php

namespace App\Controller;

use App\Entity\User;
use App\Security\EmailVerifier;
use App\Service\RegistrationService;
use App\Service\SecurityCheckService;
use Doctrine\ORM\EntityManagerInterface;
use Flasher\Prime\FlasherInterface;
use Mailjet\Client;
use Mailjet\Resources;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Flasher\Toastr\Prime\ToastrFactory;

class RegistrationController extends AbstractController
{
    private $em;
    private $registrationService;
    private $encoder;
    private $checkService;
    private $flasher;

    /**
     * RegistrationController constructor.
     * @param EntityManagerInterface $em
     * @param RegistrationService $registrationService
     * @param UserPasswordEncoderInterface $encoder
     * @param SecurityCheckService $checkService
     * @param FlasherInterface $flasher
     */
    public function __construct(
        EntityManagerInterface $em,
        RegistrationService $registrationService,
        UserPasswordEncoderInterface $encoder,
        SecurityCheckService $checkService,
        FlasherInterface $flasher
    ) {
        $this->em = $em;
        $this->registrationService = $registrationService;
        $this->encoder = $encoder;
        $this->checkService = $checkService;
        $this->flasher = $flasher;
    }

    /**
     * @Route("/creer-un-compte", name="findygo_register")
     */
    public function index(): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('accueil');
        }
        return $this->render('registration/register.html.twig');
    }

    /**
     * @Route("/creer-un-compte/informations-supplementaires", name="findygo_register_1")
     * @param Request $request
     * @param SessionInterface $session
     * @return Response
     */
    public function moreInformation(Request $request, SessionInterface $session): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('accueil');
        }

        $email = $request->request->get('email');
        $pseudo = $request->request->get('pseudo');
        $password = $request->request->get('password');
        $passwordConfirm = $request->request->get('password_confirm');
        if($this->registrationService->canRegister($email, $password, $passwordConfirm)){
            $user = new User($pseudo, $email);
            $hash = $this->encoder->encodePassword($user, $password);
            $user->setPassword($hash);
            $user->setRoles(['ROLE_USER']);
            $this->em->persist($user);
            $this->em->flush();
            $session->set('user', $user->getId());
            $session->set('register-1-ok', true);
            return $this->render('registration/register-moreInformation.html.twig', [
                'user' => $user,
            ]);
        }
        return $this->redirectToRoute('findygo_register');
    }

    /**
     * @Route("/creer-un-compte/sauvegarder-informations-supplementaires", name="findygo_register_2")
     * @param Request $request
     */
    public function register2(Request $request, SessionInterface $session, ToastrFactory $toastrFactory): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('accueil');
        }
        if($session->get('register-1-ok')){
            $userId = $session->get('user');
            $user = $this->em->getRepository(User::class)->find($userId);
            $params = $request->request->all();
            if($this->checkService->checkIssetNameRequest($params, ['nom', 'prenom', 'pays', 'ville', 'telephone'])){
                if($user instanceof User){
                    $user->setFirstname($params['prenom']);
                    $user->setLastname($params['nom']);
                    $user->setCountry($params['pays']);
                    $user->setCity($params['ville']);
                    $user->setPhone($params['telephone']);
                    $this->em->persist($user);
                    $this->em->flush();
                    return $this->redirectToRoute('app_login');
                }else{
                    $toastrFactory
                        ->closeHtml('<button><i class="fa fa-close text-white fa-lg"></i></button>')
                        ->progressBar(false)
                        ->timeOut(0)
                        ->tapToDismiss(false)
                        ->addError(40426164);
                }
            }else{
                $toastrFactory
                    ->closeHtml('<button><i class="fa fa-close text-white fa-lg"></i></button>')
                    ->progressBar(false)
                    ->timeOut(0)
                    ->tapToDismiss(false)
                    ->addError(71978874);
            }
            return $this->render('registration/register-moreInformation.html.twig', [
                'user' => $user,
            ]);
        }
        return $this->redirectToRoute('findygo_register');
    }


    /**
     * @Route("/mot-de-passe-oublie", name="findygo_password_forget")
     */
    public function passwordForget(Request $request){
      $mail = $request->request->get('email');
      $regex = "^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$^";
      if(preg_match($regex, $mail, $matches)){
          $mj = new Client('aab026f86b414066c7c611daf00b222a','526e725c9a32bea53c0e16178b850491',true,['version' => 'v3.1']);
          $body = [
              'Messages' => [
                  [
                      'From' => [
                          'Email' => "quentin.mimault@orange.fr",
                          'Name' => "FindyGo"
                      ],
                      'To' => [
                          [
                              'Email' => $mail,
                              'Name' => "quentin"
                          ]
                      ],
                      'Subject' => "Récupération du mot de passe",
                      'TextPart' => "My first Mailjet email",
                      'HTMLPart' => "<h3>Salut jeune sportif, voici le lien pour retrouver ton mot de passe : <a href='localhost/SymfTest/public/index.php'>Spark.fr</a>!</h3>",
                  ]
              ]
          ];
          $response = $mj->post(Resources::$Email, ['body' => $body]);
          $this->flasher->addSuccess('Mail de récupération de votre mot de passe a bien été envoyé.');
        } else {
          $this->flasher->addError('Veuillez entrer une adresse email valide.');
        }
        return $this->redirectToRoute('app_login');
    }
}

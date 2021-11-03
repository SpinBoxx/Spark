<?php


namespace App\Service;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Flasher\Prime\FlasherInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Security\Core\Security;

class RegistrationService
{
    private $em;
    private $flasher;


    /**
     * RegistrationService constructor.
     * @param EntityManagerInterface $em
     * @param FlasherInterface $flasher
     */
    public function __construct(EntityManagerInterface $em, FlasherInterface $flasher)
    {
        $this->em = $em;
        $this->flasher = $flasher;
    }

    /**
     * @param $email
     * @param $password
     * @param $passwordConfirm
     * @return bool
     */
    public function canRegister($email, $password, $passwordConfirm): bool
    {
        $user = $this->em->getRepository(User::class)->findOneBy(['email' => $email]);
        if($user instanceof User){
            $this->flasher->addError('Cet email est déjà utilisé. Veuillez en chosir un autre.');
            return false;
        }else{
            return $this->checkPassword($password, $passwordConfirm);
        }
    }

    /**
     * @param $password
     * @return bool
     */
    public function checkPassword($password, $passwordConfirm): bool
    {
        if(preg_match("^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$^", $password) === 1){
            if($password === $passwordConfirm){
                return true;
            }else{
                $this->flasher->addError('Les mots de passes ne correspondent pas.');
                return false;
            }
        }else{
            $this->flasher->addError('Votre mot de passe n&#39;est pas valide.');
            return false;
        }
    }

}

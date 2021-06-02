<?php


namespace App\Service;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Flasher\Toastr\Prime\ToastrFactory;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Security\Core\Security;

class RegistrationService extends ToastrService
{
    private $em;
    private $toastr;


    /**
     * RegistrationService constructor.
     * @param EntityManagerInterface $em
     * @param ToastrFactory $toastr
     */
    public function __construct(EntityManagerInterface $em, ToastrFactory $toastr)
    {
        parent::__construct($toastr);
        $this->em = $em;
        $this->toastr = $toastr;
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
            $this->toastrError('Cet email est déjà utilisé. Veuillez en chosir un autre.');
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
            if(strcmp($password, $passwordConfirm)){
                return true;
            }else{
                $this->toastrError('Les mots de passes ne correspondent pas.');
                return false;
            }
        }else{
            $this->toastrError('Votre mot de passe n&#39;est pas valide.');
            return false;
        }
    }

}
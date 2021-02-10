<?php


namespace App\Service;

use App\Interfaces\SecurityFormInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SecurityCheckService extends AbstractController implements SecurityFormInterface
{

    /**
     * @param string $csrfName
     * @param $requestToken
     */
    public function checkCSRF(string $csrfName, $requestToken): bool
    {
        if ($this->isCsrfTokenValid($csrfName, $requestToken)) {
            return true;
        }
        return false;
    }

    /**
     * @param $request
     * @param $namesRequest
     * @return false
     */
    public function checkIssetNameRequest($request, array $namesRequest): bool
    {
        $bool = false;
        if(isset($request)){
            foreach ($namesRequest as $nameRequest){
                $var = $request->request->get(htmlentities($nameRequest));
                if(isset($var)){
                    $bool = true;
                }else{
                    $bool = false;
                }
                if(!$bool){
                    return false;
                }
            }
        }
        return $bool;
    }
}
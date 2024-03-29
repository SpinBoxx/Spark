<?php


namespace App\Service;

use App\Interfaces\SecurityFormInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

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
     * @param array $params
     * @param array $namesRequest
     * @return bool
     */
    public function checkIssetNameRequest(array $params, array $namesRequest): bool
    {
        foreach ($namesRequest as $name){
            if(!isset($params[$name])) {
                return false;
            }
        }
        return true;
    }

  /**
   * @param array $params
   * @param array $namesRequest
   * @return bool
   */
  public function checkNotEmptyNameRequest(array $params, array $namesRequest): bool
  {
    foreach ($namesRequest as $name){
      if(trim(empty($params[$name]))) {
        return false;
      }
    }
    return true;
  }
}
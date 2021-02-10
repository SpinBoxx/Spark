<?php


namespace App\Interfaces;


use Symfony\Component\HttpFoundation\Request;

interface SecurityFormInterface
{

    public function checkCSRF(string $csrfName, $requestToken);

    public function checkIssetNameRequest(Request $request, array $namesRequest);

}
<?php


namespace App\Service;
use Mollie\Api\Exceptions\ApiException;
use Mollie\Api\MollieApiClient;

class MollieService
{

  private $mollie_api_key_test;
  private MollieApiClient $mollieApiClient;

  public function __construct($mollie_api_key_test)
  {
    $this->mollie_api_key_test = $mollie_api_key_test;
    $this->mollieApiClient = new MollieApiClient();
  }

  public function init(){
    try {
      $this->mollieApiClient->setApiKey($this->mollie_api_key_test);
    } catch (ApiException $e) {
      var_dump("errur api key");
      die();
    }
  }

  public function createPayement(string $price, string $redirectUrl,string $webhookUrl){

    try {

      return $this->mollieApiClient->payments->create([
        "amount" => [
          "currency" => "EUR",
          "value" => $price
        ],
        "description" => "My first API payment",
        "redirectUrl" => $redirectUrl,
        "webhookUrl" => "https://webshop.example.org/mollie-webhook/",
      ]);
    } catch (ApiException $e) {
      var_dump($e);
      die();
    }
  }
}
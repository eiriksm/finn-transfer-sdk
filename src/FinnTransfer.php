<?php

namespace eiriksm\FinnTransfer;

class FinnTransfer implements TransferrableInterface {

  /**
   * @var string
   */
  protected $ad;

  /**
   * @return \eiriksm\FinnTransfer\Client
   */
  public function getClient() {
    return $this->client;
  }

  /**
   * Client.
   *
   * @var \eiriksm\FinnTransfer\Client
   */
  protected $client;

  public function __construct() {
      // First get the finn client.
      $this->client = new Client();
  }


  public function transfer(\GuzzleHttp\Client $client) {
    $this->client->setClient($client);
    $req = $this->client->transfer($this->ad);
      $body = (string) $req->getBody();
      if (empty($body)) {
        throw new \Exception('Empty body from finn.');
      }
      // Load as xml.
      if (!$xml = @simplexml_load_string($body)) {
        throw new \Exception('The Finn body could not be transformed into XML.');
      }
      return $xml;
  }

  /**
   * @param mixed $ad
   */
  public function setAd($ad) {
    $this->ad = $ad->getXml();
  }

}

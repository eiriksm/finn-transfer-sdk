<?php

namespace eiriksm\FinnTransfer;

class FinnMmo implements TransferrableInterface
{

  /**
   * Client.
   *
   * @var \eiriksm\FinnTransfer\ClientInterface
   */
  protected $client;

  protected $images;

  protected $orderNo;

  public function __construct() {
    $this->client = $client;
  }

  /**
   * @return \eiriksm\FinnTransfer\Client
   */
  public function getClient() {
    return $this->client;
  }

  public function transfer(\GuzzleHttp\Client $client) {
    // First get the finn client.
    $this->client = new Client();
    $this->client->setClient($client);
    $req = $this->client->transfer('');
    $body = (string) $req->getBody();
    if (empty($body)) {
      throw new \Exception('Empty body from finn.');
    }
    // Load as xml.
    $xml = simplexml_load_string($body);
    return $xml;
  }


}
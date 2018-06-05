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

  /**
   * Zip file contents.
   *
   * @var string
   */
  protected $zip;

  protected $xml;

  /**
   * @return mixed
   */
  public function getXml() {
    return $this->xml;
  }

  /**
   * @param mixed $xml
   */
  public function setXml($xml) {
    $this->xml = $xml;
  }

  /**
   * @return mixed
   */
  public function getZip() {
    return $this->zip;
  }

  /**
   * @param mixed $zip
   */
  public function setZip($zip) {
    $this->zip = $zip;
  }

  public function __construct() {
    // First get the finn client.
    $this->client = new Client();
    $this->client->setIsZip(true);
  }

  /**
   * @return \eiriksm\FinnTransfer\Client
   */
  public function getClient() {
    return $this->client;
  }

  public function transfer(\GuzzleHttp\Client $client) {
    // First get the finn client.
    $this->client->setRequestBody($this->getXml());
    $this->client->setClient($client);
    if (!$file = file_get_contents($this->zip)) {
      throw new \Exception('Could not open zip file');
    }
    $req = $this->client->transfer($file);
    $body = (string) $req->getBody();
    if (empty($body)) {
      throw new \Exception('Empty body from finn.');
    }
    // Load as xml.
    $xml = simplexml_load_string($body);
    return $xml;
  }


}

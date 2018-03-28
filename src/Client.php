<?php

namespace eiriksm\FinnTransfer;

use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use function GuzzleHttp\Psr7\stream_for;

class Client implements ClientInterface {

  const PROD_URL = 'https://www.finn.no/finn/import/fileimport';

  protected $url = 'https://import.finn.no/finn/import/fileimport';

  private $isZip = false;

  /**
   * @return string
   */
  public function getRequestBody() {
    return $this->requestBody;
  }

  /**
   * @var string
   */
  private $requestBody;

  /**
   * @var Request
   */
  protected $request;

  public function setLiveMode()
  {
    $this->url = self::PROD_URL;
  }

  /**
   * @param string $url
   */
  public function setUrl($url) {
    $this->url = $url;
  }

  /**
   * @var \GuzzleHttp\Client
   */
  protected $client;

  /**
   * @return \eiriksm\FinnTransfer\Client
   */
  public function getClient() {
    return $this->client;
  }

  /**
   * @param mixed $client
   */
  public function setClient($client) {
    $this->client = $client;
  }

  /**
   * Send something.
   *
   * @param string $body
   *
   * @return mixed|\Psr\Http\Message\ResponseInterface
   */
  public function transfer($body) {
    $post_body = stream_for($body);
    $multipart = new MultipartStream([
      [
        'name' => 'fil',
        'contents' => $post_body,
        'filename' => 'file.xml',
      ]
    ]);
    $this->request = new Request('POST', $this->url, [], $multipart);
    if (!$this->isZip) {
      $this->requestBody = $body;
    }
    $res = $this->client->send($this->request);
    return $res;
  }

  /**
   * @return \GuzzleHttp\Psr7\Request
   */
  public function getRequest() {
    return $this->request;
  }
}
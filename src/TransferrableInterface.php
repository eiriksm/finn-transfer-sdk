<?php

namespace eiriksm\FinnTransfer;

interface TransferrableInterface
{
  /**
   * @return \eiriksm\FinnTransfer\Client
   */
    public function getClient();

  /**
   * @param \GuzzleHttp\Client $client
   *
   * @return \SimpleXMLElement
   */
    public function transfer(\GuzzleHttp\Client $client);
}

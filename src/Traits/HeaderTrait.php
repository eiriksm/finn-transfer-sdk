<?php

namespace eiriksm\FinnTransfer\Traits;

trait HeaderTrait
{
  public function createHeader() {
    $head = $this->dom->createElement('HEAD');
    $partner = $this->dom->createElement('PARTNER');
    $partner->nodeValue = $this->partnerId;
    $provider = $this->dom->createElement('PROVIDER');
    $provider->nodeValue = $this->provider;
    $head->appendChild($partner);
    $head->appendChild($provider);
    $this->documentBody->appendChild($head);
  }

}
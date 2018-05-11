<?php

namespace eiriksm\FinnTransfer\Traits;

trait MoreInfoTrait
{

  /**
   * @var \DOMElement
   */
  protected $moreInfoBody;

  protected $moreInfoUrl;

  protected $moreInfoText;

  public function setMoreInfo($url, $text)
  {
    if (!isset($this->moreInfoBody)) {
      $this->createMoreInfoElements();
    }
    $this->moreInfoText->nodeValue = $text;
    $this->moreInfoUrl->nodeValue = $url;
  }

  protected function createMoreInfoElements()
  {
    $this->moreInfoBody = $this->dom->createElement('MOREINFO');
    $this->moreInfoUrl = $this->dom->createElement('URL');
    $this->moreInfoBody->appendChild($this->moreInfoUrl);
    $this->moreInfoText = $this->dom->createElement('URLTEXT');
    $this->moreInfoBody->appendChild($this->moreInfoText);
    $this->adBody->appendChild($this->moreInfoBody);
  }
}

<?php

namespace eiriksm\FinnTransfer;

class XmlBase
{

  protected $provider;
  protected $partnerId;
  protected $dom;
  protected $documentBody;

  public function __construct($partner_id, $provider) {
    $this->provider = $provider;
    $this->partnerId = $partner_id;
    $imp = new \DOMImplementation();
    $dtd = $imp->createDocumentType($this->documentType, '', $this->dtd);
    $this->dom = $imp->createDocument('', '', $dtd);
    $this->dom->encoding = 'UTF-8';
    $this->documentBody = $this->dom->createElement($this->documentType);
    $this->dom->appendChild($this->documentBody);
  }
}
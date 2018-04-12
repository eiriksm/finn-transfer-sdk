<?php

namespace eiriksm\FinnTransfer;

use eiriksm\FinnTransfer\Traits\HeaderTrait;
use eiriksm\FinnTransfer\Traits\ObjectTrait;

class StopXml extends XmlBase
{
  use HeaderTrait;
  use ObjectTrait;

  protected $dtd = 'http://www.iad.no/dtd/IADIF-stop30.dtd';
  protected $documentType = 'IAD.IF.STOP';

  public function __construct($partner_id, $provider)
  {
    parent::__construct($partner_id, $provider);
    $this->createHeader();
    $this->createObject();
  }

  public function setReference($order_no, $user_reference)
  {
    $order_no_el = $this->dom->createElement('ORDERNO');
    $order_no_el->nodeValue = $order_no;
    $this->objectHeadBody->appendChild($order_no_el);
    $user_ref_el = $this->dom->createElement('PROVIDER_REFERENCE');
    $user_ref_el->nodeValue = $user_reference;
    $this->objectHeadBody->appendChild($user_ref_el);
  }
}

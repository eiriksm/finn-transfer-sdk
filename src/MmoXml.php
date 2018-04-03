<?php

namespace eiriksm\FinnTransfer;

use eiriksm\FinnTransfer\Traits\HeaderTrait;
use eiriksm\FinnTransfer\Traits\ObjectTrait;

class MmoXml extends XmlBase
{
    use HeaderTrait;
    use ObjectTrait;

    protected $dtd = 'http://www.finn.no/dtd/IADIF-mmo20.dtd';
    protected $documentType = 'IAD.IF.MMO';

    public function __construct($partner_id, $provider, $order_no) {
      parent::__construct($partner_id, $provider);
      $this->createHeader();
      $this->createObject();
      $order_no_el = $this->dom->createElement('ORDERNO');
      $order_no_el->nodeValue = $order_no;
      $this->objectHeadBody->appendChild($order_no_el);
    }
}
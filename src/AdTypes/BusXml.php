<?php

namespace eiriksm\FinnTransfer\AdTypes;

use eiriksm\FinnTransfer\AdType;
use eiriksm\FinnTransfer\Traits\ModelPropertyTrait;

class BusXml extends AdType
{

  use ModelPropertyTrait;

  protected $dtd = 'http://www.iad.no/dtd/IADIF-bus1.dtd';

  protected $documentType = 'IAD.IF.BUS';

  protected $adBodyTag = 'BUS';

  public function __construct($partner_id, $provider) {
    parent::__construct($partner_id, $provider);
  }

  public function setSegment($segment)
  {
    $this->BUS_SEGMENT = $segment;
    $this->createModelProperty('BUS_MODEL');
    $this->adBody->appendChild($this->modelOuterBody);
  }

}

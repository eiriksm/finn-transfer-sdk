<?php

namespace eiriksm\FinnTransfer\AdTypes;

use eiriksm\FinnTransfer\AdType;
use eiriksm\FinnTransfer\Traits\ModelPropertyTrait;

class VanTruckXml extends AdType
{

  use ModelPropertyTrait;

  protected $dtd = 'http://www.iad.no/dtd/IADIF-van-truck-10.dtd';

  protected $documentType = 'IAD.IF.VAN_TRUCK';

  protected $adBodyTag = 'VAN_TRUCK';

  public function __construct($partner_id, $provider) {
    parent::__construct($partner_id, $provider);
  }

  public function setSegment($segment)
  {
    $this->VAN_SEGMENT = $segment;
    $this->createModelProperty('VAN_MODEL');
    $this->adBody->appendChild($this->modelOuterBody);
  }

}
<?php

namespace eiriksm\FinnTransfer\AdTypes;

use eiriksm\FinnTransfer\AdType;
use eiriksm\FinnTransfer\Traits\ModelPropertyTrait;
use eiriksm\FinnTransfer\Traits\MotorPriceTrait;

class AgriXml extends AdType
{
  use ModelPropertyTrait;
  use MotorPriceTrait {
    setMotorPrice as protected setMotorPriceTrait;
  }

  protected $dtd = 'http://www.iad.no/dtd/IADIF-anlegg-22.dtd';

  protected $documentType = 'IAD.IF.AGRI';

  protected $adBodyTag = 'AGRI';

  public function __construct($partner_id, $provider) {
    parent::__construct($partner_id, $provider);
  }

  public function setSegment($segment)
  {
    $this->TOOLS_CATEGORY = $segment;
    $this->createModelProperty('AGRI_TOOL_MODEL');
    $this->adBody->appendChild($this->modelOuterBody);
  }

  public function setMotorPrice($number, $currency = 'NOK')
  {
    $this->setMotorPriceTrait($number, $currency);
    $this->priceBody->setAttribute('REGISTRATIONTAX_INCLUDED', 'yes');
  }

}

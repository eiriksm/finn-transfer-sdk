<?php

namespace eiriksm\FinnTransfer\AdTypes;

use eiriksm\FinnTransfer\AdType;
use eiriksm\FinnTransfer\Traits\ModelPropertyTrait;
use eiriksm\FinnTransfer\Traits\MotorPriceTrait;

class AgriToolsXml extends AdType
{
  use ModelPropertyTrait;
  use MotorPriceTrait {
    setMotorPrice as protected setMotorPriceTrait;
  }

  protected $dtd = 'http://www.iad.no/dtd/IADIF-agri_tool-23.dtd';

  protected $documentType = 'IAD.IF.AGRI_TOOLS';

  protected $adBodyTag = 'AGRI_TOOLS';

  public function __construct($partner_id, $provider) {
    parent::__construct($partner_id, $provider);
  }

  public function setSegment($segment)
  {
    $this->TOOLS_CATEGORY = $segment;
    $this->createModelProperty('AGRI_TOOL_MODEL');
    $this->adBody->appendChild($this->modelOuterBody);
    $this->YEAR_MODEL = '';
    $this->createMotorPriceElements();
    $this->WEIGHT = '';
    $this->DESCRIPTION = '';
    $this->createMoreInfoElements();
    $this->initializeContact();
  }

  public function &__set($name, $value) {
    if ($name == 'MILEAGE') {
      // Not allowed for this ad type.
      return;
    }
    parent::__set($name, $value);
  }

  public function setMotorPrice($number, $currency = 'NOK')
  {
    $this->setMotorPriceTrait($number, $currency);
    $this->priceBody->setAttribute('REGISTRATIONTAX_INCLUDED', 'yes');
  }

}

<?php

namespace eiriksm\FinnTransfer\AdTypes;

use eiriksm\FinnTransfer\AdType;
use eiriksm\FinnTransfer\Traits\ModelPropertyTrait;
use eiriksm\FinnTransfer\Traits\MotorPriceTrait;

class ThreshingMachineXml extends AdType
{
  use ModelPropertyTrait;

  protected $dtd = 'http://www.iad.no/dtd/IADIF-threshing_machine-21.dtd';

  protected $documentType = 'IAD.IF.THRESHING_MACHINE';

  protected $adBodyTag = 'THRESHING_MACHINE';

  public function __construct($partner_id, $provider) {
    parent::__construct($partner_id, $provider);
    $this->createModelProperty('AGRI_THRESHING_MODEL');
    $this->adBody->appendChild($this->modelOuterBody);
    $this->YEAR_MODEL = '';
    $this->HOURS_USED = '';
    $this->createMotorPriceElements();
    $this->createEngineElements();
    $this->WEIGHT = '';
    $this->TRESHING_MACHINE_EQUIPMENT = '';
    $this->DESCRIPTION = '';
    $this->createMoreInfoElements();
    $this->initializeContact();
  }

  public function setSegment($segment)
  {
    // Empty on purpse. There is no segment.
  }
}

<?php

namespace eiriksm\FinnTransfer\AdTypes;

use eiriksm\FinnTransfer\AdType;
use eiriksm\FinnTransfer\Traits\ModelPropertyTrait;
use eiriksm\FinnTransfer\Traits\MotorPriceTrait;

class AgriXml extends AdType
{
  use ModelPropertyTrait;

  protected $dtd = 'http://www.iad.no/dtd/IADIF-car-agri11.dtd';

  protected $adBodyTag = 'AGRI';

  public function __construct($partner_id, $provider) {
    parent::__construct($partner_id, $provider);
  }

  public function setSegment($segment)
  {
    $this->AGRI_SEGMENT = $segment;
    $this->createModelProperty('AGRI_MODEL');
    $this->adBody->appendChild($this->modelOuterBody);
  }

  /**
   * Magic method to set all properties we want directly on ad body.
   */
  public function &__set($name, $value) {
    if ($name == 'DESCRIPTION') {
      // Append an empty CE_MARKED element. No idea what that means.
      parent::__set('CE_MARKED', '');
    }
    parent::__set($name, $value);
  }

}

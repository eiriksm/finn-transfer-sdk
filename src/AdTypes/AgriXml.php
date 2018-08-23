<?php

namespace eiriksm\FinnTransfer\AdTypes;

use eiriksm\FinnTransfer\AdType;
use eiriksm\FinnTransfer\Traits\ModelPropertyTrait;
use eiriksm\FinnTransfer\Traits\MotorPriceTrait;

class AgriXml extends AdType
{
    use ModelPropertyTrait;

    protected $dtd = 'http://www.iad.no/dtd/IADIF-car-agri12.dtd';

    protected $adBodyTag = 'AGRI';

  /**
   * @var \DOMElement
   */
    private $segmentGroup;

    public function __construct($partner_id, $provider)
    {
        parent::__construct($partner_id, $provider);
        $this->setSegment('');
        $this->createModelProperty('AGRI_MODEL');
        $this->adBody->appendChild($this->modelOuterBody);
        $this->YEAR_MODEL = '';
        $this->createMotorPriceElements();
        $this->createEngineElements();
      // Except this one does not use the "fuel" property.
        $this->engineBody->removeChild($this->engineFuelBody);
        $this->WEIGHT = '';
        $this->SIZE_OF_BOOT = '';
        $this->HOURS_USED = '';
        $this->MAX_SPEED = '';
        $this->CAB = '';
        $this->CHASSIS_VARIANT = '';
        $this->REACH = '';
        $this->LIFT_CAPACITY = '';
        $this->ADDITIONAL_HYDRAULICS = '';
        $this->PERFORMANCE_AUXILLIARY_HYDRAULICS = '';
        $this->TRANSMISSION_SPECIFICATION = '';
        $this->CE_MARKED = '';
        $this->CHASSI = '';
        $this->STATEMENT_OF_COMPLIANCE = '';
        $this->SERVICE_CONTRACT = '';
        $this->WORKLOAD = '';
        $this->CHASSIS_NO = '';
        $this->DESCRIPTION = '';
        $this->createMoreInfoElements();
        $this->initializeContact();
    }


    public function __set($name, $value)
    {
        if ($name == 'MILEAGE') {
          // Not allowed for this ad type.
            return;
        }
        parent::__set($name, $value);
    }

    public function setSegment($segment)
    {
        if (!isset($this->customTags['AGRI_SEGMENT'])) {
            $this->AGRI_SEGMENT = '';
            $this->segmentGroup = $this->dom->createElement('GROUP');
            $segment_type = $this->dom->createElement('TYPE');
            $segment_el = $this->customTags['AGRI_SEGMENT'];
            $segment_el->appendChild($this->segmentGroup);
            $segment_el->appendChild($segment_type);
        }
        $this->segmentGroup->nodeValue = $segment;
    }
}

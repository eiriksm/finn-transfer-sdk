<?php

namespace eiriksm\FinnTransfer\AdTypes;

use eiriksm\FinnTransfer\AdType;
use eiriksm\FinnTransfer\Traits\ModelPropertyTrait;
use eiriksm\FinnTransfer\Traits\MotorPriceTrait;

class TractorXml extends AdType
{
    use ModelPropertyTrait;
    use MotorPriceTrait {
        setMotorPrice as protected setMotorPriceTrait;
    }

    protected $dtd = 'https://www.iad.no/dtd/IADIF-tractor-24.dtd';

    protected $documentType = 'IAD.IF.TRACTOR';

    protected $adBodyTag = 'TRACTOR';

    public function __construct($partner_id, $provider)
    {
        parent::__construct($partner_id, $provider);
        $this->createModelProperty('AGRI_TRACTOR_MODEL');
        $this->adBody->appendChild($this->modelOuterBody);
        $this->YEAR_MODEL = '';
        $this->HOURS_USED = '';
        $this->createMotorPriceElements(true);
        $this->createEngineElements();
        $this->WEIGHT = '';
        // Add the tractor tyre property.
        $ttype_el = $this->dom->createElement('TRACTOR_TYRE');
        $front_tyre_el = $this->dom->createElement('FRONT_TYRES');
        $rear_tyre_el = $this->dom->createElement('REAR_TYRES');
        $ttype_el->appendChild($front_tyre_el);
        $ttype_el->appendChild($rear_tyre_el);
        $this->adBody->appendChild($ttype_el);
        $this->TRACTOR_EQUIPMENT = '';
        $this->DESCRIPTION = '';
        $this->createMoreInfoElements();
        $this->initializeContact();
        $this->VIDEO_URL = '';
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
      // Empty on purpose. There is no segment.
    }

    public function setMotorPrice($number, $currency = 'NOK')
    {
        $this->setMotorPriceTrait($number, $currency);
    }
}

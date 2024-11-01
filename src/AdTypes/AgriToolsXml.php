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
        createMotorPriceElements as protected createMotorPriceElementsTrait;
    }

    protected $dtd = 'https://www.iad.no/dtd/IADIF-agri_tool-26.dtd';

    protected $documentType = 'IAD.IF.AGRI_TOOLS';

    protected $adBodyTag = 'AGRI_TOOLS';

    public function __construct($partner_id, $provider)
    {
        parent::__construct($partner_id, $provider);
        $this->setSegment('');
        $this->createModelProperty('AGRI_TOOL_MODEL');
        $this->adBody->appendChild($this->modelOuterBody);
        $this->YEAR_MODEL = '';
        $this->createMotorPriceElements();
        $this->WEIGHT = '';
        $this->DESCRIPTION = '';
        $this->createMoreInfoElements();
        $this->initializeContact();
        $this->VIDEO_URL = '';
    }

    public function setSegment($segment)
    {
        $this->TOOLS_CATEGORY = $segment;
    }

    public function __set($name, $value)
    {
        if ($name == 'MILEAGE') {
            // Not allowed for this ad type.
            return;
        }
        parent::__set($name, $value);
    }

    public function createMotorPriceElements($vat_attribute = false)
    {
        $this->createMotorPriceElementsTrait(true);
        $this->priceBody->setAttribute('REGISTRATIONTAX_INCLUDED', 'yes');
    }
}

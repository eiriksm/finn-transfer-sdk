<?php

namespace eiriksm\FinnTransfer\AdTypes;

use eiriksm\FinnTransfer\AdType;
use eiriksm\FinnTransfer\Traits\ModelPropertyTrait;
use eiriksm\FinnTransfer\Traits\MotorPriceTrait;

class CaravanXml extends AdType
{
    use ModelPropertyTrait;
    use MotorPriceTrait {
        setMotorPrice as protected setMotorPriceTrait;
        createMotorPriceElements as protected createMotorPriceElementsTrait;
    }

    protected $dtd = 'https://www.iad.no/dtd/IADIF-caravan-29.dtd';

    protected $documentType = 'IAD.IF.CARAVAN';

    protected $adBodyTag = 'CARAVAN';

    protected $weightBody;
    protected $weightNet;
    protected $weightTot;

    public function __construct($partner_id, $provider)
    {
        parent::__construct($partner_id, $provider);
        $this->CARAVAN_SALESFORM = '';
        $this->CARAVAN_SEGMENT = '';
        $this->createModelProperty('CARAVAN_MODEL');
        $this->adBody->appendChild($this->modelOuterBody);
        $this->CARAVAN_LOCATION = '';
        $this->YEAR_MODEL = '';
        $this->MILEAGE = '';
        $this->NO_OF_BERTHS = '';
        $this->WIDTH_CM = '';
        $this->LENGTH_CM = '';
        $this->INTERIOR_LENGTH_CM = '';
        $this->weightBody = $this->dom->createElement('CARAVAN_WEIGHT');
        $this->weightNet = $this->dom->createElement('WEIGHT_NET');
        $this->weightTot = $this->dom->createElement('WEIGHT_TOT');
        $this->weightBody->appendChild($this->weightNet);
        $this->weightBody->appendChild($this->weightTot);
        $this->adBody->appendChild($this->weightBody);
        $this->createMotorPriceElements();
        $reg_el = $this->dom->createElement('REGISTRATION', '0');
        $this->priceBody->appendChild($reg_el);
        $this->CARAVAN_CONDITION = '';
        $this->CARAVAN_WARRANTY = '';
        $this->CARAVAN_EQUIPMENT = '';
        $this->DESCRIPTION = '';
        $this->CARAVAN_CONDITION_REPORT = '';
        $this->CAR_CONDITION_DOC = '';
        $this->createMoreInfoElements();
        $this->initializeContact();
        $this->contactBody->removeAttribute('PHONESALESRESERVATION');
        $this->VIDEO_URL = '';
    }

    public function setContactUrl($url)
    {
    }

    public function createMotorPriceElements($vat_attribute = false)
    {
        $this->createMotorPriceElementsTrait($vat_attribute);
        $this->priceBody->removeChild($this->priceCurrencyBody);
    }

    public function setAdType($type)
    {
        $this->CARAVAN_SALESFORM = $type;
    }

    public function setSegment($segment)
    {
        $this->CARAVAN_SEGMENT = $segment;
    }

    public function setPhoneSalesReservation($reservation = true)
    {
    }
}

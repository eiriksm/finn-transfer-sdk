<?php

namespace eiriksm\FinnTransfer\AdTypes;

use eiriksm\FinnTransfer\AdType;
use eiriksm\FinnTransfer\Traits\ModelPropertyTrait;
use eiriksm\FinnTransfer\Traits\MotorPriceTrait;

class McXml extends AdType
{
    use ModelPropertyTrait;
    use MotorPriceTrait {
        setMotorPrice as protected setMotorPriceTrait;
        createMotorPriceElements as protected createMotorPriceElementsTrait;
    }

    protected $dtd = 'http://www.finn.no/dtd/IADIF-mc76.dtd';

    protected $documentType = 'IAD.IF.MC';

    protected $adBodyTag = 'MC';

    public function __construct($partner_id, $provider)
    {
        parent::__construct($partner_id, $provider);
        $this->MC_CONDITION = '';
        $this->createModelProperty('MC_MODEL');
        $this->adBody->appendChild($this->modelOuterBody);
        $this->MC_MAIN_CATEGORY = '';
        $this->MC_CATEGORY = '';
        $this->YEAR_MODEL = '';
        $this->MILEAGE = '';
        $this->createMotorPriceElements();
        $this->EXTERIOR_COLOUR = '';
        $this->MC_EQUIPMENT = '';
        $this->createEngineElements();
        $this->WEIGHT = '';
        $this->DESCRIPTION = '';
        $this->createMoreInfoElements();
        $this->NO_OF_OWNERS = '';
        $this->REGNO = '';
        $this->MC_WARRANTY = '';
        $this->WARRANTY_DURATION = '';
        $this->WARRANTY_DISTANCE = '';
        $this->MC_CONDITION_REPORT = '';
        $this->VIDEO_URL = '';
        $this->initializeContact();
        $this->contactBody->removeAttribute('PHONESALESRESERVATION');
        $this->contactBody->removeChild($this->contactFaxBody);
        $this->contactBody->removeChild($this->contactURLBody);
    }

    public function setContactFax($fax)
    {
    }

    public function setContactUrl($url)
    {
    }

    public function setMainCategory($value)
    {
        $this->MC_MAIN_CATEGORY = $value;
    }

    public function setMcCategory($value)
    {
        $this->MC_CATEGORY = $value;
    }

    public function createMotorPriceElements($vat_attribute = false)
    {
        $this->createMotorPriceElementsTrait($vat_attribute);
        $this->priceBody->removeChild($this->priceCurrencyBody);
    }

    public function setAdType($type)
    {
        $this->CAR_SALESFORM = $type;
    }

    public function setRegistrationNumber($number)
    {
        $this->REGNO = $number;
    }

    public function setPhoneSalesReservation($reservation = true)
    {
    }
}

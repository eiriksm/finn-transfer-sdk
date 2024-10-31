<?php

namespace eiriksm\FinnTransfer\AdTypes;

use eiriksm\FinnTransfer\AdType;
use eiriksm\FinnTransfer\Traits\ModelPropertyTrait;
use eiriksm\FinnTransfer\Traits\MotorPriceTrait;

class MobileHomeXml extends AdType
{
    use ModelPropertyTrait;
    use MotorPriceTrait {
        setMotorPrice as protected setMotorPriceTrait;
        createMotorPriceElements as protected createMotorPriceElementsTrait;
    }

    protected $dtd = 'https://www.iad.no/dtd/IADIF-mobilehome-12.dtd';

    protected $documentType = 'IAD.IF.MOBILE_HOME';

    protected $adBodyTag = 'MOBILE_HOME';

    protected $weightBody;
    protected $weightNet;
    protected $weightTot;

    public function __construct($partner_id, $provider)
    {
        parent::__construct($partner_id, $provider);

        $this->CARAVAN_SALESFORM = '';
        $this->MOBILE_HOME_SEGMENT = '';
        $this->MOBILE_HOME_CHASSIS = '';

        // Model.
        $this->createModelProperty('CARAVAN_MODEL');
        $this->adBody->appendChild($this->modelOuterBody);

        // Other fields.
        $this->YEAR_MODEL = '';
        $this->MILEAGE = '';
        $this->NO_OF_BERTHS = '';
        $this->BED = '';
        $this->WIDTH_CM = '';
        $this->LENGTH_CM = '';

        // Weight.
        $this->weightBody = $this->dom->createElement('CARAVAN_WEIGHT');
        $this->weightNet = $this->dom->createElement('WEIGHT_NET');
        $this->weightTot = $this->dom->createElement('WEIGHT_TOT');
        $this->weightBody->appendChild($this->weightNet);
        $this->weightBody->appendChild($this->weightTot);
        $this->adBody->appendChild($this->weightBody);

        // Motor and price elements.
        $this->createMotorPriceElements();

        // Registration.
        $reg_el = $this->dom->createElement('REGISTRATION', '0');
        $this->priceBody->appendChild($reg_el);

        // Other fields.
        $this->MOBILE_HOME_EQUIPMENT = '';
        $this->DESCRIPTION = '';
        $this->CARAVAN_CONDITION_REPORT = '';
        $this->CAR_CONDITION_DOC = '';
        $this->createMoreInfoElements();

        // Contact.
        $this->initializeContact();
        $this->contactBody->removeAttribute('PHONESALESRESERVATION');

        // Other fields.
        $this->MOBILE_HOME_LOCATION = '';
        $this->NO_OF_SEATS = '';

        // Engine.
        $this->createEngineElements();
        $this->engineBody->removeChild($this->engineFuelBody);

        // Other fields.
        $this->TRANSMISSION = '';
        $this->WHEEL_DRIVE = '';
        $this->MOBILE_HOME_CONDITION = '';
        $this->MOBILE_HOME_WARRANTY = '';
        $this->WARRANTY_DISTANCE = '';
        $this->REGNO = '';
        $this->NO_OF_OWNERS = '';
        $this->REGISTRATION_FIRST = '';
        $this->VIDEO_URL = '';
    }

    public function createMotorPriceElements($vat_attribute = false)
    {
        $this->createMotorPriceElementsTrait($vat_attribute);
        $this->priceBody->removeChild($this->priceCurrencyBody);
    }

    public function setSegment($segment)
    {
        $this->MOBILE_HOME_SEGMENT = $segment;
    }

    public function setPhoneSalesReservation($reservation = true)
    {
    }
}

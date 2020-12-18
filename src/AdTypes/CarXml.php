<?php

namespace eiriksm\FinnTransfer\AdTypes;

use eiriksm\FinnTransfer\AdType;
use eiriksm\FinnTransfer\Traits\ModelPropertyTrait;
use eiriksm\FinnTransfer\Traits\MotorPriceTrait;

class CarXml extends AdType
{
    use ModelPropertyTrait {
        createModelProperty as public createModelPropertyTrait;
    }
    use MotorPriceTrait {
        setMotorPrice as protected setMotorPriceTrait;
        createMotorPriceElements as protected createMotorPriceElementsTrait;
    }

    protected $dtd = 'https://www.iad.no/dtd/IADIF-car35.dtd';

    protected $documentType = 'IAD.IF.CAR';

    protected $adBodyTag = 'CAR';

    /**
     * @var \DOMElement
     */
    protected $modelSpecBody;

    protected $equipment = [];

    public function __construct($partner_id, $provider)
    {
        parent::__construct($partner_id, $provider);
        $this->createModelProperty('CAR_MODEL');
        $this->CAR_SALESFORM = '';
        $this->REGNO = '';
        $this->CHASSIS_NO = '';
        $this->YEAR_MODEL = '';
        $this->adBody->appendChild($this->modelOuterBody);
        $this->CAR_LOCATION = '';
        $this->createEngineElements();
        $this->CO2 = '';
        $this->BATTERY_CAPACITY = '';
        $this->DRIVING_RANGE = '';
        $this->TRANSMISSION = '';
        $this->TRANSMISSION_SPECIFICATION = '';
        $this->WHEEL_DRIVE = '';
        $this->WHEEL_DRIVE_SPECIFICATION = '';
        $this->BODY_TYPE = '';
        $this->REGISTRATION_CLASS = '';
        $this->NO_OF_SEATS = '';
        $this->NO_OF_DOORS = '';
        $this->SIZE_OF_BOOT = '';
        $this->WEIGHT = '';
        $this->MAX_TRAILER_WEIGHT = '';
        $this->EXTERIOR_COLOUR_MAIN = '';
        $this->EXTERIOR_COLOUR = '';
        $this->INTERIOR_COLOUR = '';
        $this->MILEAGE = '';
        $this->REGISTRATION_FIRST = '';
        $this->NO_OF_OWNERS = '';
        $this->WARRANTY = '';
        $this->WARRANTY_DURATION = '';
        $this->WARRANTY_DISTANCE = '';
        $this->CAR_CONDITION_DOC = '';
        $this->RIGHT_TO_EXCHANGE = '';
        $this->SERVICE_PLAN_FOLLOWED = '';
        $this->CAR_SERVICE_HISTORY = '';
        $this->NBF = '';
        $this->CAR_PREMIUMBRAND = '';
        $this->CAR_PREMIUMBRAND_LINK = '';
        $this->VIDEO_URL = '';
        $this->DESCRIPTION = '';
        $this->createMoreInfoElements();
        $this->createMotorPriceElements();
        $this->initializeContact();
        $this->contactBody->removeAttribute('PHONESALESRESERVATION');
        $this->contactBody->removeChild($this->contactFaxBody);
    }

    public function addEquipment($equipment_value)
    {
        $equipment_el = $this->dom->createElement('EQUIPMENT');
        $equipment_el->nodeValue = $equipment_value;
        $this->equipment[] = $equipment_el;
        $this->customTags['MILEAGE']->parentNode->insertBefore($equipment_el, $this->customTags['MILEAGE']);
    }

    public function createModelProperty($name)
    {
        $this->createModelPropertyTrait($name);
        $this->modelSpecBody = $this->dom->createElement('MODEL_SPECIFICATION');
        $this->modelOuterBody->appendChild($this->modelSpecBody);
    }

    public function setModelSpecification($spec)
    {
        $this->modelSpecBody->nodeValue = $spec;
    }

    public function createMotorPriceElements($vat_attribute = false)
    {
        if (isset($this->customTags['MOTOR_PRICE'])) {
            $this->priceBody = $this->customTags['MOTOR_PRICE'];
        } else {
            $this->priceBody = $this->dom->createElement('MOTOR_PRICE');
            $this->adBody->appendChild($this->priceBody);
        }
        $this->priceNumberBody = $this->dom->createElement('TOTAL');
        $this->priceBody->appendChild($this->priceNumberBody);
        $reg_el = $this->dom->createElement('REGISTRATION', '0');
        $this->priceBody->appendChild($reg_el);
        if ($vat_attribute) {
            $this->includesVat = true;
            $this->priceBody->setAttribute('VAT_INCLUDED', 'yes');
        }
    }

    public function setMotorPrice($number, $currency = 'NOK')
    {
        if (!isset($this->priceBody)) {
            $this->createMotorPriceElements();
        }
        $this->priceNumberBody->nodeValue = $number;
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

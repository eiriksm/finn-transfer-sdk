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

    protected $dtd = 'http://www.finn.no/dtd/IADIF-car33.dtd';

    protected $documentType = 'IAD.IF.CAR';

    protected $adBodyTag = 'CAR';

    /**
     * @var \DOMElement
     */
    protected $modelSpecBody;

    public function __construct($partner_id, $provider)
    {
        parent::__construct($partner_id, $provider);
        $this->createModelProperty('CAR_MODEL');
        $this->adBody->appendChild($this->modelOuterBody);
        $this->YEAR_MODEL = '';
        $this->REGISTRATION_FIRST = '';
        $this->BODY_TYPE = '';
        $this->REGISTRATION_CLASS = '';
        $this->MILEAGE = '';
        $this->createMotorPriceElements();
        $this->EXTERIOR_COLOUR_MAIN = '';
        $this->EXTERIOR_COLOUR = '';
        $this->INTERIOR_COLOUR = '';
        $this->EQUIPMENT = '';
        $this->NO_OF_DOORS = '';
        $this->NO_OF_SEATS = '';
        $this->createEngineElements();
        $this->TRANSMISSION = '';
        $this->SIZE_OF_BOOT = '';
        $this->WEIGHT = '';
        $this->WHEEL_DRIVE = '';
        $this->DESCRIPTION = '';
        $this->createMoreInfoElements();
        $this->NO_OF_OWNERS = '';
        $this->REGNO = '';
        $this->initializeContact();
        $this->contactBody->removeAttribute('PHONESALESRESERVATION');
        $this->CAR_LOCATION = '';
        $this->CAR_SALESFORM = '';
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
        $this->priceCurrencyBody = $this->dom->createElement('CURRENCY');
        $this->priceBody->appendChild($this->priceCurrencyBody);
        if ($vat_attribute) {
            $this->includesVat = true;
            $this->priceBody->setAttribute('VAT_INCLUDED', 'yes');
        }
        $this->priceBody->setAttribute('REGISTRATIONTAX_INCLUDED', 'yes');
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

<?php

namespace eiriksm\FinnTransfer\AdTypes;

use eiriksm\FinnTransfer\AdType;
use eiriksm\FinnTransfer\Traits\ModelPropertyTrait;
use eiriksm\FinnTransfer\Traits\MotorPriceTrait;

class BoatXml extends AdType
{

    protected $dtd = 'http://www.iad.no/dtd/IADIF-boat50.dtd';

    protected $documentType = 'IAD.IF.BOAT';

    protected $adBodyTag = 'BOAT';

    public function __construct($partner_id, $provider)
    {
        parent::__construct($partner_id, $provider);
        $this->BOAT_CLASS = '';
        $this->BOAT_MAKE = '';
        $this->BOAT_MODEL = '';
        $this->LENGTH_CM = '';
        $this->LENGTH_FEET = '';
        $this->YEAR_MODEL = '';
        $this->WIDTH = '';
        $this->DEPTH = '';
        $this->WEIGHT = '';
        $this->REGNO = '';
        $this->EXTERIOR_COLOUR = '';
        $this->MATERIAL = '';
        $this->NO_OF_SEATS = '';
        $this->NO_OF_SLEEPERS = '';
        $this->MOTORMAKE = '';
        $this->MOTORTYPE = '';
        $this->MOTORSIZE = '';
        $this->FUEL = '';
        $this->MOTOR_INCLUDED = '';
        $this->MAX_SPEED = '';
        $this->BOAT_EQUIPMENT = '';
        $this->PRICE = '';
        $this->DESCRIPTION = '';
        $this->createMoreInfoElements();
        $this->initializeContact();
        $this->LIGHTNUMBER = '';
        $this->MOTOR_AD_LOCATION = '';
        $this->VIDEO_URL = '';
    }

    public function setMotorPrice($number, $currency = 'NOK') {
    }

    public function setIncludingMva($includes) {
    }
}

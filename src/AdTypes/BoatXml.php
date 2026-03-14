<?php

namespace eiriksm\FinnTransfer\AdTypes;

use eiriksm\FinnTransfer\AdType;
use eiriksm\FinnTransfer\Traits\PriceTrait;

class BoatXml extends AdType
{
    use PriceTrait;

    protected $dtd = 'https://www.iad.no/dtd/IADIF-boat52.dtd';

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

        // Price.
        $this->createPriceElements();

        $this->DESCRIPTION = '';

        // More info.
        $this->createMoreInfoElements();

        // Contact.
        $this->initializeContact();

        $this->LIGHTNUMBER = '';
        $this->MOTOR_AD_LOCATION = '';
        $this->VIDEO_URL = '';
    }

    public function setSegment($segment)
    {
        $this->BOAT_CLASS = $segment;
    }

    public function setMake($make)
    {
        $this->BOAT_MAKE = $make;
    }
}

<?php

namespace eiriksm\FinnTransfer\AdTypes;

use eiriksm\FinnTransfer\AdType;
use eiriksm\FinnTransfer\Traits\PriceTrait;

class BoatMotorXml extends AdType
{
    use PriceTrait;

    protected $dtd = 'https://www.iad.no/dtd/IADIF-boat_motor23.dtd';

    protected $documentType = 'IAD.IF.BOAT_MOTOR';

    protected $adBodyTag = 'BOAT_MOTOR';

    public function __construct($partner_id, $provider)
    {
        parent::__construct($partner_id, $provider);
        $this->BOATMOTOR_CATEGORY = '';
        $this->MOTORTYPE = '';
        $this->MOTORMAKE = '';
        $this->MOTORSIZE = '';

        // Price.
        $this->createPriceElements();
        $this->priceBody->removeChild($this->priceCurrencyBody);

        // Other fields.
        $this->DESCRIPTION = '';
        $this->VIDEO_URL = '';

        // More info.
        $this->createMoreInfoElements();

        // Contact.
        $this->initializeContact();
        $this->contactBody->removeAttribute('PHONESALESRESERVATION');
    }

    public function setSegment($segment)
    {
        $this->BOATMOTOR_CATEGORY = $segment;
    }

    public function setMake($make)
    {
        $this->MOTORTYPE = $make;
    }

    public function setPhoneSalesReservation($reservation = true)
    {
    }

}

<?php

namespace eiriksm\FinnTransfer\AdTypes;

use eiriksm\FinnTransfer\AdType;
use eiriksm\FinnTransfer\Traits\PriceTrait;

class MotorMiscXml extends AdType
{
    use PriceTrait;

    protected $dtd = 'https://www.iad.no/dtd/IADIF-motor_misc51.dtd';

    protected $documentType = 'IAD.IF.MOTORMISC';

    protected $adBodyTag = 'MOTORMISC';

    public function __construct($partner_id, $provider)
    {
        parent::__construct($partner_id, $provider);

        $this->MOTORMISC_CATEGORY = '';
        $this->DESCRIPTION = '';

        // More info.
        $this->createMoreInfoElements();

        // Price.
        $this->createPriceElements();

        // Contact.
        $this->initializeContact();
    }

    public function setSegment($segment)
    {
        $this->MOTORMISC_CATEGORY = $segment;
    }
}

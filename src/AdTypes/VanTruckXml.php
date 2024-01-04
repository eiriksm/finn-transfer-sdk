<?php

namespace eiriksm\FinnTransfer\AdTypes;

use eiriksm\FinnTransfer\AdType;
use eiriksm\FinnTransfer\Traits\InteriorMeasurementsTrait;
use eiriksm\FinnTransfer\Traits\ModelPropertyTrait;

class VanTruckXml extends AdType
{

    use ModelPropertyTrait;
    use InteriorMeasurementsTrait;

    protected $dtd = 'http://www.iad.no/dtd/IADIF-van-truck-10.dtd';

    protected $documentType = 'IAD.IF.VAN_TRUCK';

    protected $adBodyTag = 'VAN_TRUCK';

    public function __construct($partner_id, $provider)
    {
        parent::__construct($partner_id, $provider);
        $this->setSegment('');
        $this->createModelProperty('VAN_MODEL');
        $this->adBody->appendChild($this->modelOuterBody);
        $this->YEAR_MODEL = '';
        $this->MILEAGE = '';
        $this->createMotorPriceElements();
        $this->createEngineElements();
        $this->WEIGHT = '';
        $this->REGISTRATION_FIRST = '';
        $this->NO_OF_SEATS = '';
        $this->VAN_EQUIPMENT = '';
        $this->LENGTH_CM = '';
        $this->TRANSMISSION_SPECIFICATION = '';
        $this->CABIN_TYPE = '';
        $this->PERMITTED_LOAD = '';
        $this->REGNO = '';
        $this->EU_APPROVED = '';
        $this->SUSPENSION_FRONT = '';
        $this->SUSPENSION_REAR = '';
        $this->TYPE_OF_AXLE = '';
        $this->WHEELBASE = '';
        $this->EXTRA_BRAKE = '';
        $this->CHASSIS_NO = '';
        $this->BOX_TYPE = '';
        $this->BOX_LENGTH = '';
        $this->createInteriorMeasurementsElements();
        $this->TAILLIFT = '';
        $this->DESCRIPTION = '';
        $this->createMoreInfoElements();
        $this->initializeContact();
        $this->CAR_LOCATION = '';
        $this->PALLET = '';
    }

    public function setSegment($segment)
    {
        $this->VAN_SEGMENT = $segment;
    }
}

<?php

namespace eiriksm\FinnTransfer\AdTypes;

use eiriksm\FinnTransfer\AdType;
use eiriksm\FinnTransfer\Traits\InteriorMeasurementsTrait;
use eiriksm\FinnTransfer\Traits\ModelPropertyTrait;

class BusXml extends AdType
{

    use ModelPropertyTrait;
    use InteriorMeasurementsTrait;

    protected $dtd = 'https://www.iad.no/dtd/IADIF-bus5.dtd';

    protected $documentType = 'IAD.IF.BUS';

    protected $adBodyTag = 'BUS';

    public function __construct($partner_id, $provider)
    {
        parent::__construct($partner_id, $provider);
        $this->setSegment('');
        $this->createModelProperty('BUS_MODEL');
        $this->adBody->appendChild($this->modelOuterBody);
        $this->YEAR_MODEL = '';
        $this->MILEAGE = '';
        $this->createMotorPriceElements();
        $this->createEngineElements();
        $this->WEIGHT = '';
        $this->REGISTRATION_FIRST = '';
        $this->NO_OF_SEATS = '';
        $this->BUS_EQUIPMENT = '';
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
        $this->VIDEO_URL = '';
    }

    public function setSegment($segment)
    {
        $this->BUS_SEGMENT = $segment;
    }

    public function addEquipment($equipment_items)
    {
        // Remove initial empty tag.
        $this->customTags['BUS_EQUIPMENT']->remove();
        foreach ($equipment_items as $equipment_value) {
            $equipment_el = $this->dom->createElement('BUS_EQUIPMENT');
            $equipment_el->nodeValue = $equipment_value;
            $this->equipment[] = $equipment_el;
            $this->customTags['LENGTH_CM']->parentNode->insertBefore($equipment_el, $this->customTags['LENGTH_CM']);
        }
    }
}

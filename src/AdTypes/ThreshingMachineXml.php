<?php

namespace eiriksm\FinnTransfer\AdTypes;

use eiriksm\FinnTransfer\AdType;
use eiriksm\FinnTransfer\Traits\ModelPropertyTrait;

class ThreshingMachineXml extends AdType
{
    use ModelPropertyTrait;

    protected $dtd = 'https://www.iad.no/dtd/IADIF-threshing_machine-24.dtd';

    protected $documentType = 'IAD.IF.THRESHING_MACHINE';

    protected $adBodyTag = 'THRESHING_MACHINE';

    public function __construct($partner_id, $provider)
    {
        parent::__construct($partner_id, $provider);
        $this->createModelProperty('AGRI_THRESHING_MODEL');
        $this->adBody->appendChild($this->modelOuterBody);
        $this->YEAR_MODEL = '';
        $this->HOURS_USED = '';
        $this->createMotorPriceElements(true);
        $this->createEngineElements();
        $this->WEIGHT = '';
        $this->TRESHING_MACHINE_EQUIPMENT = '';
        $this->DESCRIPTION = '';
        $this->createMoreInfoElements();
        $this->initializeContact();
        $this->VIDEO_URL = '';
    }

    public function __set($name, $value)
    {
        if ($name == 'MILEAGE') {
          // Not allowed for this ad type.
            return;
        }
        parent::__set($name, $value);
    }

    public function setSegment($segment)
    {
      // Empty on purpose. There is no segment.
    }

    public function addEquipment($equipment_items)
    {
        // Remove initial empty tag.
        $this->customTags['TRESHING_MACHINE_EQUIPMENT']->remove();
        foreach ($equipment_items as $equipment_value) {
            $equipment_el = $this->dom->createElement('TRESHING_MACHINE_EQUIPMENT');
            $equipment_el->nodeValue = $equipment_value;
            $this->equipment[] = $equipment_el;
            $this->customTags['DESCRIPTION']->parentNode->insertBefore($equipment_el, $this->customTags['DESCRIPTION']);
        }
    }
}

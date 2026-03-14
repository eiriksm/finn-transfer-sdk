<?php

namespace eiriksm\FinnTransfer\Tests\AdTypes;

use eiriksm\FinnTransfer\AdType;
use eiriksm\FinnTransfer\AdTypes\ThreshingMachineXml;

class ThreshingMachineXmlTest extends AdTypeTestBase
{

    protected $className = ThreshingMachineXml::class;

    public function testAddEquipment()
    {
        $partner_id = 'test';
        $provider = 'test';
        $class = new ThreshingMachineXml($partner_id, $provider);
        $class->addEquipment(['test']);
        $this->assertTrue($class instanceof AdType);
        $xml = $class->getXml();
        $this->assertNotFalse($xml);
    }
}

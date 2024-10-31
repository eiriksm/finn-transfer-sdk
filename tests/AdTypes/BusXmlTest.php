<?php

namespace eiriksm\FinnTransfer\Tests\AdTypes;

use eiriksm\FinnTransfer\AdType;
use eiriksm\FinnTransfer\AdTypes\BusXml;

class BusXmlTest extends AdTypeTestBase
{

    protected $className = BusXml::class;

    public function testAddEquipment()
    {
        $partner_id = 'test';
        $provider = 'test';
        $class = new BusXml($partner_id, $provider);
        $class->addEquipment(['test']);
        $this->assertTrue($class instanceof AdType);
        $xml = $class->getXml();
        $this->assertNotFalse($xml);
    }
}

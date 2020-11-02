<?php

namespace eiriksm\FinnTransfer\Tests\AdTypes;

use eiriksm\FinnTransfer\AdType;
use PHPUnit\Framework\TestCase;

class AdTypeTestBase extends TestCase
{

    protected $className;

    /**
     * Test that we can instantiate without error.
     */
    public function testConstructor()
    {
        $partner_id = 'test';
        $provider = 'test';
        /** @var AdType $class */
        $class = new $this->className($partner_id, $provider);
        $this->assertTrue($class instanceof AdType);
        $this->assertNotFalse($class->getXml());
    }
}

<?php

namespace eiriksm\FinnTransfer\Traits;

trait EngineTrait
{

    /**
     * @var \DOMElement
     */
    protected $engineBody;

    /**
     * @var \DOMElement
     */
    protected $engineFuelBody;

    /**
     * @var \DOMElement
     */
    protected $engineVolumeBody;

    /**
     * @var \DOMElement
     */
    protected $engineEffectBody;

    public function setEngine()
    {
        // Not sure how to use this yet.
        if (!isset($this->engineBody)) {
            $this->createEngineElements();
        }
    }

    protected function createEngineElements()
    {
        $this->engineBody = $this->dom->createElement('ENGINE');
        $this->engineFuelBody = $this->dom->createElement('FUEL');
        $this->engineVolumeBody = $this->dom->createElement('VOLUME');
        $this->engineEffectBody = $this->dom->createElement('EFFECT');
        $this->engineBody->appendChild($this->engineEffectBody);
        $this->engineBody->appendChild($this->engineVolumeBody);
        $this->engineBody->appendChild($this->engineFuelBody);
        $this->adBody->appendChild($this->engineBody);
    }

    public function setEngineFuel($fuel)
    {
        $this->engineFuelBody->nodeValue = $fuel;
    }

    public function setEngineVolume($volume)
    {
       $this->engineVolumeBody->nodeValue = $volume;
    }
}

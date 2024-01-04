<?php

namespace eiriksm\FinnTransfer\Traits;

trait InteriorMeasurementsTrait
{

    /**
     * @var \DOMElement
     */
    protected $interiorMeasurementsBody;

    /**
     * @var \DOMElement
     */
    protected $interiorMeasurementsLengthBody;

    /**
     * @var \DOMElement
     */
    protected $interiorMeasurementsWidthBody;

    /**
     * @var \DOMElement
     */
    protected $interiorMeasurementsHeightBody;

    protected function createInteriorMeasurementsElements()
    {
        if (!isset($this->interiorMeasurementsBody)) {
            $this->interiorMeasurementsBody = $this->dom->createElement('INTERIOR_MEASUREMENTS');

            $this->interiorMeasurementsLengthBody = $this->dom->createElement('LENGTH');
            $this->interiorMeasurementsBody->appendChild($this->interiorMeasurementsLengthBody);

            $this->interiorMeasurementsWidthBody = $this->dom->createElement('WIDTH');
            $this->interiorMeasurementsBody->appendChild($this->interiorMeasurementsWidthBody);

            $this->interiorMeasurementsHeightBody = $this->dom->createElement('HEIGHT');
            $this->interiorMeasurementsBody->appendChild($this->interiorMeasurementsHeightBody);

            $this->adBody->appendChild($this->interiorMeasurementsBody);
        }
    }

    public function setInteriorMeasurements()
    {
        $this->createInteriorMeasurementsElements();
    }

    public function setInteriorMeasurementsLength($length)
    {
        $this->interiorMeasurementsLengthBody->nodeValue = $length;
    }

    public function setInteriorMeasurementsWidth($width)
    {
        $this->interiorMeasurementsWidthBody->nodeValue = $width;
    }

    public function setInteriorMeasurementsHeight($height)
    {
        $this->interiorMeasurementsHeightBody->nodeValue = $height;
    }
}

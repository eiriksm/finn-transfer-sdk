<?php

namespace eiriksm\FinnTransfer\Traits;

trait ObjectTrait
{

  /**
   * @var \DOMElement
   */
    protected $objectBody;

  /**
   * @var \DOMElement
   */
    protected $objectHeadBody;

    public function createObject()
    {
        $this->objectBody = $this->dom->createElement('OBJECT');
        $this->documentBody->appendChild($this->objectBody);
        $this->createObjectHead();
    }

    public function createObjectHead()
    {
        $this->objectHeadBody = $this->dom->createElement('OBJECT_HEAD');
        $this->objectBody->appendChild($this->objectHeadBody);
    }
}

<?php

namespace eiriksm\FinnTransfer\Traits;

trait SegmentPropertyTrait
{

  /**
   * @var \DOMDocument
   */
    protected $segmentOuterBody;

    protected $segmentGroup;

    protected $segmentGroupBody;

    protected $segmentType;

    protected $segmentTypeBody;

  /**
   * @param mixed $group
   */
    public function setSegmentGroup($group)
    {
        $this->segmentGroup = $group;
        $this->segmentGroupBody->nodeValue = $group;
    }

  /**
   * @param mixed $type
   */
    public function setSegmentType($type)
    {
        $this->segmentType = $type;
        $this->segmentTypeBody->nodeValue = $type;
    }

    public function createSegmentProperty($name)
    {
        $this->segmentOuterBody = $this->dom->createElement($name);

        $this->segmentGroupBody = $this->dom->createElement('GROUP');
        $this->segmentOuterBody->appendChild($this->segmentGroupBody);

        $this->segmentTypeBody = $this->dom->createElement('TYPE');
        $this->segmentOuterBody->appendChild($this->segmentTypeBody);
    }

}

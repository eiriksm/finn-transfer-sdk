<?php

namespace eiriksm\FinnTransfer\Traits;

trait EngineTrait
{
  protected $engineBody;

  protected $engineFuelBody;

  public function setEngine() {
    // Not sure how to use this yet.
    if (!isset($this->engineBody)) {
      $this->engineBody = $this->dom->createElement('ENGINE');
      $this->engineFuelBody = $this->dom->createElement('FUEL');
      $this->engineBody->appendChild($this->engineFuelBody);
      $this->adBody->appendChild($this->engineBody);
    }
  }
}
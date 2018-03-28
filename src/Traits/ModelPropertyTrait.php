<?php

namespace eiriksm\FinnTransfer\Traits;

trait ModelPropertyTrait
{

  protected $modelPropertyName;

  /**
   * @var \DOMDocument
   */
  protected $modelOuterBody;

  protected $makeBody;

  protected $modelBody;

  protected $model;

  protected $make;

  /**
   * @param mixed $model
   */
  public function setModel($model) {
    $this->model = $model;
    $this->modelBody->nodeValue = $model;
  }

  /**
   * @param mixed $make
   */
  public function setMake($make) {
    $this->make = $make;
    $this->makeBody->nodeValue = $make;
  }

  public function createModelProperty($name) {
    $this->modelOuterBody = $this->dom->createElement($name);
    $this->makeBody = $this->dom->createElement('MAKE');
    $this->modelOuterBody->appendChild($this->makeBody);
    $this->modelBody = $this->dom->createElement('MODEL');
    $this->modelOuterBody->appendChild($this->modelBody);
  }
}
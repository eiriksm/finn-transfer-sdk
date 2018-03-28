<?php

namespace eiriksm\FinnTransfer\Traits;

trait MotorPriceTrait
{
  protected $priceBody;

  protected $priceNumberBody;

  protected $priceCurrencyBody;

  public function setMotorPrice($number, $currency = 'NOK') {
    if (!isset($this->priceBody)) {
      $this->priceBody = $this->dom->createElement('MOTOR_PRICE');
      $this->priceNumberBody = $this->dom->createElement('TOTAL');
      $this->priceBody->appendChild($this->priceNumberBody);
      $this->priceCurrencyBody = $this->dom->createElement('CURRENCY');
      $this->priceBody->appendChild($this->priceCurrencyBody);
      $this->adBody->appendChild($this->priceBody);
    }
    $this->priceNumberBody->nodeValue = $number;
    $this->priceCurrencyBody->nodeValue = $currency;
  }
}
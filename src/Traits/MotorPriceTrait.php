<?php

namespace eiriksm\FinnTransfer\Traits;

trait MotorPriceTrait
{

  /**
   * @var \DOMElement
   */
    protected $priceBody;

    protected $priceNumberBody;

    protected $priceCurrencyBody;

    public function setMotorPrice($number, $currency = 'NOK')
    {
        if (!isset($this->priceBody)) {
            $this->createMotorPriceElements();
        }
        $this->priceNumberBody->nodeValue = $number;
        $this->priceCurrencyBody->nodeValue = $currency;
    }

    protected function createMotorPriceElements()
    {
        if (isset($this->customTags['MOTOR_PRICE'])) {
            $this->priceBody = $this->customTags['MOTOR_PRICE'];
        } else {
            $this->priceBody = $this->dom->createElement('MOTOR_PRICE');
            $this->adBody->appendChild($this->priceBody);
        }
        $this->priceNumberBody = $this->dom->createElement('TOTAL');
        $this->priceBody->appendChild($this->priceNumberBody);
        $this->priceCurrencyBody = $this->dom->createElement('CURRENCY');
        $this->priceBody->appendChild($this->priceCurrencyBody);
    }
}

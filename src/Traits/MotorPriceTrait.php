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

    protected $includesVat = false;

    public function setMotorPrice($number, $currency = 'NOK')
    {
        if (!isset($this->priceBody)) {
            $this->createMotorPriceElements();
        }
        $this->priceNumberBody->nodeValue = $number;
        $this->priceCurrencyBody->nodeValue = $currency;
    }

    public function setIncludingMva($includes)
    {
        if (!$this->priceBody->hasAttribute('VAT_INCLUDED')) {
            return;
        }
        $this->includesVat = (bool) $includes;
        $includes ? $this->priceBody->setAttribute('VAT_INCLUDED', 'yes') : $this->priceBody->setAttribute('VAT_INCLUDED', 'no');
        return $this;
    }

    protected function createMotorPriceElements($vat_attribute = false)
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
        if ($vat_attribute) {
          $this->includesVat = true;
          $this->priceBody->setAttribute('VAT_INCLUDED', 'yes');
        }
    }
}

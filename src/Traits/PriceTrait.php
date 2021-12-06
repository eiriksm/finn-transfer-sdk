<?php

namespace eiriksm\FinnTransfer\Traits;

trait PriceTrait
{

    /**
     * @var \DOMElement
     */
    protected $priceBody;

    protected $priceAmountBody;

    protected $priceCurrencyBody;


    public function setPrice($number, $currency = 'NOK')
    {
        if (!isset($this->priceBody)) {
            $this->createPriceElements();
        }
        $this->priceAmountBody->nodeValue = $number;
        $this->priceCurrencyBody->nodeValue = $currency;
    }

    protected function createPriceElements()
    {
        if (!isset($this->priceBody)) {
            $this->priceBody = $this->dom->createElement('PRICE');
            $this->priceAmountBody = $this->dom->createElement('AMOUNT');
            $this->priceBody->appendChild($this->priceAmountBody);
            $this->priceCurrencyBody = $this->dom->createElement('CURRENCY');
            $this->priceBody->appendChild($this->priceCurrencyBody);
            $this->adBody->appendChild($this->priceBody);
        }
    }
}

<?php

namespace eiriksm\FinnTransfer;

use eiriksm\FinnTransfer\Traits\ContactTrait;
use eiriksm\FinnTransfer\Traits\EngineTrait;
use eiriksm\FinnTransfer\Traits\HeaderTrait;
use eiriksm\FinnTransfer\Traits\MoreInfoTrait;
use eiriksm\FinnTransfer\Traits\MotorPriceTrait;
use eiriksm\FinnTransfer\Traits\ObjectTrait;

abstract class AdType extends XmlBase implements AdTypeInterface
{
    use MotorPriceTrait;
    use EngineTrait;
    use MoreInfoTrait;
    use ContactTrait;
    use HeaderTrait;
    use ObjectTrait {
        createObjectHead as protected createObjectHeadTrait;
    }

    protected $adBodyTag;

    protected $objectHeadOrderNo;

    protected $objectHeadUserReference;

    protected $objectHeadProviderReference;

    /**
     * @var \DOMElement
     */
    protected $objectHeadOverWriteMmo;

    protected $objectHeadVersionNo;

    protected $objectHeadFromDate;

    protected $objectHeadToDate;

    protected $objectHeadLocation;

    protected $objectHeadLocationZipcode;

    protected $objectHeadLocationCountryCode;

    protected $objectHeadLocationAddress2;

    protected $objectHeadLocationAddress3;

    protected $objectHeadLocationAddress4;

    protected $objectHeadHeading;

    protected $objectHeadSegment;

    protected $partnerId;

    protected $provider;

    protected $orderNo;

    protected $userReference;

    protected $fromDate;

    protected $toDate;

    protected $zipCode;

    protected $countryCode;

    protected $address2;

    protected $address3;

    protected $address4;

    protected $heading;

    protected $adBody;

  /**
   * @var \DOMElement[]
   */
    protected $customTags;

    /**
     * {@inheritdoc}
     */
    public function setEngineEffect($effect)
    {
        if (empty($this->engineEffectBody)) {
            return;
        }
        $this->engineEffectBody->nodeValue = $effect;
    }

  /**
   * @param mixed $orderNo
   */
    public function setOrderNo($orderNo)
    {
        $this->orderNo = $orderNo;
        $this->objectHeadOrderNo->nodeValue = $orderNo;
    }

  /**
   * @param mixed $userReference
   */
    public function setUserReference($userReference)
    {
        $this->userReference = $userReference;
        $this->objectHeadUserReference->nodeValue = $userReference;
    }

  /**
   * @param mixed $fromDate
   */
    public function setFromDate($fromDate)
    {
        $this->fromDate = $fromDate;
        $this->objectHeadFromDate->nodeValue = $fromDate;
    }

  /**
   * @param mixed $toDate
   */
    public function setToDate($toDate)
    {
        $this->toDate = $toDate;
        $this->objectHeadToDate->nodeValue = $toDate;
    }

  /**
   * @param mixed $zipCode
   */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
        $this->objectHeadLocationZipcode->nodeValue = $zipCode;
    }

    public function setAddress2($address)
    {
        $this->address2 = $address;
        $this->objectHeadLocationAddress2->nodeValue = $address;
    }

    public function setAddress3($address)
    {
        $this->address3 = $address;
        $this->objectHeadLocationAddress3->nodeValue = $address;
    }

    public function setAddress4($address)
    {
        $this->address4 = $address;
        $this->objectHeadLocationAddress4->nodeValue = $address;
    }

  /**
   * @param mixed $countryCode
   */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
        $this->objectHeadLocationCountryCode->nodeValue = $countryCode;
    }

  /**
   * @param mixed $heading
   */
    public function setHeading($heading)
    {
        $this->heading = $heading;
        $this->objectHeadHeading->nodeValue = $heading;
    }

    public function __construct($partner_id, $provider)
    {
        parent::__construct($partner_id, $provider);
        $this->adBody = $this->dom->createElement($this->adBodyTag);
        $this->createHeader();
        $this->createObject();
        $this->objectBody->appendChild($this->adBody);
    }

  /**
   * Magic method to set all properties we want directly on ad body.
   */
    public function __set($name, $value)
    {
        if ($name === 'DESCRIPTION') {
           // This is CDATA for sure.
            $value = $this->dom->createCDATASection($value);
        }
        if (!isset($this->customTags[$name])) {
            $this->customTags[$name] = $this->dom->createElement($name);
            $this->adBody->appendChild($this->customTags[$name]);
        }
        if ($name === 'DESCRIPTION') {
           // This is CDATA for sure.
            $this->customTags[$name]->appendChild($value);
        } else {
            $this->customTags[$name]->nodeValue = $value;
        }
    }

    public function hasCustomTag($name)
    {
        return isset($this->customTags[$name]);
    }

    public function createObjectHead()
    {
        $this->createObjectHeadTrait();
        $mappings = [
            'ORDERNO' => 'objectHeadOrderNo',
            'USER_REFERENCE' => 'objectHeadUserReference',
            'PROVIDER_REFERENCE' => 'objectHeadProviderReference',
            'OVERWRITE_MMO' => 'objectHeadOverWriteMmo',
            'VERSIONNO' => 'objectHeadVersionNo',
            'FROMDATE' => 'objectHeadFromDate',
            'TODATE' => 'objectHeadToDate',
            'OBJECT_LOCATION' => 'objectHeadLocation',
            'HEADING' => 'objectHeadHeading',
        ];
        foreach ($mappings as $field => $property) {
            $this->{$property} = $this->dom->createElement($field);
            $this->objectHeadBody->appendChild($this->{$property});
        }
        // Overwrite mmo is empty, but has a property.
        $this->objectHeadOverWriteMmo->setAttribute('MODUS', 'all');
        // Also, create the children of the location.
        $this->objectHeadLocationZipcode = $this->dom->createElement('ZIPCODE');
        $this->objectHeadLocation->appendChild($this->objectHeadLocationZipcode);
        $this->objectHeadLocationCountryCode = $this->dom->createElement('COUNTRYCODE');
        $this->objectHeadLocation->appendChild($this->objectHeadLocationCountryCode);
        foreach ([2, 3, 4] as $address_item) {
            $key = 'objectHeadLocationAddress' . $address_item;
            $this->{$key} = $this->dom->createElement('ADDRESS' . $address_item);
            $this->objectHeadLocation->appendChild($this->{$key});
        }
        $this->objectBody->appendChild($this->objectHeadBody);
    }
}

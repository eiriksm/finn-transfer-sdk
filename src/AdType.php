<?php

namespace eiriksm\FinnTransfer;

use eiriksm\FinnTransfer\Traits\ContactTrait;
use eiriksm\FinnTransfer\Traits\EngineTrait;
use eiriksm\FinnTransfer\Traits\MoreInfoTrait;
use eiriksm\FinnTransfer\Traits\MotorPriceTrait;

abstract class AdType extends XmlBase implements AdTypeInterface
{
  use MotorPriceTrait;
  use EngineTrait;
  use MoreInfoTrait;
  use ContactTrait;

  protected $adBodyTag;

  protected $dtd;

  protected $dom;

  protected $documentType;

  protected $documentBody;

  protected $objectBody;

  protected $objectHeadBody;

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

  protected $heading;

  protected $adBody;

  /**
   * @param mixed $orderNo
   */
  public function setOrderNo($orderNo) {
    $this->orderNo = $orderNo;
    $this->objectHeadOrderNo->nodeValue = $orderNo;
  }

  /**
   * @param mixed $userReference
   */
  public function setUserReference($userReference) {
    $this->userReference = $userReference;
    $this->objectHeadUserReference->nodeValue = $userReference;
  }

  /**
   * @param mixed $fromDate
   */
  public function setFromDate($fromDate) {
    $this->fromDate = $fromDate;
    $this->objectHeadFromDate->nodeValue = $fromDate;
  }

  /**
   * @param mixed $toDate
   */
  public function setToDate($toDate) {
    $this->toDate = $toDate;
    $this->objectHeadToDate->nodeValue = $toDate;
  }

  /**
   * @param mixed $zipCode
   */
  public function setZipCode($zipCode) {
    $this->zipCode = $zipCode;
    $this->objectHeadLocationZipcode->nodeValue = $zipCode;
  }

  /**
   * @param mixed $countryCode
   */
  public function setCountryCode($countryCode) {
    $this->countryCode = $countryCode;
    $this->objectHeadLocationCountryCode->nodeValue = $countryCode;
  }

  /**
   * @param mixed $heading
   */
  public function setHeading($heading) {
    $this->heading = $heading;
  }

  public function __construct($partner_id, $provider) {
    parent::__construct($partner_id, $provider);
    $this->adBody = $this->dom->createElement($this->adBodyTag);
    $this->createHeader();
    $this->createObject();
    $this->objectBody->appendChild($this->adBody);
  }

  /**
   * Magic method to set all properties we want directly on ad body.
   */
  public function &__set($name, $value) {
    if (!isset($this->customTags[$name])) {
      $this->customTags[$name] = $this->dom->createElement($name);
      $this->adBody->appendChild($this->customTags[$name]);
    }
    $this->customTags[$name]->nodeValue = $value;
  }

  public function createObject()
  {
    $this->objectBody = $this->dom->createElement('OBJECT');
    $this->documentBody->appendChild($this->objectBody);
    $this->createObjectHead();
  }

  public function createObjectHead()
  {
    $this->objectHeadBody = $this->dom->createElement('OBJECT_HEAD');
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
    $this->objectBody->appendChild($this->objectHeadBody);
  }

  public function createHeader() {
    $head = $this->dom->createElement('HEAD');
    $partner = $this->dom->createElement('PARTNER');
    $partner->nodeValue = $this->partnerId;
    $provider = $this->dom->createElement('PROVIDER');
    $provider->nodeValue = $this->provider;
    $head->appendChild($partner);
    $head->appendChild($provider);
    $this->documentBody->appendChild($head);
  }

  public function getXml() {
    // @todo: Maybe throw an exception if not valid?
    $valid = @$this->dom->validate();
    return $this->dom->saveXML();
  }
}
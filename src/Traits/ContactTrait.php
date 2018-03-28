<?php

namespace eiriksm\FinnTransfer\Traits;

trait ContactTrait
{

  /**
   * @var \DOMElement
   */
  protected $contactBody;

  protected $contactNameBody;

  protected $contactPhoneBody;

  protected $contactMobileBody;

  protected $contactEmailBody;

  protected $contactFaxBody;

  protected $contactURLBody;

  public function setPhoneSalesReservation($reservation = TRUE)
  {
    $this->initializeContact();
    $this->contactBody->setAttribute('PHONESALESRESERVATION', $reservation ? 'yes' : 'no');
  }

  public function setContactName($name)
  {
    $this->initializeContact();
    $this->contactNameBody->nodeValue = $name;
  }

  public function setContactPhone($phone)
  {
    $this->initializeContact();
    $this->contactPhoneBody->nodeValue = $phone;
  }

  public function setContactMobile($mobile)
  {
    $this->initializeContact();
    $this->contactMobileBody->nodeValue = $mobile;
  }

  public function setContactEmail($email)
  {
    $this->initializeContact();
    $this->contactEmailBody->nodeValue = $email;
  }

  public function setContactFax($fax)
  {
    $this->initializeContact();
    $this->contactFaxBody->nodeValue = $fax;
  }

  public function setContactUrl($url)
  {
    $this->initializeContact();
    $this->contactURLBody->nodeValue = $url;
  }

  private function initializeContact()
  {
    if (!isset($this->contactBody)) {
      $this->contactBody = $this->dom->createElement('CONTACT');
      $this->contactBody->setAttribute('PHONESALESRESERVATION', 'yes');
      $this->contactNameBody = $this->dom->createElement('NAME');
      $this->contactBody->appendChild($this->contactNameBody);
      $this->contactPhoneBody = $this->dom->createElement('PHONE');
      $this->contactBody->appendChild($this->contactPhoneBody);
      $this->contactMobileBody = $this->dom->createElement('MOBILE');
      $this->contactBody->appendChild($this->contactMobileBody);
      $this->contactEmailBody = $this->dom->createElement('EMAIL');
      $this->contactBody->appendChild($this->contactEmailBody);
      $this->contactFaxBody = $this->dom->createElement('FAX');
      $this->contactBody->appendChild($this->contactFaxBody);
      $this->contactURLBody = $this->dom->createElement('URL');
      $this->contactBody->appendChild($this->contactURLBody);
      $this->adBody->appendChild($this->contactBody);
    }
  }
}
<?php

namespace eiriksm\FinnTransfer\AdTypes;

use eiriksm\FinnTransfer\AdType;

class TorgetXml extends AdType
{

    protected $dtd = 'https://www.iad.no/dtd/IADIF-BitsandPieces63.dtd';

    protected $documentType = 'IAD.IF.BITSPIECES';

    protected $adBodyTag = 'SALESOBJECT';

    /**
     * @var \DOMElement
     */
    protected $categoryBody;

    /**
     * @var \DOMElement
     */
    protected $productCategory;

    /**
     * @var \DOMElement
     */
    protected $anonContactBody;
    protected $anonReference;
    protected $anonInfo;

    public function __construct($partner_id, $provider)
    {
        parent::__construct($partner_id, $provider);
        $this->categoryBody = $this->dom->createElement('CATEGORY');
        $this->productCategory = $this->dom->createElement('PRODUCTCATEGORY');
        $this->categoryBody->appendChild($this->productCategory);
        $this->adBody->appendChild($this->categoryBody);
        $this->GENERIC_ATTRIBUTE = '';
        $this->customTags['GENERIC_ATTRIBUTE']->setAttribute('XMLNAME', '');
        $this->DESCRIPTION = '';
        $this->ITEM_CONDITION = '';
        $this->createMoreInfoElements();
        $this->PRICE = '';
        $this->initializeContact();
        $this->TRANSPORT_TERMS = '';
        $this->PAYMENT_TERMS = '';
        $this->anonContactBody = $this->dom->createElement('ANONYMOUS_CONTACT');
        $this->anonReference = $this->dom->createElement('REFERENCE');
        $this->anonContactBody->appendChild($this->anonReference);
        $this->anonInfo = $this->dom->createElement('INFO');
        $this->anonContactBody->appendChild($this->anonInfo);
    }

    public function setProductCategory($category)
    {
        $this->productCategory->nodeValue = $category;
    }

    public function setMotorPrice($number, $currency = 'NOK')
    {
    }

    public function setIncludingMva($includes)
    {
    }
}

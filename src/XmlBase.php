<?php

namespace eiriksm\FinnTransfer;

class XmlBase
{

  /**
   * @var string
   */
    protected $provider;

  /**
   * @var string
   */
    protected $partnerId;

  /**
   * @var string
   */
    protected $documentType;

  /**
   * @var string
   */
    protected $dtd;

  /**
   * @var \DOMDocument
   */
    protected $dom;

  /**
   * @var \DOMElement
   */
    protected $documentBody;

  /**
   * @var array
   */
    private $validationErrors = [];

    public function __construct($partner_id, $provider)
    {
        $this->provider = $provider;
        $this->partnerId = $partner_id;
        $imp = new \DOMImplementation();
        if (!isset($this->documentType) && isset($this->adBodyTag)) {
          // Create it based on the body tag.
            $this->documentType = 'IAD.IF.' . $this->adBodyTag;
        }
        if (!isset($this->documentType) || !isset($this->dtd)) {
            throw new \InvalidArgumentException('Class ' . get_class($this) . ' must provide a documentType and dtd property');
        }
        $dtd = $imp->createDocumentType($this->documentType, '', $this->dtd);
        $this->dom = $imp->createDocument('', '', $dtd);
        $this->dom->encoding = 'UTF-8';
        $this->documentBody = $this->dom->createElement($this->documentType);
        $this->dom->appendChild($this->documentBody);
    }

    public function getXml()
    {
      // Hack to get the errors for ourself.
        $eh = set_error_handler(array($this, 'onValidateError'));
        $valid = $this->dom->validate();
        if ($eh) {
            set_error_handler($eh);
        }
        if (false === $valid) {
            throw new \Exception('The XML was not valid according to the DTD: ' . implode("\n", $this->validationErrors));
        }
        return $this->dom->saveXML();
    }

    public function onValidateError($no, $string, $file, $line, $context)
    {
        $this->validationErrors[] = $string;
    }
}

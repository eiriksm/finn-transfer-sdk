<?php

namespace eiriksm\FinnTransfer;

use eiriksm\FinnTransfer\Traits\HeaderTrait;
use eiriksm\FinnTransfer\Traits\ObjectTrait;

class MmoXml extends XmlBase
{
    use HeaderTrait;
    use ObjectTrait;

    protected $dtd = 'http://www.finn.no/dtd/IADIF-mmo20.dtd';
    protected $documentType = 'IAD.IF.MMO';
    protected $zip;
    protected $imageDelta = 1;

  /**
   * @var string
   */
    protected $filename;

    public function __construct($partner_id, $provider, $order_no) {
      parent::__construct($partner_id, $provider);
      $this->createHeader();
      $this->createObject();
      $order_no_el = $this->dom->createElement('ORDERNO');
      $order_no_el->nodeValue = $order_no;
      $this->objectHeadBody->appendChild($order_no_el);
      $this->zip = new \ZipArchive();
      $this->filename = '/tmp/' . uniqid('mmoxml') . '.zip';
      if ($this->zip->open($this->filename, \ZipArchive::CREATE) !== true) {
        throw new \Exception('Could not open ' . $this->filename);
      }
    }

    public function addImage($image)
    {
      // Get the file contents.
      if (!$image_contents = @file_get_contents($image)) {
        throw new \Exception('Image contents for ' . $image . ' was empty.');
      }
      $extension = pathinfo($image, PATHINFO_EXTENSION);
      // Add it to the zip.
      $image_filename = 'image-' . $this->imageDelta . '.' . $extension;
      if (!$this->zip->addFromString($image_filename, $image_contents)) {
        throw new \Exception('Image ' . $image . ' could not be added to the zip archive.');
      }
      // Add XML data for it.
      $mo_el = $this->dom->createElement('MO');
      $mo_el->setAttribute('REF', $image_filename);
      $mo_el->setAttribute('PRIORITY', $this->imageDelta);
      $mo_el->setAttribute('REMOVE', 'no');
      $mo_el->setAttribute('MMO_TYPE', 'image');
      $this->objectBody->appendChild($mo_el);
      $this->imageDelta++;
    }

    public function asZip()
    {
      // Add the xml into the zip as well.
      $this->zip->addFromString('mmo.xml', $this->getXml());
      if (!$this->zip->close()) {
        throw new \Exception('Could not close zip file');
      }
      if (!$contents = @file_get_contents($this->filename)) {
        throw new \Exception('Could not get file contents of zip after creating and closing it');
      }
      return $contents;
    }
}

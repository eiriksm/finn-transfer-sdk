<?php

namespace eiriksm\FinnTransfer;

interface AdTypeInterface
{
    public function __construct($partner_id, $provider);

    public function getXml();
}

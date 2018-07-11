<?php

namespace eiriksm\FinnTransfer;

interface ClientInterface
{
    public function transfer($body);
}

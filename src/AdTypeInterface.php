<?php

namespace eiriksm\FinnTransfer;

interface AdTypeInterface
{
    public function __construct($partner_id, $provider);

    public function getXml();

    /**
     * Set the effect of the engine.
     *
     * @param int $effect
     *   The effect of the engine
     *
     * @return void
     */
    public function setEngineEffect($effect);
}

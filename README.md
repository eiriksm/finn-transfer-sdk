# finn-transfer-sdk
[![Build Status](https://travis-ci.org/eiriksm/finn-transfer-sdk.svg?branch=master)](https://travis-ci.org/eiriksm/finn-transfer-sdk)

SDK for transferring ads to finn.no

You need an agreement to use this API, and the [complete documentation can be found here](https://hjelpesenter.finn.no/hc/no/articles/303554-How-to-get-started-Import-Transfer-choices).

This library implements the REST API part described in that documentation.

## Installation

`composer require eiriksm/finn-transfer-sdk`

## Usage

```php
<?php

use eiriksm\FinnTransfer\AdTypes\TractorXml;
use eiriksm\FinnTransfer\FinnTransfer;
use GuzzleHttp\Client;

$partner_id = 'mypartnerid';
$provider = 'myprovider';
// Start by constructing an ad type. For example a tractor ad.
$ad = new TractorXml($partner_id, $provider);
// Then set some properties. We probably want to set an ad title, and a price,
// for example.
$ad->setHeading('Used tractor for sale');
$ad->setMotorPrice(10000);
// For this example, we will also set postcode, since that is required.
$ad->setZipCode(9300);
// And maybe something a bit more specific. It has a 200 horse power engine.
$ad->setEngineEffect(200);
// We can also set arbitrary properties that are defined in the DTD for this ad
// type. For tractor that would be http://www.iad.no/dtd/IADIF-tractor-21.dtd
// where we can see there is something called TRACTOR_EQUIPMENT for example. We
// can find a list of valid values at https://www.finn.no/finn/referencevalue?adType=TRACTOR&xmlCode=TRACTOR_EQUIPMENT
$ad->TRACTOR_EQUIPMENT = 'KOMPLETT_FRONTLASTER';
// Now, there is probably a whole lot more you want to set on the ad, but those
// were some examples. In the end, use this method to get the xml. This will
// also validate the XML according to the spec.
$xml = $ad->getXml();

// Next step would be to send this XML to finn.no.
$transfer = new FinnTransfer();
$transfer->setAd($ad);
// By default we are working against the dev environment of finn.no, but use
// this method to do it live(tm).
$transfer->getClient()->setLiveMode();
// Then get a HTTP client somehow.
$http_client = new Client();
// Now transfer the ad.
$result_xml = $transfer->transfer($http_client);
```

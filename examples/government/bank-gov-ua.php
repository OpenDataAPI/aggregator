<!DOCTYPE html>
<html>
    <head>
         <meta charset="UTF-8">
    </head>
    <body>
<?php

require_once("../../vendor/autoload.php");

use OpenDataAPI\aggregator\providers\government\BankGovUa;

use OpenDataAPI\aggregator\constants\DataFormat;
use OpenDataAPI\aggregator\constants\Currency;

$response = BankGovUa::getExchangeRate(DataFormat::XML, "20150314", Currency::USD);
var_dump($response);

$response = BankGovUa::getObligations(DataFormat::JSON);
var_dump($response);

$response = BankGovUa::getIndex(DataFormat::XML);
var_dump($response);

?>
    </body>
</html>

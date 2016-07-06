<!DOCTYPE html>
<html>
    <head>
         <meta charset="UTF-8">
    </head>
    <body>
<?php

require_once("../../vendor/autoload.php");

use OpenDataAPI\aggregator\providers\government\EDataGovUA;

$transactions = EDataGovUA::getTransactions([
    "startdate" => "01-12-2015",
    "enddate" => "01-02-2016",
    "regions" => [5], // Ідентифікатор регіону з GeoData::$regions (Regions IDs from GeoData::$regions)
    "payers_edrpous" => ["39883094","09334702"],
    "recipt_edrpous" => ["09334702","39883094"]
]);

foreach ($transactions->response->transactions as $transaction) {
    var_dump($transaction);
}

?>
    </body>
</html>

<!DOCTYPE html>
<html>
    <head>
         <meta charset="UTF-8">
    </head>
    <body>
<?php

require_once("../../vendor/autoload.php");

use OpenDataAPI\aggregator\providers\government\DataGovUA;

use OpenDataAPI\aggregator\constants\DataFormat;

$data = DataGovUA::getDataSet(
    '1f89d214-4b2b-4251-a51b-5bafea10c0a8', // Ідентифікаційний номер набору даних (Dataset identifier)
    null, // Номер ревізії або версія (Revision ID)
    DataFormat::JSON
);

var_dump($data);

?>
    </body>
</html>

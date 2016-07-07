<!DOCTYPE html>
<html>
    <head>
         <meta charset="UTF-8">
    </head>
    <body>
<?php

require_once("../../vendor/autoload.php");

use OpenDataAPI\aggregator\providers\government\DataRadaGovUA;

use OpenDataAPI\aggregator\constants\DataFormat;

$response = DataRadaGovUA::getList(DataFormat::JSON);
var_dump($response);

$response = DataRadaGovUA::getDataSet(DataRadaGovUA::SET_ZAL, DataFormat::CSV);
var_dump($response);

?>
    </body>
</html>

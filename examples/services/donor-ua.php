<!DOCTYPE html>
<html>
    <head>
         <meta charset="UTF-8">
    </head>
    <body>
<?php

require_once("../../vendor/autoload.php");

use OpenDataAPI\aggregator\providers\services\DonorUA;

var_dump(DonorUA::getRegions());

var_dump(DonorUA::getCities());

var_dump(DonorUA::getCenters());

var_dump(DonorUA::getRecipients());

?>
    </body>
</html>

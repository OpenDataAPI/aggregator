<?php

namespace OpenDataAPI\aggregator\providers\government;

use OpenDataAPI\aggregator\tools\Request;

/**
 * Функціонал для роботи з API http://edata.gov.ua/.
 * Приклади використання у папці /examples/government.
 *
 * http://edata.gov.ua/ API wrapper.
 * Usage in the /examples/government folder.
 *
 * @category Open Data APIs Aggregator
 * @author Dmytro Zarezenko <dmytro.zarezenko@gmail.com>
 * @copyright (c) 2016, Dmytro Zarezenko
 *
 * @git https://github.com/OpenDataAPI/aggregator
 * @license http://opensource.org/licenses/MIT
 */
class EDataGovUA {

    const URL = "http://api.e-data.gov.ua:8080/api/rest/1.0/"; // 2M requests / day

    /**
     * Повертає список транзакцій за заданими параметрами.
     *
     * Returns transactions list by parameters in JSON.
     *
     * @param array $json Массив данних для формування JSON (Data array for JSON).
     *
     * @return object JSON stdClass object.
     */
    public static function getTransactions($json) {
        return Request::postJSON(self::URL . "transactions", $json);
    }

}

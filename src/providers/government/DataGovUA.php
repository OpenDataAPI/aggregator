<?php

namespace OpenDataAPI\aggregator\providers\government;

use OpenDataAPI\aggregator\tools\Request;
use OpenDataAPI\aggregator\constants\DataFormat;

/**
 * Функціонал для роботи з API http://data.gov.ua/.
 * Приклади використання у папці /examples/government.
 *
 * http://data.gov.ua/ API wrapper.
 * Usage in the /examples/government folder.
 *
 * @category Open Data APIs Aggregator
 * @author Dmytro Zarezenko <dmytro.zarezenko@gmail.com>
 * @copyright (c) 2016, Dmytro Zarezenko
 *
 * @git https://github.com/OpenDataAPI/aggregator
 * @license http://opensource.org/licenses/MIT
 */
class DataGovUA {

    const URL = "http://data.gov.ua/view-dataset/dataset";

    /**
     * Повертає набір даних.
     *
     * Returns dataset.
     *
     * @param string $datasetId Ідентифікаційний номер набору даних (Dataset identifier)
     * @param int $revisionId Номер ревізії або версія (Revision ID)
     * @param string $format Формат даних, XML або JSON (Data format, XML or JSON)
     *
     * @return mixed JSON stdClass object or XML string.
     */
    public static function getDataSet($datasetId, $revisionId = null, $format = DataFormat::JSON) {
        $url = self::URL;
        if ($format == DataFormat::JSON) {
            $url.= ".json";
        }

        $request = [
            'dataset-id' => $datasetId
        ];

        if ($revisionId) {
            $request['revison-id'] = $revisionId;
        }

        $response = Request::get($url, $request);
        if ($format == DataFormat::JSON) {
            return json_decode($response);
        }
        return $response;
    }

}

<?php

namespace OpenDataAPI\aggregator\providers\government;

use OpenDataAPI\aggregator\tools\Request;
use OpenDataAPI\aggregator\constants\DataFormat;

/**
 * Функціонал для роботи з API http://data.rada.gov.ua/.
 * Приклади використання у папці /examples/government.
 *
 * http://data.rada.gov.ua/ API wrapper.
 * Usage in the /examples/government folder.
 *
 * @category Open Data APIs Aggregator
 * @author Dmytro Zarezenko <dmytro.zarezenko@gmail.com>
 * @copyright (c) 2016, Dmytro Zarezenko
 *
 * @git https://github.com/OpenDataAPI/aggregator
 * @license http://opensource.org/licenses/MIT
 */
class DataRadaGovUA {

    const URL = "http://data.rada.gov.ua/ogd/";

    const SET_ZAL = "zal"; // Інформація про розгляд питань порядку денного Верховної Ради України
    const SET_ZPR = "zpr"; // Інформація про законопроекти, що зареєстровано у Верховній Раді України
    const SET_ZAK = "zak"; // Нормативно-правова база України (База даних "Законодавство України")
    const SET_MPS = "mps"; // Інформація про народних депутатів України (за скликаннями)
    const SET_AUT = "aut"; // Інформація про організаційну структуру розпорядника інформації
    const SET_FIN = "fin"; // Господарсько-фінансова діяльність Верховної Ради України

    /**
     * Повертає список доступних наборів даних з порталу відкритих даних
     * Верховної Ради України.
     *
     * Returns list of accessible data sets from Verkhovna Rada of Ukraine
     * Open Data Portal
     *
     * @param string $format XML, JSON or CSV (use DataFormat class constants)
     *
     * @return mixed stdClass object for JSON, SimpleXMLElement for XML and
     *           array for CSV
     */
    public static function getList($format = DataFormat::JSON) {
        return self::getDataSet("", $format);
    }

    /**
     * Повертає наборір даних з порталу відкритих даних Верховної Ради України за
     * заданим шляхом.
     *
     * Returns data sets from Verkhovna Rada of Ukraine Open Data Portal by
     * provided path.
     *
     * @param string $path Шлях до набору даних (Path to the dataset)
     * @param string $format XML, JSON or CSV (use DataFormat class constants)
     *
     * @return mixed stdClass object for JSON, SimpleXMLElement for XML and
     *           array for CSV
     * @throws Exception У разі виникнення проблем доступу до даних або якщо
     *           вказаний невірний формат даних (on data provider access problems
     *           or incorrect data format)
     */
    public static function getDataSet($path, $format = DataFormat::JSON) {
        switch ($format) {
            case (DataFormat::JSON):
            case (DataFormat::XML):
            case (DataFormat::CSV):
                $response = Request::get(self::URL . "{$path}/list.{$format}");
                if ($response) {
                    switch ($format) {
                        case (DataFormat::JSON):
                            $response = mb_convert_encoding($response, "utf-8", "windows-1251");
                            return json_decode($response);
                        case (DataFormat::XML):
                            return simplexml_load_string($response);
                        case (DataFormat::CSV):
                            $response = mb_convert_encoding($response, "utf-8", "windows-1251");
                            $response = explode("\n", $response);
                            if (is_array($response) && count($response) > 0) {
                                $keys = str_getcsv($response[0], ",");
                                $data = [];
                                for ($i = 1; $i < count($response); $i++) {
                                    $vals = str_getcsv($response[$i]);
                                    if (count($keys) == count($vals)) {
                                        $data[] = array_combine($keys, $vals);
                                    }
                                }
                                return $data;
                            }
                            return [];
                    }
                } else {
                    throw new Exception("Invalid response from API provider");
                }

                break;
            default:
                throw new Exception("Invalid data format '{$format}'");
        }
    }

}

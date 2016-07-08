<?php

namespace OpenDataAPI\aggregator\providers\government;

use OpenDataAPI\aggregator\tools\Request;
use OpenDataAPI\aggregator\constants\DataFormat;
use OpenDataAPI\aggregator\constants\Currency;

/**
 * Функціонал для роботи з API http://bank.gov.ua/.
 * Приклади використання у папці /examples/government.
 *
 * http://bank.gov.ua/ API wrapper.
 * Usage in the /examples/government folder.
 *
 * @example http://www.bank.gov.ua/control/uk/publish/article?art_id=25327817
 *
 * @category Open Data APIs Aggregator
 * @author Dmytro Zarezenko <dmytro.zarezenko@gmail.com>
 * @copyright (c) 2016, Dmytro Zarezenko
 *
 * @git https://github.com/OpenDataAPI/aggregator
 * @license http://opensource.org/licenses/MIT
 */
class BankGovUa {

    const URL = "http://bank.gov.ua/NBUStatService/v1/statdirectory/";

    /**
     * Шляхи до доступних наборів даних
     *
     * Supported paths to data sets
     */
    const ACT_EXCHANGE = 'exchange'; // Курси валют
    const ACT_OBLIGATIONS = 'ovdp'; // Облігації внутрішніх державних позик
    const ACT_INDEX = 'uiir'; // Їндекс міжбанківських ставок

    /**
     * Періоди часу, що підтримуються.
     *
     * Supported time periods.
     */
    const PERIOD_OVERNIGHT = 'OVERNIGHT';
    const PERIOD_1WEEK = '1WEEK';
    const PERIOD_2WEEKS = '2WEEKS';
    const PERIOD_1MONTH = '1MONTH';
    const PERIOD_3MONTHS = '3MONTHS';

    /**
     * Повертає офіційні курси гривні щодо іноземних валют та банківських металів.
     *
     * Returns on official exchange rates of foreign currencies and precious metals.
     *
     * @param string $format XML or JSON (use DataFormat class constants)
     * @param string $date Дата у форматі yyyyMMdd (Date in format yyyyMMdd)
     * @param string $currency Код валюти, регістр значення не має
     *           (Currency code, case insensitive)
     *
     * @return object stdClass object for JSON or SimpleXMLElement for XML
     */
    public static function getExchangeRate($format = DataFormat::JSON, $date = null, $currency = Currency::USD) {
        $url = self::URL . self::ACT_EXCHANGE;
        if (!is_null($date)) {
            $url.= "?date={$date}";
            if (!is_null($currency)) {
                $url.= "&valcode={$currency}";
            }
            if ($format === DataFormat::JSON) {
                $url.= "&json";
            }
        } else{
            if ($format === DataFormat::JSON) {
                $url.= "?json";
            }
        }

        return self::getData($url, $format);
    }

    /**
     * Повертає результати розміщення облігацій внутрішніх державних позик.
     *
     * Returns the results of placement domestic government bonds.
     *
     * @param string $format XML or JSON (use DataFormat class constants)
     * @param string $date Дата у форматі yyyyMMdd (Date in format yyyyMMdd)
     * @param string $currency Код валюти (можливі значення UAH / USD / EUR,
     *           регістр значення не має)
     *           Currency code (UAH, USD or EUR, case insensitive)
     *
     * @return array List of stdClass for JSON or SimpleXMLElement for XML objects
     */
    public static function getObligations($format = DataFormat::JSON, $date = null, $currency = Currency::USD) {
        $url = self::URL . self::ACT_OBLIGATIONS;
        if (!is_null($date)) {
            $url.= "?date={$date}";
            if (!is_null($currency)) {
                $url.= "&valcode={$currency}";
            }
            if ($format === DataFormat::JSON) {
                $url.= "&json";
            }
        } else{
            if ($format === DataFormat::JSON) {
                $url.= "?json";
            }
        }

        return self::getData($url, $format);
    }

    /**
     * Український індекс міжбанківських ставок.
     *
     * Index Ukrainian interbank rates.
     *
     * @param string $format XML or JSON (use DataFormat class constants)
     * @param string $date Дата у форматі yyyyMMdd (Date in format yyyyMMdd)
     * @param type $period Період часу (можливі значення для періоду
     *           OVERNIGHT / 1WEEK / 2WEEKS / 1MONTH / 3MONTHS, регістр значення
     *           не має)
     *           Time period (OVERNIGHT / 1WEEK / 2WEEKS / 1MONTH / 3MONTHS, case
     *           insensitive)
     *
     * @return array List of stdClass for JSON or SimpleXMLElement for XML objects
     */
    public static function getIndex($format = DataFormat::JSON, $date = null, $period = self::PERIOD_OVERNIGHT) {
        $url = self::URL . self::ACT_INDEX;
        if (!is_null($date)) {
            $url.= "?date={$date}";
            if (!is_null($period)) {
                $url.= "&period={$period}";
            }
            if ($format === DataFormat::JSON) {
                $url.= "&json";
            }
        } else{
            if ($format === DataFormat::JSON) {
                $url.= "?json";
            }
        }

        return self::getData($url, $format);
    }

    /**
     * Службовий метод для отримання даних.
     *
     * Helper method for receive data.
     *
     * @param string $url URL
     * @param string $format XML or JSON (use DataFormat class constants)
     *
     * @return object stdClass object for JSON or SimpleXMLElement for XML
     * @throws Exception У разі виникнення проблем доступу до даних або якщо
     *           вказаний невірний формат даних (on data provider access problems
     *           or incorrect data format)
     */
    private static function getData($url, $format = DataFormat::JSON) {
        $response = Request::get($url);
        if ($response) {
            switch ($format) {
                case (DataFormat::JSON):
                    return json_decode($response);
                case (DataFormat::XML):
                    return simplexml_load_string($response);
                default:
                    throw new Exception("Invalid data format");
            }
        } else {
            throw new Exception("Invalid response from API provider");
        }
    }

}

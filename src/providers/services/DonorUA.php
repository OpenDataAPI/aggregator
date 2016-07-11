<?php

namespace OpenDataAPI\aggregator\providers\services;

use OpenDataAPI\aggregator\tools\Request;

/**
 * Функціонал для роботи з API http://donor.ua/.
 * Приклади використання у папці /examples/government.
 *
 * http://donor.ua/ API wrapper.
 * Usage in the /examples/government folder.
 *
 * @example https://donor.ua/developers
 *
 * @category Open Data APIs Aggregator
 * @author Dmytro Zarezenko <dmytro.zarezenko@gmail.com>
 * @copyright (c) 2016, Dmytro Zarezenko
 *
 * @git https://github.com/OpenDataAPI/aggregator
 * @license http://opensource.org/licenses/MIT
 */
class DonorUA {

    const URL = "https://donor.ua/api";

    /**
     * Повертає список центрів переливання крові.
     *
     * Returns a list of centers of blood transfusion.
     *
     * @return object stdClass object from JSON.
     */
    public static function getCenters() {
        $response = Request::get(self::URL . "/centers");

        return json_decode($response);
    }

    /**
     * Повертає список міст.
     *
     * Returns a list of cities.
     *
     * @return object stdClass object from JSON.
     */
    public static function getCities() {
        $response = Request::get(self::URL . "/cities");

        return json_decode($response);
    }

    /**
     * Повертає список областей.
     *
     * Returns a list of regions.
     *
     * @return object stdClass object from JSON.
     */
    public static function getRegions() {
        $response = Request::get(self::URL . "/regions");

        return json_decode($response);
    }

    /**
     * Повертає список реципієнтів.
     *
     * Returns a list of recipients.
     *
     * @return object stdClass object from JSON.
     */
    public static function getRecipients() {
        $response = Request::get(self::URL . "/recipients");

        return json_decode($response);
    }

}

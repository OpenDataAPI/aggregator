<?php

namespace OpenDataAPI\aggregator\tools;

/**
 * Basic HTTP requests functionality.
 *
 * @category Open Data APIs Aggregator
 * @author Dmytro Zarezenko <dmytro.zarezenko@gmail.com>
 * @copyright (c) 2016, Dmytro Zarezenko
 *
 * @git https://github.com/OpenDataAPI/aggregator
 * @license http://opensource.org/licenses/MIT
 */
class Request {

    /**
     * Send HTTP request with GET method.
     *
     * @param string $url URL.
     * @param array $request Request parameters.
     *
     * @return mixed Response on success, <b>false</b> on failure.
     */
    public static function get($url, $request = []) {
        if (!empty($request)) {
            $url.= "?" . self::getRequestStr($request);
        }
        $ch = curl_init($url);

        curl_setopt_array($ch, [
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
        ]);

        $response = curl_exec($ch);

        curl_close($ch);

        return $response;
    }

    /**
     * Send HTTP request with POST method.
     *
     * @param string $url URL.
     * @param array $request Request parameters.
     *
     * @return mixed Response on success, <b>false</b> on failure.
     */
    public static function post($url, $request = []) {
        $ch = curl_init($url);

        curl_setopt_array($ch, [
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => self::getRequestStr($request),
            CURLOPT_RETURNTRANSFER => true,
            //CURLOPT_POST => true,
        ]);

        $response = curl_exec($ch);

        curl_close($ch);

        return $response;
    }

    /**
     * Send HTTP request with POST method and JSON data.
     *
     * @param string $url URL.
     * @param array $request Data to send with JSON.
     *
     * @return mixed Response on success, <b>false</b> on failure.
     */
    public static function postJSON($url, $request = []) {
        $requestJSON = json_encode($request);
        //var_dump($requestJSON);
        //exit();

        $ch = curl_init($url);

        curl_setopt_array($ch, [
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($requestJSON)
            ],
            CURLOPT_POSTFIELDS => $requestJSON,
            CURLOPT_RETURNTRANSFER => true,
            //CURLOPT_POST => true,
        ]);

        $response = curl_exec($ch);

        curl_close($ch);

        return json_decode($response);
    }

    /**
     * Generates request parameters string from array.
     *
     * @param array $request Request parameters array.
     *
     * @return string
     */
    private static function getRequestStr($request) {
        $params = [];
        foreach ($request as $k => $v) {
            $params[] = "$k=$v";
        }

        return implode("&", $params);
    }

}

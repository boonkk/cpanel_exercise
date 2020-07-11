<?php
require_once 'Operations.php';

/**
 * Class APIConnector - helper class, sending POST/GET request to WHM Api 1
 */
class APIConnector
{
    //not good way to store this
    private const USER = "root";
    private const TOKEN = "F5T63I005YZHABAN75Z0ZY902EAQ63XK";
    private const API_VER = 1;
    private const PART_URL = 'https://cpanel-test.modulesgarden.com:2087/json-api/';

    private function buildQuery($operation) {
        return self::PART_URL . $operation .'?';
    }

    /**
     * @param array $arrData - body
     * @param $operation - const from userDaoWHM/Operations.php class
     * @return bool|string - response from WHM Api server
     */
    public function sendPostRequest(array $arrData, $operation)
    {
        $url = self::buildQuery($operation);

        $fields_string = "api.version=".self::API_VER."&".http_build_query($arrData);

        $ch = curl_init();
        $header[0] = "Authorization: whm " . self::USER . ":" . self::TOKEN;

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    /** function for sending non-parameter GET request
     * @param $operation - const from userDaoWHM/Operations.php class
     * @return bool|string - response from server WHM API 1 server
     */
    public function sendGetRequest($operation) {
        $url = self::buildQuery($operation);

        $ch = curl_init();
        $header[0] = "Authorization: whm " . self::USER . ":" . self::TOKEN;

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        //echo $result;
        curl_close($ch);
        return $result;
    }


}
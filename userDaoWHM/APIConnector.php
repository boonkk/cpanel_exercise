<?php
require_once 'Operations.php';
require_once 'config.php';
/**
 * Class APIConnector - helper class, sending POST/GET request to WHM Api 1
 */
class APIConnector
{
    private string $user;
    private string $token;
    private string $api_ver;
    private string $part_url;

    public function __construct()
    {
        $configs = include('config.php');
        $this->user = $configs["USER"];
        $this->token = $configs["TOKEN"];
        $this->part_url = $configs["SERVER"];
        $this->api_ver = $configs["API_VERSION"];
    }

    /**
     * @param array $arrData - body
     * @param $operation - const from userDaoWHM/Operations.php class
     * @return bool|string - response from WHM Api server
     */
    public function sendPostRequest(array $arrData, $operation)
    {
        $url = self::buildQuery($operation);

        $fields_string = "api.version=".$this->api_ver."&".http_build_query($arrData);

        $ch = curl_init();
        $header[0] = "Authorization: whm " . $this->user . ":" . $this->token;

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
        $header[0] = "Authorization: whm " . $this->user . ":" . $this->token;

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        //echo $result;
        curl_close($ch);
        return $result;
    }

    private function buildQuery($operation) {
        return $this->part_url . $operation .'?';
    }
}
<?php


class ResponseHandler
{
    /**
     * Parsing default server response into Success or error message
     * @param array $response
     * @return string - either "Success" or error message string
     */
    public static function handleResponse(array $response) {
        if($response['metadata']['result'] == 1) {
            return "Success";
        } else {
            return $response['metadata']['reason'];
        }
    }

}
<?php

/**
 * Class JsonParserWHM - json/array filtering class, works with json responses from WHM Api 1
 */
class JsonParserWHM
{
    /**
     * Decodes $json into array
     * @param string $json
     * @return array representation of $json
     */
    public static function getDecoded(string $json) {
        return json_decode($json,true);
    }

    /**
     * @param string $json
     * @return array - array of account names ('user' keys)
     */
    public static function getAccountNames(string $json) {
        return self::getFields($json, 'user', 'acct');
    }

    /**
     * @param string $json
     * @return array - array of hosting plans ('name' keys)
     */
    public static function getPlans(string $json) {
        $decoded = json_decode($json,true);
        $decoded = $decoded['data'];
        return self::getFields(json_encode($decoded),  'name', 'pkg');
    }

    private static function getFields(string $json, string $field, string $subArrayName){
        $decoded = json_decode($json, true);
        $result = array();
        foreach ($decoded[$subArrayName] as $subArr) {
            array_push($result, $subArr[$field]);
        }
        return $result;
    }

}
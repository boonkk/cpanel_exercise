<?php
require_once 'User.php';

/**
 * Class UserFactory - creating User objects from different sources
 */
class UserFactory
{
    public static function fromArray(array $userData) : User {
        return self::getUserFromArray($userData);
    }

    public static function fromJson(string $json) : User {
        return self::fromArray(json_decode($json));
    }

    public static function fromSummaryResponse(array $summaryResponse) : User {
        $summaryResponse = $summaryResponse['data']['acct'][0];
        $summaryResponse = array_merge($summaryResponse, ["contactemail" => $summaryResponse['email']]);

        return self::fromArray($summaryResponse);
    }

    private static function getUserFromArray(array $userData) : User {
        $dataParser = new UserDataParser($userData);

        return new User(
            $dataParser->getName(),
            $dataParser->getEmail(),
            $dataParser->getDomain(),
            $dataParser->getPlan(),
            $dataParser->getPassword()
        );
    }

}
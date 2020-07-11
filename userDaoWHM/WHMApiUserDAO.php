<?php
require_once 'APIConnector.php';
require_once 'Operations.php';
require_once 'JsonParserWHM.php';
require_once 'dao/UserDAO.php';
require_once 'model/User.php';
require_once 'model/UserFactory.php';


/**
 * Class WHMApiUserDAO - DAO for WHM API 1 connection
 */
class WHMApiUserDAO implements UserDAO
{
    private $apiConnector;

    public function __construct()
    {
        $this->apiConnector = new APIConnector();
    }

    /**
     * Registers new cPanel user
     * @param User $user - User object to register
     * @return array - response from server
     */
    public function registerUser(User $user){
        $userArr = $user->toArray();
        $userArr['username'] = $userArr['user'];
        unset($userArr['user']);

        $response = $this->apiConnector->sendPostRequest($userArr, Operations::CREATE_USER);
        return JsonParserWHM::getDecoded($response);
    }

    /**
     * Listing all registered cPanel users
     * @return array - array containing usernames
     */
    public function listUsers(){
        $response = $this->apiConnector->sendGetRequest(Operations::LIST_USERS);
        return JsonParserWHM::getAccountNames($response);
    }

    /**
     * Removes cPanel user
     * @param string $username
     * @return array - response from server
     */
    public function removeUser(string $username){
        $result = $this->apiConnector->sendPostRequest(['user' => $username], Operations::REMOVE_USER);
        return JsonParserWHM::getDecoded($result);
    }

    /**
     * @param string $username
     * @param User $modifiedUser - User object with new values, not specified values allowed
     * @return array - response from server
     */
    public function modifyUser(string $username, User $modifiedUser){
        //plan needs to be changed separately
        if($modifiedUser->getPlan()!="")
            $this->changePlan($username, $modifiedUser->getPlan());

        //pass needs to be changed separately (different api command)
        if($modifiedUser->getPassword()!="")
            self::changePassword($username,$modifiedUser->getPassword());


        $userArrayRepresentation = $modifiedUser->toArray();
        array_filter($_POST, fn($value) => !is_null($value) && $value !== '');

        if(isset($userArrayRepresentation['user']))
            $userArrayRepresentation['newuser'] = $userArrayRepresentation['user'];
        $userArrayRepresentation['user'] = $username;

        $response = self::sendPostRequest($userArrayRepresentation, Operations::MODIFY_USER);
        return JsonParserWHM::getDecoded($response);
    }

    /** Verifies if username is available/possible for use
     * @param string $username
     * @return array - response from server
     */
    public function verifyUsername(string $username){
        $response = self::sendPostRequest(['user' => $username], Operations::VERIFY_USERNAME);
        return JsonParserWHM::getDecoded($response);
    }

    /**
     * @return array - list of all available hosting plans
     */
    public function listPlans(){
        $response = self::sendPostRequest(['want' => 'all'], Operations::LIST_PLANS);
        return JsonParserWHM::getPlans($response);
    }

    /**
     * Getting User object from server by username
     * @param string $username
     * @return User - User object without password
     */
    public function getUser(string $username) : ?User {
        $summaryResponse = self::sendPostRequest(['user'=>$username], Operations::ACCOUNT_SUMMARY);
        $summaryResponse = JsonParserWHM::getDecoded($summaryResponse);
        return UserFactory::fromSummaryResponse($summaryResponse);
    }

    private function changePassword(string $username, string $newPassword) {
        $response = self::sendPostRequest(['user' => $username, 'password' => $newPassword], Operations::PASSWORD_CHANGE);
        if($response['metadata']['result'] == 0)
            throw new \InvalidArgumentException($response['metadata']['reason']);
        return JsonParserWHM::getDecoded($response);
    }

    private function sendPostRequest(array $data, $operation) {
        return $this->apiConnector->sendPostRequest($data,$operation);
    }

    private function changePlan(string $username, string $plan) {
        $data = ['user' => $username,
                 'pkg' => $plan];
        return $this->apiConnector->sendPostRequest($data, Operations::CHANGE_PACKAGE);
    }


}
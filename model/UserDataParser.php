<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

/**
 * UserDataParser - helper class, getting out user values from arrays
 */
class UserDataParser
{
    private $userData;

    public function __construct($userData){
        $this->userData = $userData;
    }

    public function getPassword() {
        if(isset($this->userData['password']))
            return $this->userData['password'];
        else return null;
    }

    public function getName(){
        $user = $this->userData['user'];
        $username = $this->userData['username'];
        $newuser = $this->userData['newuser'];
        return $user != ""
            ? $user
            : ($username != "" ? $username : $newuser);
    }

    public function getEmail(){
        return $this->userData['contactemail'];
    }

    public function getPlan(){
        return $this->userData['plan'];
    }

    public function getDomain() {
        return $this->userData['domain'];
    }


}
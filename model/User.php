<?php
require_once 'UserDataParser.php';

class User
{
    private ?string $user;
    private ?string $password;
    private ?string $domain;
    private ?string $plan;
    private ?string $contactEmail;

    public function __construct($username, $contactEmail, $domain, $plan, $password){
        $this->user = $username;
        $this->domain = $domain;
        $this->contactEmail = $contactEmail;
        $this->plan = $plan;
        $this->password = $password;
    }

    public function toArray(){
        return [
            "user" => $this->user,
            "password" => $this->password,
            "domain" => $this->domain,
            "contactemail" => $this->contactEmail,
            "plan" => $this->plan
        ];
    }

    public function getUsername()
    {
        return $this->user;
    }

    public function getDomain()
    {
        return $this->domain;
    }

    public function getPlan()
    {
        return $this->plan;
    }

    public function getEmail()
    {
        return $this->contactEmail;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUsername(string $username): void
    {
        $this->user = $username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getContactEmail()
    {
        return $this->contactEmail;
    }

    public function setContactEmail(string $contactEmail): void
    {
        $this->contactEmail = $contactEmail;
    }

    public function setDomain(string $domain): void
    {
        $this->domain = $domain;
    }

    public function setPlan(string $plan): void
    {
        $this->plan = $plan;
    }

}
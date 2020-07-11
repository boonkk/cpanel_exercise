<?php
require_once 'dao/UserDAO.php';
require_once 'model/User.php';

/**
 * Service implementation
 */
class UserService
{
    private UserDAO $userDao;
    public function __construct(UserDAO $userDao){
        $this->userDao=$userDao;
    }

    public function createUser(User $user){
        return $this->userDao->registerUser($user);
    }

    public function listUsers(){
        return $this->userDao->listUsers();
    }

    public function removeUser(string $username){
        return $this->userDao->removeUser($username);
    }

    public function modifyUser($username, $user){
        return $this->userDao->modifyUser($username, $user);
    }

    public function verifyUsername(string $username){
        return $this->userDao->verifyUsername($username);
    }

    public function listPlans(){
        return $this->userDao->listPlans();
    }

    public function getUser(string $username) : ?User {
        return $this->userDao->getUser($username);
    }

}
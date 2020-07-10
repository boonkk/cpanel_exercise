<?php
require_once('model/User.php');

/**
 * Interface UserDAO - base CRUD interface for data access objects
 */
interface UserDAO
{
    public function registerUser(User $user);

    public function listUsers();

    public function removeUser(string $username);

    public function modifyUser(string $username, User $user);

    public function listPlans();

    public function getUser(string $username);

}
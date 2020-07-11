<?php

session_start();
require_once'model/UserFactory.php';
require_once'userDaoWHM/WHMApiUserDAO.php';
require_once'service/UserService.php';

$userService = new UserService(new WHMApiUserDAO());

$user = UserFactory::fromArray($_SESSION['reg_data']);
$response = $userService->createUser($user);

unset($_SESSION['password2']);


if ($response['metadata']['result'] == 1) {
    echo "<h2>You have registered succesfully</h2><br/>";
    echo "<a href='index.php'>Home</a>";
} else {
    $_SESSION['err'] = $response['metadata']['reason'];
    header('Location: create.php');
    exit();
}

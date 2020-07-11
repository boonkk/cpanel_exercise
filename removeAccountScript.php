<?php

session_start();
require_once'userDaoWHM/WHMApiUserDAO.php';
require_once'model/UserFactory.php';
require_once'service/UserService.php';

$userService = new UserService(new WHMApiUserDAO());

$response = $userService->removeUser($_SESSION['selectedUser']);

if ($response['metadata']['result'] == 1) {
    header('Location: userpick.php');
} else {
    $_SESSION['err'] = $response['metadata']['reason'];
    echo $_SESSION['err'];

    header('Location: create.php');
    exit();
}

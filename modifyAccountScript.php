<?php
session_start();
require_once('model/UserFactory.php');
require_once('userDaoWHM/WHMApiUserDAO.php');
require_once('service/UserService.php');


$userService = new UserService(new WHMApiUserDAO());
echo $_SESSION['selectedUser'];

array_filter($_POST, fn($value) => !is_null($value) && $value !== '');

try {
    $user = UserFactory::fromArray($_POST);
    $response = $userService->modifyUser($_SESSION['selectedUser'], $user);
} catch (\InvalidArgumentException $e) {
    $_SESSION['err'] = $e->getMessage();
    header("Location: manage.php");
    exit();
}


if ($response['metadata']['result'] == 1) {
//    header("Location: userpick.php");
//    $_SESSION['changes_succesful'] = true;
//    exit();
} else {
    $_SESSION['err'] = $response['metadata']['reason'];
    header("Location: manage.php");
}


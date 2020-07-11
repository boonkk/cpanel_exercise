<?php
require_once'userDaoWHM/WHMApiUserDAO.php';
require_once'service/UserService.php';
require_once'model/User.php';
session_start();

$userService = new UserService(new WHMApiUserDAO());

$userNames = $userService->listUsers();
$users = array();
foreach ($userNames as $userName) {
    array_push($users, $userService->getUser($userName));
}


?>

<!DOCTYPE HTML>
<head>
    <link rel="stylesheet" href="view/css/bootstrap.css">
    <link rel="stylesheet" href="view/css/bootstrap-grid.css">
    <link rel="stylesheet" href="view/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="view/css/bootstrap-utilities.css">
</head>

<body>
<div class="container">
    <div class="col">
        <?
        echo "<table class=\"table\">
              <thead>
                <tr>
                  <th scope=\"col\">Username</th>
                  <th scope=\"col\">Contact email</th>
                  <th scope=\"col\">Domain</th>
                  <th scope=\"col\">Plan</th>
                </tr>
              </thead>
                <tbody>";
        foreach ($users as $user) {
            echo "
                    <tr>
                      <th scope=\"row\">" . $user->getUsername() . "</th>
                      <td>" . $user->getEmail() . "</td>
                      <td>" . $user->getDomain() . "</td>
                      <td>@" . $user->getPlan() . "</td>
                    </tr>";
        }
        echo "
              </tbody>
            </table>";
        ?>
    </div>

    <a href="index.php">Home</a>
</div>
</body>

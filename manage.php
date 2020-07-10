<?php
require_once('userDaoWHM/WHMApiUserDAO.php');
require_once('service/UserService.php');
session_start();


$userService = new UserService(new WHMApiUserDAO());

if (isset($_SESSION['changes_succesful']))
    unset($_SESSION['changes_succesful']);

$selectPlanValues = $userService->listPlans();
if (isset($_POST['selectedUser']))
    $user = $userService->getUser($_POST['selectedUser']);
else
    $user = $userService->getUser($_SESSION['selectedUser']);

if (!isset($_SESSION['selectedUser']))
    $_SESSION['selectedUser'] = $_POST['selectedUser'];

?>

<!DOCTYPE HTML>
<body>
<meta charset="utf-8"/>
<title>cPanel manager</title>
<link rel="stylesheet" href="view/css/bootstrap.css">
<link rel="stylesheet" href="view/css/bootstrap-grid.css">
<link rel="stylesheet" href="view/css/bootstrap-reboot.css">
<link rel="stylesheet" href="view/css/bootstrap-utilities.css">
</body>
<head>
    <div class="container">
        <div class="row">
            <div class="col-3">
                <form method="post" action="modifyAccountScript.php">
                    <div class="form-group">
                        <label for="username">New username:</label>
                        <input type="text" name="newuser" class="form-control" id="username"
                               value="<? echo $user->getUsername(); ?>">
                    </div>

                    <div class="form-group">
                        <label for="contactemail">New email address:</label>
                        <input type="email" name="contactemail" class="form-control" id="contactemail"
                               value="<? echo $user->getEmail(); ?>">
                    </div>

                    <div class="form-group">
                        <label for="password">New password:</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>

                    <div class="form-group">
                        <label for="plan">Change plan</label>
                        <select name="plan" class="form-control" id="plan">
                            <?php
                            foreach ($selectPlanValues as $val) {
                                echo "<option value = '$val'>$val</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="domain">New domain</label>
                        <input type="text" name="domain" class="form-control" id="domain"
                               value="<? echo $user->getDomain() ?>">
                    </div>

                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
                <form method="post" action="removeAccountScript.php">
                    <input type="submit" value="Delete account" class="btn btn-outline-danger">
                </form>
                <div class="error" style="color:red">
                    <?
                    if (isset($_SESSION['err'])) {
                        echo $_SESSION['err'];
                        //unset($_SESSION['err']);
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

</head>


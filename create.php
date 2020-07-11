<?php
session_start();

require_once 'service/UserService.php';
require_once 'userDaoWHM/WHMApiUserDAO.php';


$userService = new UserService(new WHMApiUserDAO());
$selectPlanValues = $userService->listPlans();

if(isset($_POST['password']) && $_POST['password'] == $_POST['password2']) {
    $_SESSION['reg_data'] = $_POST;
    header("Location: registerAccountScript.php");
} else if(isset($_POST['password'])) {
    $_SESSION['pass_match_err'] = "Passwords must match!";

}?>



<!DOCTYPE HTML>
<head>
    <meta charset="utf-8"/>
    <title>Create Account</title>
    <link rel="stylesheet" href="view/css/bootstrap.css">
    <link rel="stylesheet" href="view/css/bootstrap-grid.css">
    <link rel="stylesheet" href="view/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="view/css/bootstrap-utilities.css">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 mx-auto">
            <div class="row">
                <h2>Register new CPanel Account</h2>
            </div>
            <div class="row">
                <form method="post">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" name="username" class="form-control" id="username" required="required"
                               value="<?
                        if(isset($_SESSION['reg_data']['username'])) {
                            echo $_SESSION['reg_data']['username'];
                        }
                        ?>">
                    </div>
                    <div class="form-group">
                        <label for="contactemail">Email address:</label>
                        <input type="email" name="contactemail" class="form-control" id="contactemail" required="required"
                               value="<?
                        if(isset($_SESSION['reg_data']['contactemail'])) {
                            echo $_SESSION['reg_data']['contactemail'];
                        }
                        ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password" class="form-control" id="password" required="required"
                               value="<?
                        if(isset($_SESSION['reg_data']['password'])) {
                            echo $_SESSION['reg_data']['password'];
                        }
                        ?>">
                    </div>
                    <div class="form-group">
                        <label for="password2">Re-type password:</label>
                        <input type="password" name="password2" class="form-control" id="password2" required="required"
                               value="<?
                        if(isset($_SESSION['reg_data']['password2'])) {
                            echo $_SESSION['reg_data']['password2'];
                        }
                        ?>">
                    </div>
                    <div class="error" style="color:red">
                        <?
                        if(isset($_SESSION['pass_match_err'])) {
                            echo $_SESSION['pass_match_err'];
                            }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="plan">Plan</label>
                        <select name ="plan" name="plan" class="form-control"  id="plan" required="required">
                            <?php
                            foreach ($selectPlanValues as $val) {
                                echo "<option value = '$val'>$val</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="domain">Domain</label>
                        <input type="text" name="domain" class="form-control" id="domain" required="required"
                               value="<?
                        if(isset($_SESSION['reg_data']['domain'])) {
                            echo $_SESSION['reg_data']['domain'];
                            //unset($_SESSION['reg_data']['domain']);
                        }
                        ?>">
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>

                    <div class="error" style="color:red">
                    <?
                    if(isset($_SESSION['err'])) {
                        echo $_SESSION['err'];
                        //unset($_SESSION['err']);
                    }
                    ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>

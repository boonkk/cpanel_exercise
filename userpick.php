<?php
require_once('userDaoWHM/WHMApiUserDAO.php');
require_once ('service/UserService.php');

session_start();
$userService = new UserService(new WHMApiUserDAO());


if(isset($_SESSION['selectedUser']))
    unset($_SESSION['selectedUser']);
if(isset($_SESSION['err']))
    unset($_SESSION['err']);

$accounts = $userService->listUsers();

?>
<!DOCTYPE HTML>
<body>
<link rel="stylesheet" href="view/css/bootstrap.css">
<link rel="stylesheet" href="view/css/bootstrap-grid.css">
<link rel="stylesheet" href="view/css/bootstrap-reboot.css">
<link rel="stylesheet" href="view/css/bootstrap-utilities.css">
</body>
<head>
    <div class="container">
        <div class="row">
            <div class="col-4">
                <? if(isset($_SESSION['changes_succesful']))
                    echo "Changes succesful";?>
                <form method="post" action="manage.php">
                    <div class="form-group">
                        <label for="userSelect">Select user: </label>
                        <select name="selectedUser" class="form-control" id="userSelect" required="required">
                            <?php
                            foreach ($accounts as $username) {
                                echo "<option value = '$username'>$username</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Manage user">
                    </div>
                    <div>
                        <a href="index.php">Home</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</head>


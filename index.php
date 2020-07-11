<?php
session_start();
if(isset($_SESSION['reg_data']))
    unset($_SESSION['reg_data']);
if(isset($_SESSION['err']))
    unset($_SESSION['err']);
if(isset($_SESSION['pass_match_err'])) {
    unset ($_SESSION['pass_match_err']);
}
?>
<!DOCTYPE HTML>
<head>
    <meta charset="utf-8"/>
    <title>cPanel manager</title>
    <link rel="stylesheet" href="view/css/bootstrap.css">
    <link rel="stylesheet" href="view/css/bootstrap-grid.css">
    <link rel="stylesheet" href="view/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="view/css/bootstrap-utilities.css">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-4 justify-content-center">
                <ul class="list-group">
                    <li class="list-group-item"><h2>Cpanel Manager</h2></li>
                    <li class="list-group-item"><a href="create.php">Create new account</a></li>
                    <li class="list-group-item"><a href="userpick.php">Manage existing accounts</a></li>
                    <li class="list-group-item"><a href="listaccounts.php">List accounts</a></li>
                </ul>

        </div>
    </div>
</div>
</body>




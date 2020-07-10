<?php
session_start();
if(isset($_SESSION['reg_data']))
    unset($_SESSION['reg_data']);
if(isset($_SESSION['err']))
    unset($_SESSION['err']);
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
            <div class="card card-block my-5">
                <h2>Cpanel Manager</h2>
                <div>
                    <a href="create.php">Create new account</a>
                </div>
                <div>
                    <a href="userpick.php">Manage existing accounts</a>
                </div>
            </div>

        </div>
    </div>
</div>
</body>




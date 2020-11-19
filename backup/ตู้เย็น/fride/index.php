<?php
session_start();
require_once('functions.php');

$_SESSION['sess_u_type'] = isset($_SESSION['sess_u_type']) ? $_SESSION['sess_u_type'] : "";
check_already_login($_SESSION['sess_u_type']);

$obj_dbcon = new dbcon;
if (isset($_POST['submit-login'])) {
    if (!empty($_POST['txt_user']) and !empty($_POST['txt_pass'])) {
        $u_user = $_POST['txt_user'];
        $u_pass = $_POST['txt_pass'];
        $signin = $obj_dbcon->signin($u_user, $u_pass);
        $num_fet_signin = $signin->num_rows;
        $show_status = null;
        if (!$num_fet_signin > 0) {
            $show_status = "<small style='color:red'>Login ผิดพลาด กรุณาลองใหม่อีกครั้ง</small>";
        } else {
            $fetch_u = $signin->fetch_array();
            $_SESSION['sess_u_id'] = $fetch_u['u_id'];
            $_SESSION['sess_u_user'] = $fetch_u['u_user'];
            $_SESSION['sess_u_type'] = $fetch_u['u_type'];
            if ($_SESSION['sess_u_type'] == 'admin') {
                header('Location: admin/index.php');
            } else if ($_SESSION['sess_u_type'] == 'user') {
                header('Location: user/index.php');
            } else {
                echo "มึงเป็นใครเนี่ยสัส";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Login..</title>
</head>

<body style="background-color: #fafafa;">

    <div class="container">
        <div class="card mt-5 mx-auto border border-primary" style="max-width:500px;">
            <div class="card-header bg-primary text-light">
                <h2 align="center">Login Page</h2>
            </div>
            <div class="card-body mb-2">
                <div class="row">
                    <div class="col-lg-12">
                        <form method="POST">
                            <div class="form-group row">
                                <label for="username" class="col-lg-3 col-form-label text-lg-right"><b>Username</b></label>
                                <div class="col-lg-9">
                                    <input name="txt_user" type="text" class="form-control" id="username" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-lg-3 col-form-label text-lg-right"><b>Password</b></label>
                                <div class="col-lg-9">
                                    <input name="txt_pass" type="password" class="form-control" id="password" required>
                                </div>
                            </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-lg-9 col-sm-12">
                        <button name="submit-login" class="btn btn-outline-primary btn-block">Login</button>
                        <?php if (!empty($show_status)) {
                            echo $show_status;
                        } ?>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>
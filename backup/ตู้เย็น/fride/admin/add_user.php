<?php include_once('header.php'); ?>
<?php

$obj_dbcon = new dbcon;

if (isset($_POST['submit'])) {

    $recv_pms = null;
    foreach($_POST['permission'] as $list_pms){
        $recv_pms .= $list_pms.',';
    }

    $u_pms = substr($recv_pms,0,-1);

    $u_user = $_POST['txt_user'];
    $u_pass = $_POST['txt_pass'];
    $u_pass_check = $_POST['txt_pass_check'];
    $u_email = $_POST['txt_email'];
    $u_tel = $_POST['txt_tel'];

    if ($u_pass != $u_pass_check) {
        echo "<script>alert('รหัสผ่านไม่ตรงกัน')</script>";
        echo "<script>window.location.href='add_user.php'</script>";
        exit();
    }

    $check_user_already = $obj_dbcon->check_user_already($u_user);
    if ($check_user_already->num_rows > 0) {
        echo "<script>alert('มีชื่อ Username นี้อยู่ในระบบแล้ว')</script>";
        echo "<script>window.location.href='add_user.php'</script>";
        exit();
    }

    $opr_adduser = $obj_dbcon->add_user($u_user, $u_pass, $u_email, $u_tel, $u_pms);
    if (!$opr_adduser) {
        echo "<script>alert('ผิดพลาด')</script>";
        echo "<script>window.history.back()</script>";
    } else {
        echo "<script>alert('เพิ่ม User สำเร็จ !!')</script>";
        echo "<script>window.location.href='show_user.php'</script>";
    }
}
?>
<title>Add User</title>
</head>

<body>

    <?php require_once('import_navbar.php'); ?>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-success text-light">
                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add User
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="form-group row">
                        <label for="txt_user" class="col-sm-2 col-form-label text-sm-right">Username</label>
                        <div class="col-sm-10">
                            <input name="txt_user" type="text" class="form-control" id="txt_user" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txt_pass" class="col-sm-2 col-form-label text-sm-right">Password</label>
                        <div class="col-sm-10">
                            <input name="txt_pass" type="password" class="form-control" id="txt_pass" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txt_pass" class="col-sm-2 col-form-label text-sm-right">Confrim Password</label>
                        <div class="col-sm-10">
                            <input name="txt_pass_check" type="password" class="form-control" id="txt_pass" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txt_email" class="col-sm-2 col-form-label text-sm-right">E-mail</label>
                        <div class="col-sm-10">
                            <input name="txt_email" type="email" class="form-control" id="txt_email" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txt_tel" class="col-sm-2 col-form-label text-sm-right">Tel</label>
                        <div class="col-sm-10">
                            <input name="txt_tel" type="text" class="form-control" id="txt_tel" maxlength="10" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txt_tel" class="col-sm-2 col-form-label text-sm-right">Access</label>
                        <div class="col-sm-10 mt-2">
                            <?php
                                $obj_list = new dbcon();
                                $sql_list = $obj_list->listCheckBoxDevice();
                                while($sql_list_row = $sql_list->fetch_array()){
                            ?>
                            <div class="form-check">
                                <input name="permission[]" class="form-check-input" type="checkbox" value="<?php echo$sql_list_row['dv_id'];?>" id="defaultCheck<?php echo$sql_list_row['dv_id'];?>">
                                <label class="form-check-label" for="defaultCheck<?php echo$sql_list_row['dv_id'];?>"><?php echo$sql_list_row['dv_name'];?></label>
                            </div>
                                <?php } ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label text-right"></label>
                        <div class="col-sm-10">
                            <input type="submit" name="submit" class="btn btn-success" value="Save">
                        </div>
                    </div>
                </form>

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
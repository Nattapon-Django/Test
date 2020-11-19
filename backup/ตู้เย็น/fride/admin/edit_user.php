<?php include_once('header.php'); ?>
<?php
$obj_dbcon = new dbcon;

$your_id = $obj_dbcon->fetch_user_id($_GET['u_id']);
$fetch_your_id = $your_id->fetch_array();

$u_id = $_GET['u_id'];

if(isset($_POST['submit'])){
    if(isset($_POST['permission'])){
        $recv_pms = null;
        foreach($_POST['permission'] as $list_pms){
            $recv_pms .= $list_pms.',';
        }
    
        $u_pms = substr($recv_pms,0,-1);
    }
    $u_pms = isset($u_pms) ? $u_pms : "";

    $u_pass = $_POST['txt_pass'];
    $u_pass_check = $_POST['txt_pass_check'];
    $u_email = $_POST['txt_email'];
    $u_tel = $_POST['txt_tel'];

    if($u_pass!=$u_pass_check){
        echo "<script>alert('รหัสผ่านไม่ตรงกัน')</script>";
        echo "<script>window.history.back()</script>";
        exit();
    }


    $opr_update = $obj_dbcon->update_profile_by_admin($u_id, $u_pass, $u_email, $u_tel, $u_pms);
    if(!$opr_update){
        echo "<script>alert('ผิดพลาด')</script>";
        echo "<script>window.history.back()</script>";
    }else{
        echo "<script>alert('แก้ไขสำเร็จ !!')</script>";
        // echo "<script>window.location.href='show_user.php'</script>";
    }
}

?>

<title>แก้ไขโปรไฟล์</title>
</head>

<body>

    <?php require_once('import_navbar.php'); ?>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-warning text-dark">
            <i class="fa fa-pencil" aria-hidden="true"></i> Edit User
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="form-group row">
                        <label for="txt_user" class="col-sm-2 col-form-label text-sm-right">Username</label>
                        <div class="col-sm-10">
                            <input name="txt_user" readonly type="text" class="form-control" id="txt_user" value="<?php echo$fetch_your_id['u_user']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txt_pass" class="col-sm-2 col-form-label text-sm-right">Password</label>
                        <div class="col-sm-10">
                            <input name="txt_pass" type="password" class="form-control" id="txt_pass" value="<?php echo$fetch_your_id['u_pass']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txt_pass" class="col-sm-2 col-form-label text-sm-right">Confrim Password</label>
                        <div class="col-sm-10">
                            <input name="txt_pass_check" type="password" class="form-control" id="txt_pass" value="<?php echo$fetch_your_id['u_pass']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txt_email" class="col-sm-2 col-form-label text-sm-right">E-mail</label>
                        <div class="col-sm-10">
                            <input name="txt_email" type="email" class="form-control" id="txt_email" value="<?php echo$fetch_your_id['u_email']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txt_tel" class="col-sm-2 col-form-label text-sm-right">Tel</label>
                        <div class="col-sm-10">
                            <input name="txt_tel" type="text" class="form-control" id="txt_tel" maxlength="10" value="<?php echo$fetch_your_id['u_tel']; ?>">
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
                                <input name="permission[]" class="form-check-input" type="checkbox" value="<?php echo$sql_list_row['dv_id'];?>" id="defaultCheck<?php echo$sql_list_row['dv_id'];?>"  
                                    <?php
                                        $obj_checkbox = new dbcon();
                                        $array_permission = $obj_checkbox->get_user_permission($u_id);
                                        foreach($array_permission as $listbox){
                                            if($sql_list_row['dv_id']==$listbox){ echo 'checked';}
                                        }
                                    ?>
                                >
                                <label class="form-check-label" for="defaultCheck<?php echo$sql_list_row['dv_id'];?>"><?php echo$sql_list_row['dv_name'];?></label>
                            </div>
                                <?php } ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label text-right"></label>
                        <div class="col-sm-10">
                            <input type="submit" name="submit" class="btn btn-warning" value="Save">
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
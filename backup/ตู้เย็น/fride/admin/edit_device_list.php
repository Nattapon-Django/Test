<?php include_once('header.php'); ?>
<?php
$obj_dbcon = new dbcon;

$your_id = $obj_dbcon->fetch_device_id($_GET['dv_id']);
$fetch_your_id = $your_id->fetch_array();

if(isset($_POST['submit'])){

    $dv_id = $_POST['txt_id'];
    $dv_name = $_POST['txt_name'];
    $dv_detail = $_POST['txt_detail'];

    $dv_t_min = $_POST['txt_t_min'];
    $dv_t_max = $_POST['txt_t_max'];

    $dv_s_min = $_POST['txt_s_min'];
    $dv_s_max = $_POST['txt_s_max'];

    $dv_line_tk = $_POST['txt_line_tk'];


    $opr_update = $obj_dbcon->update_device($dv_id , $dv_name , $dv_detail , $dv_t_min , $dv_t_max , $dv_s_min , $dv_s_max , $dv_line_tk);
    if(!$opr_update){
        echo "<script>alert('ผิดพลาด')</script>";
        echo "<script>window.history.back()</script>";
    }else{
        echo "<script>alert('แก้ไขสำเร็จ !!')</script>";
        echo "<script>window.location.href='index.php'</script>";
    }
}

?>

<title>Edit Device</title>
</head>

<body>

    <?php require_once('import_navbar.php'); ?>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-dark text-light">
            <i class="fa fa-pencil" aria-hidden="true"></i> Edit Device
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="form-group row">
                        <label for="txt_id" class="col-sm-2 col-form-label text-sm-right">Number</label>
                        <div class="col-sm-10">
                            <input name="txt_id" readonly type="text" class="form-control" id="txt_id" value="<?php echo$fetch_your_id['dv_id']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txt_name" class="col-sm-2 col-form-label text-sm-right">Device</label>
                        <div class="col-sm-10">
                            <input name="txt_name" type="text" class="form-control" id="txt_name" value="<?php echo$fetch_your_id['dv_name']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txt_detail" class="col-sm-2 col-form-label text-sm-right">Detail</label> <!-- heeyai -->
                        <div class="col-sm-10">
                            <div class="form-group">
                                <textarea name="txt_detail" class="form-control" id="txt_detail"><?php echo$fetch_your_id['dv_detail']; ?></textarea>
                            </div>
                        </div>
                    </div>

                    <h4 style="margin-left: 11.5rem;">Set Alert</h4>
                    <div class="form-group row">
                        <label for="txt_name" class="col-sm-2 col-form-label text-sm-right">Normal Temp</label>
                        <div class="col-sm-2">
                            <input name="txt_t_min" type="number" class="form-control" id="txt_t_min" placeholder="min" value="<?php echo$fetch_your_id['dv_t_min']; ?>">
                        </div><span>-</span>
                        <div class="col-sm-2">
                            <input name="txt_t_max" type="number" class="form-control" id="txt_t_max"  placeholder="max"value="<?php echo$fetch_your_id['dv_t_max']; ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="txt_name" class="col-sm-2 col-form-label text-sm-right">Freed Temp</label>
                        <div class="col-sm-2">
                            <input name="txt_s_min" type="number" class="form-control" id="txt_s_min" placeholder="min" value="<?php echo$fetch_your_id['dv_s_min']; ?>">
                        </div><span>-</span>
                        <div class="col-sm-2">
                            <input name="txt_s_max" type="number" class="form-control" id="txt_s_max"  placeholder="max" value="<?php echo$fetch_your_id['dv_s_max']; ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="txt_name" class="col-sm-2 col-form-label text-sm-right">Line Token</label>
                        <div class="col-sm-10">
                            <input name="txt_line_tk" type="text" class="form-control" id="txt_line_tk" value="<?php echo$fetch_your_id['dv_line_tk']; ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label text-right"></label>
                        <div class="col-sm-10">
                            <input type="submit" name="submit" class="btn btn-warning" value="Edit">
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
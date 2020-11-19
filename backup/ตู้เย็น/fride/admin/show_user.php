<?php include_once('header.php'); 
    $obj_dbcon = new dbcon;

    if(isset($_GET['action'])=='del'){
        $del_id = $_GET['u_id'];
        $opr_del = $obj_dbcon->del_user($del_id);

        if(!$opr_del){
            echo "<script>alert('ผิดพลาดไอควาย')</script>";
            echo "<script>window.history.back()</script>";
        }else{
            echo "<script>alert('ลบสำเร็จ !!')</script>";
            echo "<script>window.location.href='show_user.php'</script>";
        }
    }
?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
<title>`User List</title>
</head>

<body>

    <?php require_once('import_navbar.php'); ?>

    <div class="container mt-5">

        <a href="add_user.php"><button class="btn btn-success mb-3"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add User</button></a>
        <table id="example" class="table table-bordered table-responsive" width="100%">
            <thead class="thead bg-primary text-light">
                <tr>
                    <th scope="col" width="1%">ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Tel</th>
                    <th scope="col" width="1%">Type</th>
                    <th scope="col">Access rights</th>
                    <th scope="col">Mannager</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $obj_dbcon = new dbcon;
                $get_user = $obj_dbcon->fetch_user();
                while ($row_user = $get_user->fetch_array()) {
                ?>
                    <tr>
                        <th scope="row"><?php echo $row_user['u_id']; ?></th>
                        <td><?php echo $row_user['u_user']; ?></td>
                        <td><?php echo $row_user['u_email']; ?></td>
                        <td><?php echo $row_user['u_tel']; ?></td>
                        <td><?php echo $row_user['u_type']; ?></td>
                        <td><?php echo $row_user['u_permission']; ?></td>
                        <td>
                            <a href="edit_user.php?u_id=<?php echo $row_user['u_id']; ?>"><button class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                            <a href="?action=del&u_id=<?php echo $row_user['u_id']; ?>" onclick="return confirm('ยืนยันการลบ?');" ><button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                responsive: true
            });
        });
    </script>
</body>

</html>
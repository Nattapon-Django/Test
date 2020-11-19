<?php include_once('header.php'); ?>

<title>Home</title>
</head>

<body>
  <?php include_once('import_navbar.php'); ?>

  <div class="container mt-5">
  <table class="table table-bordered table-responsive" id="show_device" width="100%">
      <thead>
        <tr>
          <th scope="col" colspan="8" class="bg-secondary text-light">Device list</th>
        </tr>
        <tr>
          <th scope="col" class="align-self-center" width="1%">#</th>
          <th scope="col" width="15%">Device Name</th>
          <th scope="col">Detail</th>
          <th scope="col" width="1%">Status</th>
          <th scope="col" width="1%">VIEW</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $obj_dbcon = new dbcon;

        $user_permission = $obj_dbcon->get_user_permission($_SESSION['sess_u_id']);

        foreach($user_permission as $list_pms){
          $get_device = $obj_dbcon->fetch_device_user($list_pms);
          $fetch = $get_device->fetch_array();
          if(!$fetch){
            echo "<tr><td colspan='8'>ไม่มีข้อมูล</td></tr>";
          }else{
        ?>
          <tr>
            <th scope="row"><?php echo $fetch['dv_id'];?></th>
            <td><?php echo $fetch['dv_name'];?></td>
            <td style="text-align:left;"><?php echo$fetch['dv_detail'];?></td>
            <td><?php echo $check_status_device = $obj_dbcon->check_status_device($fetch['dv_id']);?></td>
            <td><a href="show_device.php?dv_id=<?php echo$fetch['dv_id'];?>"><button class="btn btn-primary btn-sm">INFO</button></a></td>
          </tr>
        <?php  }} ?>
      </tbody>
    </table>

  </div>


  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>
</body>

</html>
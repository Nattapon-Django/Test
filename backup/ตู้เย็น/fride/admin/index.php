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
          <th scope="col" width="1%">Edit</th>
          <th scope="col" width="1%">Status</th>
          <th scope="col" width="1%">VIEW</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $obj_dbcon = new dbcon;
        $get_device = $obj_dbcon->fetch_device();
        while ($fetch_device = $get_device->fetch_array()) {
        ?>
          <tr>
            <th scope="row"><?php echo$fetch_device['dv_id'];?></th>
            <td><?php echo$fetch_device['dv_name'];?></td>
            <td style="text-align:left;"><?php echo$fetch_device['dv_detail'];?></td>
            <td><a href="edit_device_list.php?dv_id=<?php echo $fetch_device['dv_id']; ?>"><button class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a></td>
            <td><?php echo $check_status_device = $obj_dbcon->check_status_device($fetch_device['dv_id']);?></td>
            <td><a href="show_device.php?dv_id=<?php echo$fetch_device['dv_id'];?>"><button class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> INFO</button></a></td>
          </tr>
          
        <?php
        }
        ?>
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
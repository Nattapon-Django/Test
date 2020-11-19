<?php include_once('header.php');
if (isset($_GET['search'])) {
  if (!empty($_GET['start_search']) && !empty($_GET['end_search'])) {

    $get_start = explode('-', $_GET['start_search']);
    $s_month = $get_start[1];
    $s_day = $get_start[2];
    $s_year = $get_start[0];
    $start_search = $s_month . '/' . $s_day . '/' . $s_year;

    $get_start = explode('-', $_GET['end_search']);
    $e_month = $get_start[1];
    $e_day = $get_start[2];
    $e_year = $get_start[0];
    $end_search = $e_month . '/' . $e_day . '/' . $e_year;

    $objdbcon =  new dbcon;
    $fetch = $objdbcon->getID_show_device_search($_GET['dv_id'], $start_search, $end_search);
  }
} else {
  $objdbcon =  new dbcon;
  $fetch = $objdbcon->getID_show_device($_GET['dv_id']);
}
?>

<script src="https://www.gstatic.com/firebasejs/7.6.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.6.1/firebase-database.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
<title>Show Device</title>
</head>

<body>
  <?php include_once('import_navbar.php'); ?>


  <style>

  </style>

  <div class="container my-5">
    <div class="row">
      <div class="col-md-8">
        <h2>Device Number: <?php echo $_GET['dv_id']; ?></h2>
      </div>
      <div class="col-md-4 col-sm-12">
        <div class="d-flex justify-content-center">
          <button class="btn btn-dark mr-2" id="btn_search"><i class="fa fa-search" aria-hidden="true"></i> Advanced Search</button>

          <a href="http://103.91.207.139:1880/ui/#!/<?php echo $_GET['dv_id']; ?>?socketid=bc7euIluVYpV2pgXAACv" target="_blank"><button type="button" class="btn btn-primary mr-2"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</button></a>

          <button class="btn btn-success"><i class="fa fa-download"></i>
            <a href="http://103.91.207.139/csv/device<?php echo $_GET['dv_id']; ?>.csv" style="color:white;text-decoration:none;">Export csv</a>
          </button><br>

        </div>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-lg-8">
        <div class="row my-2">
          <div class="col-12">

          </div>
        </div>
        <div class="row">

          <div class="col-12">

            <div id="show_search" style="display:none;">

              <form action="" method="GET">
                <input type="hidden" name="dv_id" value="<?php echo $_GET['dv_id']; ?>">
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="Start">Start</label>
                    <input name="start_search" type="date" class="form-control" id="Start" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="End">End</label>
                    <input name="end_search" type="date" class="form-control" id="End" required>
                  </div>
                  <div class="form-group col-md-2">
                    <label for="">&nbsp;</label>
                    <button name="search" value="ok" type="submit" class="form-control btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                  </div>
                </div>
              </form>

            </div>

          </div>

        </div>
        <h3>Dashboard</h3>
        <?php
        if (isset($_GET['search']) == 'ok') {
          echo "<p style='color:green'>Search results at $start_search to $end_search <a style='color:blue;text-decoration: underline;cursor: pointer;' onclick='history.back()'>Back to previous</a></p>";
        }
        ?>
        <div class="table-responsive">
          <table id="example" class="table table-striped" style="width:100%;">
            <thead>
              <tr>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col">Temperature</th>
                <th scope="col">Humidity</th>
                <th scope="col">Solution Temp</th>
                <th scope="col">Light</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($row = $fetch->fetch_array()) {
              ?>
                <tr>
                  <th><?php echo $row['Date']; ?></th>
                  <th><?php echo $row['Time']; ?></th>
                  <td><?php echo $row['DHTtemp']; ?></td>
                  <td><?php echo $row['Humidity']; ?></td>
                  <td><?php echo $row['DS18Temp']; ?></td>
                  <td><?php echo $row['LDRLight']; ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-lg-4">
        <!-- i here kruu na hee-->
        <h3>RealTime</h3>
        <div class="box">
          <div class="row">
            <div class="col-6">
              <i class="fa fa-calendar" style="font-size:25px;"></i>
              <div id="date" style="display: inline-block;font-size:20px;color:#727272;">dd-mm-yyyy</div>
              <div style="font-size:11px;color:#727272;">Date</div>
            </div>
            <div class="col-6">
              <i class="fa fa-clock-o" style="font-size:25px;"></i>
              <div id="time" style="display: inline-block;font-size:20px;color:#727272;">00:00:00</div>
              <div style="font-size:11px;color:#727272;">Time</div>
            </div>
          </div>

          <div class="row mt-4">
            <div class="col-6">
              <i class="fa fa-cloud" style="font-size:28px;"></i>
              <div id="humidity" style="display: inline-block;font-size:20px;color:#727272;">0.00</div>
              <div style="display: inline-block;">%</div>
              <div style="font-size:11px;color:#727272;">Humidity</div>
            </div>
            <div class="col-6">
              <i class="fa fa-thermometer" style="font-size:28px;"></i>
              <div id="temperature" style="display: inline-block;font-size:20px;color:#727272;">0.00</div>
              <div style="display: inline-block;">&#176;C</div>
              <div style="font-size:11px;color:#727272;">Temperature</div>
            </div>
          </div>

          <div class="row mt-4">
            <div class="col-6">
              <i class="fa fa-sun-o" aria-hidden="true" style="font-size:28px;"></i>
              <div id="LDR" style="display: inline-block;font-size:20px;color:#727272;">0.00</div>
              <div style="display: inline-block;">&nbsp;lx</div>
              <div style="font-size:11px;color:#727272;">Light</div>
            </div>
            <div class="col-6">
              <i class="fa fa-thermometer" style="font-size:28px;"></i>
              <div id="temperature_ds18b20" style="display: inline-block;font-size:20px;color:#727272;">0.00</div>
              <div style="display: inline-block;">&#176;C</div>
              <div style="font-size:11px;color:#727272;">Solution Temp</div>
            </div>
          </div>
        </div>
      </div>
    </div>




  </div>

  <script>
    // Your web app's Firebase configuration
    var firebaseConfig = {
      apiKey: "AIzaSyBflLKu97xvsv3KCEERts5gzPZhPVcp9ds",
      authDomain: "edufarmresearch-ccd4c.firebaseapp.com",
      databaseURL: "https://edufarmresearch-ccd4c.firebaseio.com",
      projectId: "edufarmresearch-ccd4c",
      storageBucket: "edufarmresearch-ccd4c.appspot.com",
      messagingSenderId: "542407983516",
      appId: "1:542407983516:web:24a7f44d4b6aa92ab34859",
      measurementId: "G-VYBKVGG76Q"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
  </script>
  <script>
    try {
      var date_text = document.getElementById("date");
      var time_text = document.getElementById("time");
      var temperature = document.getElementById("temperature");
      var LDR = document.getElementById("LDR");
      var temperature_ds18b20 = document.getElementById("temperature_ds18b20");
      var humidity_text = document.getElementById("humidity");
      var options_date = {
        year: "numeric",
        month: "2-digit",
        day: "2-digit"
      }
      var export_btn = document.getElementById('export_btn');
      var export_text = document.getElementById('export_text');
      var loading_text = document.getElementById('loading_text');

      //read data from firebase and show on web page
      var reference = firebase.database().ref().child("device<?php echo $_GET['dv_id']; ?>").limitToLast(1);
      reference.on('child_added', function(snapshot2) {
        var data = snapshot2.val();
        date_text.innerHTML = new Date(data.date).toLocaleDateString('th-TH', options_date);
        time_text.innerHTML = data.time;
        temperature.innerHTML = data.temperature;
        LDR.innerHTML = data.LDR;
        temperature_ds18b20.innerHTML = data.temperature_ds18b20;
        humidity_text.innerHTML = data.humidity;
      });

      // var five_latest_val = firebase.database().ref().child("log_data").limitToLast(30);
      // five_latest_val.on('child_added', function(snapshot){
      //   var data_val = snapshot.val();
      //   console.log(data_val.time+" around temp is "+data_val.temperature);
      // });
    } catch (err) {
      console.log(err.message);
    }

    function export_data() {
      export_btn.disabled = true;
      export_text.style.display = 'none';
      loading_text.style.display = 'block';
      console.log('export csv file')
      // create tag <a> for open link to download file
      var link = document.createElement("a");
      link.href = 'https://us-central1-fridge-cute2020.cloudfunctions.net/exportCSV_system';
      //set the visibility hidden so it will not effect on your web-layout
      link.style = "visibility:hidden";
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
      export_btn.disabled = false;
      export_text.style.display = 'block';
      loading_text.style.display = 'none';
    }
  </script>


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
      $('#example').dataTable({
        "order": [
          [0, 'DESC']
        ]
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      $("#btn_search").click(function() {
        $("#show_search").toggle();
      });
    });
  </script>
</body>

</html>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/7.6.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.6.1/firebase-database.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> 
    <title>Dashboard Realtime</title>
  </head>
  <body>

    <style>
      #c1{
        border: 1px solid rgb(179, 179, 179);
        padding: 20px;
      }
    </style>
    <div class="container mt-4">
      <h1 class="text">Realtime</h1>
    </div>
    <div class="container" id="c1">

      <div class="row">
        <div class="col-6">
          <i class="fa fa-calendar" style="font-size:35px;"></i>
          <div id="date" style="display: inline-block;font-size:25px;color:#727272;">dd-mm-yyyy</div>
          <div style="font-size:11px;color:#727272;">Date</div>
        </div>
        <div class="col-6">
          <i class="fa fa-clock-o" style="font-size:35px;"></i>
          <div id="time" style="display: inline-block;font-size:25px;color:#727272;">00:00:00</div>
          <div style="font-size:11px;color:#727272;">Time</div>
        </div>
      </div>

      <div class="row mt-4">
        <div class="col-6">
          <i class="fa fa-cloud" style="font-size:35px;"></i>
          <div id="humidity" style="display: inline-block;font-size:25px;color:#727272;">0.00</div><div style="display: inline-block;">%</div>
          <div style="font-size:11px;color:#727272;">Humidity</div>
        </div>
        <div class="col-6">
          <i class="fa fa-thermometer" style="font-size:35px;"></i>
          <div id="temperature" style="display: inline-block;font-size:25px;color:#727272;">0.00</div><div style="display: inline-block;">&#176;C</div>
          <div style="font-size:11px;color:#727272;">External</div>
        </div>
      </div>

      <div class="row mt-4">
        <div class="col-6">
          <i class="fa fa-thermometer" style="font-size:35px;"></i>
          <div id="LDR" style="display: inline-block;font-size:25px;color:#727272;">0.00</div><div style="display: inline-block;">lx</div>
          <div style="font-size:11px;color:#727272;">Normal Channel</div>
        </div>
        <div class="col-6">
          <i class="fa fa-thermometer" style="font-size:35px;"></i>
          <div id="temperature_ds18b20" style="display: inline-block;font-size:25px;color:#727272;">0.00</div><div style="display: inline-block;">&#176;C</div>
          <div style="font-size:11px;color:#727272;">freezer Channel</div>
        </div>
      </div>

    </div>

   <br>
    <div class="container">
      <div class="row justify-content-end">
        <div class="col">
          <button type="button" class="btn btn-outline-success btn-lg btn-block" id="export_btn" onclick="export_data()">
            <span id="export_text">Export data</span>
            <div id="loading_text" style="display: none;">
              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              <span>Loading...</span>
            </div>
          </button>
          
        </div>
      </div>
    </div>
    <div id="Nut">
    <p>Refreshing in <span id="time-to-update" class="light-blue"></span> seconds.</p>
    </div>
    <script>
      // Your web app's Firebase configuration
      var firebaseConfig = {
        apiKey: "AIzaSyDpwOyZxrCPETU6qiQxtSVn8D2vqhYIYAo",
        authDomain: "fridge-cute2020.firebaseapp.com",
        databaseURL: "https://fridge-cute2020.firebaseio.com",
        projectId: "fridge-cute2020",
        storageBucket: "fridge-cute2020.appspot.com",
        messagingSenderId: "744176408706",
        appId: "1:744176408706:web:753d61ccb00286ca98fc9b",
        measurementId: "G-0W8XKPHJ1Q"

      };
      // Initialize Firebase
      firebase.initializeApp(firebaseConfig);
    </script>
    <script>
      try{
        var date_text = document.getElementById("date");
        var time_text = document.getElementById("time");
        var temperature = document.getElementById("temperature");
        var LDR = document.getElementById("LDR");
        var temperature_ds18b20 = document.getElementById("temperature_ds18b20");
        var humidity_text = document.getElementById("humidity");
        var options_date = {year: "numeric", month: "2-digit", day: "2-digit"}
        var export_btn = document.getElementById('export_btn');
        var export_text = document.getElementById('export_text');
        var loading_text = document.getElementById('loading_text');
        var nus = document.getElementById('Nut');
        
        //read data from firebase and show on web page
        var reference = firebase.database().ref().child("device1").limitToLast(1);
        reference.on('child_added',function(snapshot2){
          var data = snapshot2.val();
          date_text.innerHTML = new Date(data.date).toLocaleDateString('th-TH', options_date);
          time_text.innerHTML = data.time;		
          temperature.innerHTML = data.temperature;
          LDR.innerHTML = data.LDR;
          temperature_ds18b20.innerHTML = data.temperature_ds18b20;
          humidity_text.innerHTML = data.humidity;
          let a = temperature_ds18b20.textContent;
          let b = parseInt(a);
          console.log(b);
          if(b >= 27 && b <= 32){
            // alert("Kang love Yaya");
                var timer = {
                    interval: null,
                    seconds: 4,

                    start: function () {
                        var self = this,
                            el = document.getElementById('time-to-update');

                        el.innerText = this.seconds;

                        this.interval = setInterval(function () {
                            self.seconds--;
                            
                            if (self.seconds == 0) 
                                window.location.reload();

                            el.innerText = self.seconds;
                        }, 1000);
                    },

                    stop: function () {
                        window.clearInterval(this.interval)
                        
                    }
                }

                timer.start();
            <?php
                    define('LINE_API',"https://notify-api.line.me/api/notify");
                    
                    $token = "aGsA3R4APnt2l5pheTz4N6XM0FYMXAN2igN6q7xmSsG"; //ใส่Token ที่copy เอาไว้
                    $str = "ตอนนี้อุณภูมิ "; //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร
                    
                    $res = notify_message($str,$token);
                    print_r($res);
                    function notify_message($message,$token){
                    $queryData = array('message' => $message);
                    $queryData = http_build_query($queryData,'','&');
                    $headerOptions = array( 
                            'http'=>array(
                                'method'=>'POST',
                                'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                                        ."Authorization: Bearer ".$token."\r\n"
                                        ."Content-Length: ".strlen($queryData)."\r\n",
                                'content' => $queryData
                            ),
                    );
                    $context = stream_context_create($headerOptions);
                    $result = file_get_contents(LINE_API,FALSE,$context);
                    $res = json_decode($result);
                    // return $res;
                    }
                    ?>
            nus.innerHTML ="<center>"+b+"</center>";
          }

          // if(temperature_ds18b20 > 10){
          //   alert("Kang love Yaya");
          // }
           
        });

        // var five_latest_val = firebase.database().ref().child("log_data").limitToLast(30);
        // five_latest_val.on('child_added', function(snapshot){
        //   var data_val = snapshot.val();
        //   console.log(data_val.time+" around temp is "+data_val.temperature);
        // });
      }catch(err){
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
  </body>
</html>

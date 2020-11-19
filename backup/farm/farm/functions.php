<?php

define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'farm');

class dbcon
{
    public function __construct()
    {
        $this->dbcon = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

        if ($this->dbcon->connect_error) {
            echo "Cannot connect to database: " . $this->dbcon->connect_error;
        }
    }

    function signin($user, $pass)
    {
        $result = $this->dbcon->query("SELECT u_id,u_user,u_pass,u_type FROM tbl_user WHERE u_user='$user' AND u_pass='$pass' ");
        return $result;
    }

    function fetch_user()
    {
        $result = $this->dbcon->query("SELECT * FROM tbl_user WHERE u_type='user' ");
        return $result;
    }
    function fetch_user_id($id)
    {
        $result = $this->dbcon->query("SELECT * FROM tbl_user WHERE u_id='$id' ");
        return $result;
    }

    function add_user($user, $pass, $email, $tel, $pms)
    {
        $result = $this->dbcon->query("INSERT INTO tbl_user (u_user,u_pass,u_email,u_tel,u_permission) VALUES ('$user','$pass','$email','$tel','$pms')");
        return $result;
    }

    function update_profile($id, $pass, $email, $tel)
    {
        $result = $this->dbcon->query("UPDATE tbl_user SET u_pass='$pass',u_email='$email',u_tel='$tel' WHERE u_id='$id' ");
        return $result;
    }
    function update_profile_by_admin($id, $pass, $email, $tel, $pms)
    {
        $result = $this->dbcon->query("UPDATE tbl_user SET u_pass='$pass',u_email='$email',u_tel='$tel', u_permission='$pms' WHERE u_id='$id' ");
        return $result;
    }

    function check_user_already($user)
    {
        $result = $this->dbcon->query("SELECT u_user FROM tbl_user WHERE u_user='$user' ");
        return $result;
    }
    function fetch_device()
    {
        $result = $this->dbcon->query("SELECT * FROM tbl_device");
        return $result;
    }

    function get_user_permission($sess_id)
    {
        $result_check = $this->dbcon->query("SELECT u_id,u_permission FROM tbl_user WHERE u_id='$sess_id' ");
        $fetch_check = $result_check->fetch_array();
        $explode = explode(",", $fetch_check['u_permission']);
        return $explode;
    }

    function fetch_device_user($list_pms)
    {
        $result = $this->dbcon->query("SELECT * FROM tbl_device WHERE dv_id='$list_pms' ");
        return $result;
    }

    function del_user($u_id)
    {
        $result =  $this->dbcon->query("DELETE  FROM  tbl_user WHERE u_id='$u_id'");
        return $result;
    }

    function getID_show_device($dv_id)
    {
        $result =  $this->dbcon->query("SELECT * FROM tbl_data  WHERE dv_id='$dv_id' ORDER BY data_id DESC LIMIT 800");
        return $result;
    }
    function getID_show_device_search($dv_id,$start_search,$end_search)
    {
        $result =  $this->dbcon->query("SELECT * FROM tbl_data WHERE dv_id='$dv_id' AND Date BETWEEN '$start_search' AND '$end_search' ORDER BY data_id DESC");
        return $result;
    }
    function listCheckBoxDevice()
    {
        $result =  $this->dbcon->query("SELECT * FROM tbl_device  ORDER BY dv_id ASC");
        return $result;
    }
    function fetch_device_id($id)
    {
        $result =  $this->dbcon->query("SELECT * FROM tbl_device  WHERE dv_id='$id' ");
        return $result;
    }
    function update_device($id, $name, $detail)
    {
        $result =  $this->dbcon->query("UPDATE tbl_device SET dv_name='$name', dv_detail='$detail' WHERE dv_id='$id' ");
        return $result;
    }
    function check_status_device($dv_id)
    {
        $result_send = $this->dbcon->query("SELECT *,NOW() as dt_now FROM tbl_data WHERE dv_id='$dv_id' ORDER BY data_id DESC LIMIT 1");
        $fetch_send = $result_send->fetch_array();
        if (!$fetch_send) {
            echo "<button class='btn btn-danger btn-sm'>• Offine</button>";
        } else {

            $recv = $fetch_send['Date'] . ' ' . $fetch_send['Time'];
            $recv_now = $fetch_send['dt_now'];
            $date1 = strtotime("$recv");
            $date2 = strtotime("$recv_now");
            $interval = $date2 - $date1;
            $seconds = $interval % 60;
            $minutes = floor(($interval % 3600) / 60);
            $hours = floor($interval / 3600);
            $hours . ":" . $minutes . ":" . $seconds;
            if ($hours > 0) {
                echo "<button class='btn btn-danger btn-sm'>• Offine</button>";
            }else if($hours >= 0 && $minutes >= 2){
                echo "<button class='btn btn-danger btn-sm'>• Offine</button>";
            }
            else{
                echo "<button class='btn btn-success btn-sm'>• Online</button>";
            }
        }
    }
}


function check_already_login($sess_type)
{
    if (isset($sess_type)) {
        // echo "<script>alert('แก้ไขสำเร็จ !!')</script>";
        if ($sess_type == 'admin') {
            echo "<script>window.location.href='admin/index.php'</script>";
        } else if ($sess_type == 'user') {
            echo "<script>window.location.href='user/index.php'</script>";
        }
    }
}

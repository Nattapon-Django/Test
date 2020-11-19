<?php
session_start();
require_once('../functions.php');

$_SESSION['sess_u_type'] = isset($_SESSION['sess_u_type']) ? $_SESSION['sess_u_type'] : "";

if (!isset($_SESSION['sess_u_id'])) {
    echo "<script>alert('กรุณา Login ก่อนใช้งาน')</script>";
    echo "<script>window.location.href='../index.php'</script>";
}
if(isset($_SESSION['sess_u_id']) && isset($_SESSION['sess_u_type'])){
    if($_SESSION['sess_u_type']!='admin'){
        header('Location: ../user/index.php');
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
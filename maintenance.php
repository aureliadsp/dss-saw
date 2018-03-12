<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Sistem Pendukung Keputusan (DSS-SAW) Penentuan Lokasi Pertenakan | Sign in</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/skin-red.min.css">
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
        <?php
          //USE THIS WHEN BETA
          //$connect_db = mysqli_connect("localhost", "root", ""); // Connect to database server(localhost) with username and password.
          //mysqli_select_db($connect_db, "db_livestockmapping") or die(mysqli_error()); // Select registrations database.

          // USE THIS WHEN LIVE
          $connect_db = mysqli_connect("localhost", "dsswg_admin", "dsssawugm"); // Connect to database server(localhost) with username and password.
          mysqli_select_db($connect_db, "dsswg_livestockmapping") or die(mysqli_error()); // Select registrations database.
          
          if(empty($_SESSION)) // if the session not yet started 
            session_start();

          if(!isset($_SESSION['email'])) { //if not yet logged in
            header("Location: login.php");// send to login page
          exit;
          }
        ?>
        <!-- stop PHP Code -->
              }
<div class="login-box">
    
  <div class="login-logo">
    <img src="assets/icon/ugm_logo.png" width="50" height="50"><br>
    <p align="center"><i><b>Sistem Pendukung Keputusan</b> <br>Penentuan Lokasi Pertenakan </i></p>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <div class="box-header with-border">
      <h3 class="box-title">Sedang Dalam Maintenance</h3>
    </div>
    <div class="box-body">
    <center> Mohon maaf, untuk sementara website ini sedang dalam masa Maintenance.<br>
    Mohon tunggu beberapa saat lagi. </center>
    </div>
    </form>
  </div>
</div>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>
</html>
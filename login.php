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
  <link rel="stylesheet" href="dist/css/AdminLTE.css">
  <link rel="stylesheet" href="dist/css/skins/skin-red.css">
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
        <?php
          //USE THIS WHEN BETA
          $connect_db = mysqli_connect("localhost", "root", ""); // Connect to database server(localhost) with username and password.
          mysqli_select_db($connect_db, "db_livestockmapping") or die(mysqli_error()); // Select registrations database.

          // USE THIS WHEN LIVE
          //$connect_db = mysqli_connect("localhost", "dsswg_admin", "dsssawugm"); // Connect to database server(localhost) with username and password.
          //mysqli_select_db($connect_db, "dsswg_livestockmapping") or die(mysqli_error()); // Select registrations database.

          if(isset($_POST['email']) && !empty($_POST['email']) AND isset($_POST['password']) && !empty($_POST['password']))
          {
            $email = mysqli_escape_string($connect_db, $_POST['email']); // Set variable for the username
            $password = mysqli_escape_string($connect_db, md5($_POST['password'])); // Set variable for the password and convert it to an MD5 hash.

            $search = mysqli_query($connect_db, "SELECT email, full_name, password, active FROM tb_userdata WHERE email='".$email."' AND password='".$password."' AND active='1'") or die(mysqli_error()); 
            $match  = mysqli_num_rows($search);

            if($match > 0)
            {
              $msg = 'Login Complete! Thanks';
              session_start();
              $_SESSION['email'] = $email;
              while( $row = mysqli_fetch_array($search) )
              {
                $_SESSION['user_name'] = $row['full_name'];
              }
              $status = 1;
              header('Location:index.php');
            }
            else
            {
              $status = 0;
              $msg = 'Sign in Gagal! Mohon cek kembali data yang anda masukkan benar dan akun anda telah di aktif.';
            }
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
    <?php 
          if ( isset($msg) && $status == 1 )
          {  // SUCCESS
            echo '<div class="alert alert-success alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <h4><i class="icon fa fa-check"></i> Sign In sukses!</h4>'.$msg.'</div>';
            $status = 0;
          }
          else if (isset($msg) && $status == 0 )
          { // FAIL
            echo '<div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h4><i class="icon fa fa-ban"></i> Sign In gagal!</h4>'.$msg.'</div>';
          }
    ?>
    <div class="box-header with-border">
      <h3 class="box-title">Silahkan Log in terlebih dahulu</h3>
    </div>
    <form class="form-horizontal" method="post" action="">
    <div class="box-body">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" id="email" placeholder="Masukkan E-mail anda" name="email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" id="password" placeholder="Masukkan password anda" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-4">
          <button type="submit" class="btn btn-info btn-block btn-flat">Log In</button>
        </div>
      </div>
      </div>
    </form>
    <a href="signup.php" class="text-center">Tidak memiliki akun? Silahkan daftar.</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</html>
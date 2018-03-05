<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Livestock Mapping using DSS-SAW | Home</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme -->
  <link rel="stylesheet" href="dist/css/AdminLTE.css">
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
        <?php
          $connect_db = mysqli_connect("localhost", "root", ""); // Connect to database server(localhost) with username and password.
          mysqli_select_db($connect_db, "db_livestockmapping") or die(mysqli_error()); // Select registrations database.

          if(isset($_POST['email']) && !empty($_POST['email']) AND isset($_POST['password']) && !empty($_POST['password']))
          {
            $email = mysqli_escape_string($connect_db, $_POST['email']); // Set variable for the username
            $password = mysqli_escape_string($connect_db, md5($_POST['password'])); // Set variable for the password and convert it to an MD5 hash.

            $search = mysqli_query($connect_db, "SELECT email, password, active FROM tb_userdata WHERE email='".$email."' AND password='".$password."' AND active='1'") or die(mysqli_error()); 
            $match  = mysqli_num_rows($search);

            if($match > 0)
            {
              $msg = 'Login Complete! Thanks';
              session_start();
              $_SESSION['email'] = $email;
              $status = 1;
              header('Location:index.php');
            }
            else
            {
              $status = 1;
              $msg = 'Login Failed! Please make sure that you enter the correct details and that you have activated your account.';
            }
          }    
        ?>
        <!-- stop PHP Code -->
              }
<div class="login-box">
    
  <div class="login-logo">
    <a href=""><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <?php 
          if ( isset($msg) && $status == 1 )
          {  // SUCCESS
            echo '<div class="alert alert-success alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <h4><i class="icon fa fa-check"></i> Sign In success!</h4>'.$msg.'</div>';
            $status = 0;
          }
          else if (isset($msg) && $status == 0 )
          { // FAIL
            echo '<div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h4><i class="icon fa fa-ban"></i> Sign In failed!</h4>'.$msg.'</div>';
          }
    ?>
    <p class="login-box-msg">Please sign in first!</p>

    <form class="form-horizontal" method="post" action="">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" id="email" placeholder="Enter your e-mail" name="email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-4">
          <button type="submit" class="btn btn-info btn-block btn-flat">Sign In</button>
        </div>
      </div>
    </form>
    <a href="signup.php" class="text-center">Don't have an account? Register here.</a>

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
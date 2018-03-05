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
<body class="hold-transition register-page">
  <?php
    // ---------------------------------------------------------------------------------- START PHP 
    $connect_db = mysqli_connect("localhost", "root", ""); // Connect to database server(localhost) with username and password.
    mysqli_select_db($connect_db, "db_livestockmapping") or die(mysqli_error()); // Select registrations database.
            
    if(isset($_POST['fullname']) && !empty($_POST['fullname']) AND 
        isset($_POST['studentid']) && !empty($_POST['studentid']) AND
        isset($_POST['email']) && !empty($_POST['email']) AND
        isset($_POST['password']) && !empty($_POST['password']))
    {
      // Get from post form
      $fullname = mysqli_escape_string($connect_db, $_POST['fullname']);
      $studentid = mysqli_escape_string($connect_db, $_POST['studentid']);
      $email = mysqli_escape_string($connect_db, $_POST['email']);
      $password = mysqli_escape_string($connect_db, $_POST['password']);
            
      if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $email)) // check spam
      {
        $msg = 'The email you have entered is invalid, please try again.';
        $status = 0;
      }
      else
      {
        $msg = 'Your account has been made, <br /> please verify it by clicking the activation link that has been send to your email.';
        $status = 1;
        $hash = md5( rand(0,1000) ); // Generate random 32 character hash and assign it to a local variable.
        $uid = 'UID';
        $userid = $uid . strval(rand(1000,9000));

        mysqli_query($connect_db, "INSERT INTO tb_userdata (user_id, full_name, student_id, email, password, hash) VALUES(
                    '". mysqli_escape_string($connect_db, $userid) ."',
                    '". mysqli_escape_string($connect_db, $fullname) ."',
                    '". mysqli_escape_string($connect_db, $studentid) ."',
                    '". mysqli_escape_string($connect_db, $email) ."',
                    '". mysqli_escape_string($connect_db, md5($password)) ."', 
                    '". mysqli_escape_string($connect_db, $hash) ."') 
                    ") or die(mysqli_error());
          $to      = $email; // Send email to our user
          $subject = 'Sign up verification - DSS-SAW new account'; // Give the email a subject 
          $message = '
                      Thanks for signing up on DSS-SAW Faculty of Animal Science UGM!
                      Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.

                      ------------------------
                      Full name: '.$fullname.'
                      E-mail : '.$email.'
                      ------------------------
                                 
                      Please click this link to activate your account:
                      http://localhost/loginsystem/verify.php?email='.$email.'&hash='.$hash.'
                          
                      '; // Our message above including the link
                     
          $headers = 'From:noreply@dss.wg.ugm.ac.id' . "\r\n"; // Set header
          mail($to, $subject, $message, $headers); // Send our email
      }
    }
  // ------------------------------------------------------------------------------------ STOP PHP  
  ?>
  <!-- SIGN UP FORM -->
  <div class="register-box">
    <div class="login100-form-title" style="background-image: url(images/bg-01.jpg);"></div> 
    <div class="register-box-body">
        <?php 
          if ( isset($msg) && $status == 1 )
          {  // SUCCESS
            echo '<div class="alert alert-success alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <h4><i class="icon fa fa-check"></i> Sign Up success!</h4>'.$msg.'</div>';
          }
          else if (isset($msg) && $status == 0 )
          { // FAIL
            echo '<div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h4><i class="icon fa fa-ban"></i> Sign Up failed!</h4>'.$msg.'</div>';
          }
        ?>
          <div class="box-header with-border">
            <h3 class="box-title">Sign Up</h3>
          </div>
          <!-- form start -->
          <form class="form-horizontal" method="post" action="">
            <div class="box-body">

              <div class="form-group"> <!-- Full name -->
                <label for="fullname" class="col-sm-3 control-label">Nama Lengkap</label>

                <div class="col-sm-9">
                  <input type="text" class="form-control" id="fullname" placeholder="Please enter your full name" name="fullname" />
                </div>
              </div> <!-- /Full name -->

              <div class="form-group"> <!-- Student ID -->
                <label for="studentid" class="col-sm-3 control-label">NIM </label>

                <div class="col-sm-9">
                  <input type="text" class="form-control" id="studentid" placeholder="ex: 15/xxxxxx/PA/xxxxx" name="studentid" />
                </div>
              </div> <!-- /Student ID -->

              <div class="form-group"> <!-- E-mail -->
                <label for="email" class="col-sm-3 control-label">E-mail</label>

                <div class="col-sm-9">
                  <input type="email" class="form-control" id="email" placeholder="ex: youremail@ugm.ac.id" name="email" />
                </div>
              </div> <!-- /E-mail -->

              <div class="form-group"> <!-- Password -->
                <label for="password" class="col-sm-3 control-label">Password</label>

                <div class="col-sm-9">
                  <input type="password" class="form-control" id="password" placeholder="Please enter your password" name="password" />
                </div>
              </div> <!-- /Password -->

            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-info pull-right">Sign up</button>
            </div>
          </form>
      </div>
    </div>    
  </body>
</html>
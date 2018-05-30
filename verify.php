<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Sistem Pendukung Keputusan (DSS-SAW) Penentuan Lokasi Pertenakan | Verify Account</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/skin-red.min.css">
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
  <div class="register-box">
    <div class="register-box-body">
        <div class="box-body">

        <?php
          // USE WHEN LIVE
          //$connect_db = mysqli_connect("localhost", "dsswg_admin", "dsssawugm"); // Connect to database server(localhost) with username and password.
          //mysqli_select_db($connect_db, "dsswg_livestockmapping") or die(mysqli_error()); // Select registrations database.

          // USE WHEN BETA
          $connect_db = mysqli_connect("localhost", "root", ""); // Connect to database server(localhost) with username and password.
          mysqli_select_db($connect_db, "db_livestockmapping") or die(mysqli_error()); // Select registrations database.

             
            if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']))
            {
                // Verify data
                $email = mysqli_escape_string($connect_db, $_GET['email']); // Set email variable
                $hash = mysqli_escape_string($connect_db, $_GET['hash']); // Set hash variable

                $search = mysqli_query($connect_db, "SELECT email, hash, active FROM tb_userdata WHERE email='".$email."' 
                                        AND hash='".$hash."' AND active='0'") or die(mysqli_error()); 
                $match  = mysqli_num_rows($search);
                echo $match; // Display how many matches have been found -> remove this when done with testing ;)

                if($match > 0)
                {
                    // We have a match, activate the account
                    mysqli_query($connect_db, "UPDATE tb_userdata SET active='1' WHERE email='".$email."' AND hash='".$hash."' 
                                AND active='0'") or die(mysqli_error());
                    echo '<center><b> Akun anda sudah aktif, silahkan masuk. </b></center>';
                }
                else
                {
                    // No match -> invalid url or account has already been activated.
                    echo '<center><b> URL tidak valid, atau akun anda sudah di aktifkan </b></center>';
                }
            }
            else
            {
                // Invalid approach
                echo '<center><b>Invalid approach, mohon gunakan link yang sudah di kirim melalui e-mail.</center></b>';
            }
        ?>
        </div>
      </div>
    </div>    
  </body>
</html>
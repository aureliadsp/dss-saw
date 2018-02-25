<!DOCTYPE html>
<html>
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
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

      <?php
          $connect_db = mysqli_connect("localhost", "root", ""); // Connect to database server(localhost) with username and password.
          mysqli_select_db($connect_db, "db_livestockmapping") or die(mysqli_error()); // Select registrations database.
      ?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu"> </div>
      <h4><div align="right"> Livestock Mapping by using DSS - SAW </div></h4>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="active"><a href="#"><i class="fa fa-link"></i> <span>Home</span></a></li>
        <li><a href="startDSS.php"><i class="fa fa-link"></i> <span>DSS - SAW</span></a></li>
        <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Data</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="animaldata.php">Animal Data</a></li>
            <li><a href="criteriadata.php">Criteria Data</a></li>
            <li><a href="locationdata.php">Location Data</a></li>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Start SAW
        <small>Optional description</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <form id="input-data-form" action="#">
              <h3>Account</h3>
              <fieldset>
                  <legend>Silahkan pilih hewan ternak :</legend>
           
                  <label for="userName-2">User name *</label>
                  <input id="userName-2" name="userName" type="text" class="required">
                  <label for="password-2">Password *</label>
                  <input id="password-2" name="password" type="text" class="required">
                  <label for="confirm-2">Confirm Password *</label>
                  <input id="confirm-2" name="confirm" type="text" class="required">
                  <p>(*) Mandatory</p>
              </fieldset>
           
              <h3>Profile</h3>
              <fieldset>
                  <legend>Profile Information</legend>
           
                  <label for="name-2">First name *</label>
                  <input id="name-2" name="name" type="text" class="required">
                  <label for="surname-2">Last name *</label>
                  <input id="surname-2" name="surname" type="text" class="required">
                  <label for="email-2">Email *</label>
                  <input id="email-2" name="email" type="text" class="required email">
                  <label for="address-2">Address</label>
                  <input id="address-2" name="address" type="text">
                  <label for="age-2">Age (The warning step will show up if age is less than 18) *</label>
                  <input id="age-2" name="age" type="text" class="required number">
                  <p>(*) Mandatory</p>
              </fieldset>
           
              <h3>Warning</h3>
              <fieldset>
                  <legend>You are to young</legend>
           
                  <p>Please go away ;-)</p>
              </fieldset>
           
              <h3>Finish</h3>
              <fieldset>
                  <legend>Terms and Conditions</legend>
           
                  <input id="acceptTerms-2" name="acceptTerms" type="checkbox" class="required"> <label for="acceptTerms-2">I agree with the Terms and Conditions.</label>
              </fieldset>
          </form>
        <!-- 
            <form action="selectlocation.php" method="GET">
              1. Select animal : 
              <select name="animalsel">
                <?php

                  //$getanimal = mysqli_query($connect_db, "SELECT animal_id, animal_name FROM tb_animal");
                  //while ( $row = mysqli_fetch_array($connect_db, $getanimal) )
                  {
                    //echo "<option value=" . $row['animal_id'] . ">" . $row['animal_name'] . "</option>";
                  }

                  //$sql13 = mysql_query("SELECT loc_id FROM tempresult");
                  //while ($row13 = mysql_fetch_array($sql13))
                  {
                    //$checktemp = $row13['loc_id'];
                  }

                  //if ($checktemp != null) 
                  {
                    //echo "You still got result of previous ";
                  }
                ?>
              </select>
              <br><br><br><br>
              <Input type="Submit" value=" Start " name="submit_animal">
          </form>
        -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<script>
          var form = $("#input-data-form").show();
       
          form.steps({
              headerTag: "h3",
              bodyTag: "fieldset",
              transitionEffect: "slideLeft",
              onStepChanging: function (event, currentIndex, newIndex)
              {
                  // Allways allow previous action even if the current form is not valid!
                  if (currentIndex > newIndex)
                  {
                      return true;
                  }
                  // Forbid next action on "Warning" step if the user is to young
                  if (newIndex === 3 && Number($("#age-2").val()) < 18)
                  {
                      return false;
                  }
                  // Needed in some cases if the user went back (clean up)
                  if (currentIndex < newIndex)
                  {
                      // To remove error styles
                      form.find(".body:eq(" + newIndex + ") label.error").remove();
                      form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
                  }
                  form.validate().settings.ignore = ":disabled,:hidden";
                  return form.valid();
              },
              onStepChanged: function (event, currentIndex, priorIndex)
              {
                  // Used to skip the "Warning" step if the user is old enough.
                  if (currentIndex === 2 && Number($("#age-2").val()) >= 18)
                  {
                      form.steps("next");
                  }
                  // Used to skip the "Warning" step if the user is old enough and wants to the previous step.
                  if (currentIndex === 2 && priorIndex === 3)
                  {
                      form.steps("previous");
                  }
              },
              onFinishing: function (event, currentIndex)
              {
                  form.validate().settings.ignore = ":disabled";
                  return form.valid();
              },
              onFinished: function (event, currentIndex)
              {
                  alert("Submitted!");
              }
          }).validate({
              errorPlacement: function errorPlacement(error, element) { element.before(error); },
              rules: {
                  confirm: {
                      equalTo: "#password-2"
                  }
              }
          });
      </script>
</body>
</html>
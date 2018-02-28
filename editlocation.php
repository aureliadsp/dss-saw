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
  <link rel="stylesheet" href="dist/css/AdminLTE.css">
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
    <!-- DataTables -->
  <link rel="stylesheet" href="../../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

  <?php
    $connect_db = mysqli_connect("localhost", "root", ""); // Connect to database server(localhost) with username and password.
    mysqli_select_db($connect_db, "db_livestockmapping") or die(mysqli_error()); // Select registrations database.

    if( isset( $_GET['selectanimal'] ) )
    {
      $_SESSION['m_animalIDsess'] = $_GET['selectanimal']; // Get animal
      $m_criteriaweight = $_GET['weight']; // Get weight
      $m_location = $_GET['chk_loc']; // Get location

      $m_totalweight = array_sum($m_criteriaweight);
      foreach ($m_criteriaweight as $w) 
      {
        $m_weightfinal[] = number_format((($w / $m_totalweight) * 100),2);
      }

      $_SESSION['m_weightsess'] = $m_weightfinal; // save to session
      $_SESSION['m_locationsess'] = $m_location; // save location to session
      $m_locselected = implode("','", $m_location);

      $querylocedit = mysqli_query($connect_db, "SELECT DISTINCT w.value_total, f.value_total, m.value_total, l.* 
                FROM `tb_locationdata` l
                LEFT OUTER JOIN `tb_waterdata` w
                  ON l.loc_id = w.water_id
                LEFT OUTER JOIN `tb_fodderdata` f
                  ON w.water_id = f.fodder_id
                LEFT OUTER JOIN `tb_mobilitydata` m
                  ON f.fodder_id = m.mobility_id
                WHERE l.loc_id IN ('".$m_locselected."')" );

      $finalcb = array();
      $m_locnewID = array();
      while($rowloc= mysqli_fetch_row($querylocedit)) 
      {
        $finalcb[]= $rowloc;
        $m_locnewID[] = $rowloc['3'];
        $_SESSION['m_locnewID'] = $m_locnewID;
      }
      if(is_array($m_locnewID))
      {
        foreach ($m_locnewID as $id) 
        {
          $sqladdid = mysqli_query($connect_db, "INSERT INTO tb_tempselected SELECT * FROM tb_locationdata WHERE tb_locationdata.loc_id = ('".$id."')");
        }
      }
    }
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
        <li><a href="home.php"><i class="fa fa-link"></i> <span>Home</span></a></li>
        <li class="active"><a href="#"><i class="fa fa-link"></i> <span>DSS - SAW</span></a></li>
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
        <div class="col-xs-12">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h4><b><i class="fa fa-circle-o-notch"></i> Edit data</b></h4>
            </div>
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <br>
              <li class="active"><a href="#tab_1" data-toggle="tab"> <i class="fa fa-paw"></i> Edit data Lokasi </a></li>
            </ul>
            <form action="sawprocess.php" method="get">
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <center>
                    <br>
                    <b>1. Silahkan edit data dari lokasi apabila diperlukan :</b>
                    <br><br>
                    <div class="form-group">
                      <?php

                        /*echo '<pre>'; print_r($m_weightfinal); echo '</pre>';
                        echo '<pre>'; print_r($m_locselected); echo '</pre>';
                        echo '<pre>'; print_r($_SESSION['m_animalIDsess']); echo '</pre>';
                        echo '<pre>'; print_r($_SESSION['m_locationsess']); echo '</pre>';*/
                      ?>
                    <table class="table table-bordered table-stripped">
                    <thead>
                    <tr>
                    <?php
                      $sqlgetcol = mysqli_query($connect_db,"SHOW COLUMNS FROM tb_tempselected");
                      while( $row = mysqli_fetch_array($sqlgetcol) )
                      {
                        echo "<th>" . $row['Field'] . "</th>";
                        $field[] = $row['Field'];
                      }
                    ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    //-------------------------------------------------------SELECT VALUE TO BE EDITED
                      $sqlgetalltemp = mysqli_query($connect_db, "SELECT * FROM tb_tempselected");
                      while($row = mysqli_fetch_row($sqlgetalltemp))
                      {
                        for ($i = 0; $i < count($sqlgetalltemp) ; $i++) 
                        { 
                          echo "<tr>";
                          for ($j = 0; $j < 5 ; $j++) { 
                            echo "<td>" . $row[$j] . "</td>";
                          }
                          for ($j = 5; $j < count($field) ; $j++) 
                          { 
                            echo "<td><input type=\"text\" size=\"4\" name=\"" . $i++ ."[]\" id=\"" .$row[$j] ."\" value=" . $row[$j] . "></td>";
                          }
                        }
                      }
                    ?>
                    </tbody>
                    </table>
                    <a class="btn btn-primary btnNext" >Next</a>
                    <br><br>
                    </div>
                  </center>
                </div>
                <button type="submit" class="btn btn-primary"> Start </button>

                  </center>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="box-footer">
        </div>
        </div>
      </div>
    </div>
  </div>
</section>
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
<!-- DataTables -->
<script src="../../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
</script>
</body>
</html>
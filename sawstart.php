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
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

  <?php
    $connect_db = mysqli_connect("localhost", "root", ""); // Connect to database server(localhost) with username and password.
    mysqli_select_db($connect_db, "db_livestockmapping") or die(mysqli_error()); // Select registrations database.

    if(empty($_SESSION)) // if the session not yet started 
      session_start();

    $sqlanimal = mysqli_query($connect_db, "SELECT animal_id, animal_name FROM tb_animaldata");
    $sqlcriteria = mysqli_query($connect_db, "SELECT cri_id, criteria_name, type_name FROM tb_criteria");
    $sqllocation = mysqli_query($connect_db,"SELECT loc_id, loc_name, loc_district FROM tb_locationdata");
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
              <h4><b><i class="fa fa-circle-o-notch"></i> Pilih hewan dan lokasi</b></h4>
            </div>
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <br>
              <li class="active"><a href="#tab_1" data-toggle="tab"> <i class="fa fa-paw"></i> Pilih hewan </a></li>
              <li><a href="#tab_2" data-toggle="tab"> <i class="fa fa-balance-scale"></i> Edit bobot kriteria </a></li>
              <li><a href="#tab_3" data-toggle="tab"> <i class="fa fa-location-arrow"></i> Pilih lokasi </a></li>
            </ul>
            <form action="editlocation.php" method="get">
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <center>
                    <br>
                    <b>1. Silahkan pilih hewan yang akan di uji :</b>
                    <br><br>
                    <div class="form-group">
                    <select name="selectanimal">
                      <?php
                        while ($rowanimal = mysqli_fetch_array($sqlanimal))
                        {
                          echo "<option value=" . $rowanimal['animal_id'] . ">" . $rowanimal['animal_name'] . "</option>";
                        }
                      ?>
                    </select>
                    <br><br>
                    
                    <a class="btn btn-primary btnNext" >Next</a>
                    <br><br>
                    </div>
                  </center>
                </div>

                <div class="tab-pane" id="tab_2">
                  <div class="form-group">
                  <center>
                  <br><b>2. Silahkan masukan bobot dari masing - masing kriteria :</b><br>
                  <h6>(*mohon masukkan bobot masing-masing kriteria dengan nilai antara 1 - 10 agar mempermudah proses perhitungan.)</h6>
                  <br>
                  <table id="choosecrit" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>ID Kriteria</th>
                        <th>Nama Kriteria</th>
                        <th>Tipe Kriteria</th>
                        <th>Bobot Kriteria</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php
                        while($rowcrit = mysqli_fetch_row($sqlcriteria))
                        {
                          for ($a = 0; $a < 1 ; $a++) 
                          { 
                            echo"<tr>";
                            for ($b = 0; $b < 3 ; $b++) 
                            { 
                              echo "<td>" . $rowcrit[$b] . "</td>";
                            }
                            for($c = 0; $c < 1 ; $c++) 
                            {
                              ?>
                              <script type="text/javascript">
                                function checkForm(form)
                                {
                                  if(form.<?php print_r($rowcrit[$c]) ?>.value < 1) 
                                  {
                                    alert("Error: Enter weight between 1 - 10!");
                                    form.<?php print_r($rowcrit[$c]) ?>.focus();
                                    return false;
                                  }
                                  if(form.<?php print_r($rowcrit[$c]) ?>.value > 10) 
                                  {
                                    alert("Error: Enter weight between 1 - 10!");
                                    form.<?php print_r($rowcrit[$c]) ?>.focus();
                                    return false;
                                  }
                                  return true;
                                }
                              </script> 
                          <?php
                              echo "<td><input type=\"text\" name=\"weight[]\" id=\"" . $rowcrit[$c] ."\"></td></tr>";
                            }
                          }
                        }                 
                      ?>
                      </tbody>
                    </table>
                  <a class="btn btn-primary btnPrevious" >Previous</a>
                  <a class="btn btn-primary btnNext" >Next</a>
                  </div>
                </div>

                <div class="tab-pane" id="tab_3">
                  <div class="form-group">
                    <script type="text/javascript">
                      function checkArray(form, arrayName)
                      {
                        var retval = new Array();
                        for(var i=0; i < form.elements.length; i++) {
                          var el = form.elements[i];
                          if(el.type == "checkbox" && el.name == arrayName && el.checked) {
                              retval.push(el.value);
                          }
                        }
                          return retval;
                      }
                      function checkForm(form)
                      {
                        var itemsChecked = checkArray(form, "chk_loc[]");
                        if(itemsChecked.length < 5) {
                          alert("Please choose at least 5 location!");
                          return false;
                        }
                        return true;
                      }
                    </script>
                  <center>
                  <br><b>3. Silahkan pilih lokasi yang akan di uji dari tabel berikut :</b><br>
                  <h6>(*lokasi yang di pilih minimal 5.)</h6>
                  <div class="box-body">
                  <style>
                    table { table-layout: fixed; }
                    table th, table td { overflow: hidden; }
                  </style>
                  <table id="chooseloc" class="table table-bordered table-striped">
                    <thead>
                    <?php
                      echo "<tr>
                        <th class=\"col-sm-1\"><label><input type=\"checkbox\" id=\"select_all\" /> ALL </label>  </th>
                        <th class=\"col-sm-2\">ID Lokasi</th>
                        <th class=\"col-sm-1\">Nama Lokasi</th>
                        <th class=\"col-sm-1\">Daerah</th>
                      </tr>";
                      ?>
                      </thead>
                      <tbody>
                      <?php
                      while ($rowloc = mysqli_fetch_array($sqllocation))
                      {
                        echo "<tr><td>
                            <label><input type=\"checkbox\" class= \"checkbox\" name=\"chk_loc[]\" value=". $rowloc['loc_id'] ." />
                            </td><td>" . $rowloc['loc_id'] . "</td><td>" . $rowloc['loc_name'] . "</td><td>
                            " . $rowloc['loc_district'] . "</td></tr></label>";
                      }
                      ?>
                    </tbody>
                    </table>
                    <a class="btn btn-primary btnPrevious" >Previous</a>
                    <button type="Submit" name="input_data" class="btn btn-primary"> Edit lokasi </button>

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
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>

<script type="text/javascript">
  $('.btnNext').click(function()
  {
    $('.nav-tabs > .active').next('li').find('a').trigger('click');
  });

  $('.btnPrevious').click(function()
  {
    $('.nav-tabs > .active').prev('li').find('a').trigger('click');
  });

  $(function () {
    $('#chooseloc').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script type="text/javascript">
  $("#select_all").change(function () {
    $("input:checkbox").prop('checked', $(this).prop("checked"));
  });
</script>
</body>
</html>
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
  <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAxoHNZ2GR2NzpmSkLsWXN4AcAVCHExwIA"></script>
  <script type="text/javascript" src="assets/js/jquery.js"></script>
  <script type="text/javascript" src="assets/js/markerclusterer_packed.js"></script>
</head>
<?php
    $connect_db = mysqli_connect("localhost", "root", ""); // Connect to database server(localhost) with username and password.
    mysqli_select_db($connect_db, "db_livestockmapping") or die(mysqli_error()); // Select registrations database.

    if(empty($_SESSION)) // if the session not yet started 
      session_start();

    $loc_finaldata = $_SESSION['FINALRESULT'];
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
            <form action="getscaledata.php" method="get">
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <script type="text/javascript">
                    var peta;
                    var js_locid = new Array();
                    var js_locname = new Array();
                    var js_locdis = new Array();
                    var js_sumres = new Array();
                    var js_status = new Array();
                    var x        = new Array();
                    var y        = new Array();
                    var i;
                    var url;
                    var gambar_tanda;

                    function mymap() {
                        var yogyakarta = new google.maps.LatLng(-7.756370,110.382347);

                        var myStyles =[
                          {
                              featureType: "poi",
                              elementType: "labels",
                              stylers: [
                                    { visibility: "off" }
                              ]
                          }
                        ];

                        var petaoption = {
                            zoom: 10,
                            center: yogyakarta,
                            mapTypeId: google.maps.MapTypeId.ROADMAP,
                            styles: myStyles 
                            };

                        peta = new google.maps.Map(document.getElementById("map_canvas"),petaoption);
                        takedb();

                    }

                    function takedb(){
                        var markers = [];
                        var info = [];
                        
                        <?php
                          $js = "";
                          
                          for ($i = 0; $i < count($loc_finaldata); $i++)
                          {
                            $js .= 'js_locid['.$i.'] = "'.$loc_finaldata[$i]['0'].'";
                                    js_locname['.$i.'] = "'.$loc_finaldata[$i]['1'].'";
                                    js_locdis['.$i.'] = "'.$loc_finaldata[$i]['2'].'";
                                    js_sumres['.$i.'] = "'.$loc_finaldata[$i]['3'].'";
                                    js_status['.$i.'] = "'.$loc_finaldata[$i]['4'].'";
                                    y['.$i.'] = "'.$loc_finaldata[$i]['5'].'";
                                    x['.$i.'] = "'.$loc_finaldata[$i]['6'].'";


                                  '

                          }
                          /*while ($value = mysql_fetch_assoc($query)) {

                          $js .= 'locid1['.$i.'] = "'.$value['loc_id'].'";
                                  name1['.$i.']  = "'.$value['loc_name'].'";
                                  district1['.$i.'] = "'.$value['loc_district'].'";
                                  total1['.$i.'] = "'.$value['sum'].'";
                                  status1['.$i.'] = "'.$value['status'].'";
                                  x['.$i.'] = "'.$value['latitude'].'";
                                  y['.$i.'] = "'.$value['longitude'].'";
                                  set_icon("'.$value['img'].'");
                                  
                                  var point = new google.maps.LatLng(parseFloat(x['.$i.']),parseFloat(y['.$i.']));

                                  var contentString = "<table>"+
                                                              "<tr>"+
                                                                  "<td><b>" + locid1['.$i.'] + "</b></td>"+
                                                              "</tr>"+
                                                              "<tr>"+
                                                                  "<td>" + name1['.$i.'] + ", " + district1['.$i.'] + "</td>"+
                                                              "<tr>"+
                                                                  "<td>Status : <b>" + status1['.$i.'] + "</b></td>"+
                                                              "</tr>"+
                                                              "<tr>"+
                                                                  "<td>Total : <b>" + total1['.$i.'] + "</b></td>"+
                                                              "</tr>"+
                                                          "</table>";

                                  var infowindow = new google.maps.InfoWindow({
                                      content: contentString
                                  });
                                  

                                  tanda = new google.maps.Marker({
                                          position: point,
                                          map: peta,
                                          icon: gambar_tanda,
                                          clickable: true
                                      });
                                  
                                  markers.push(tanda);
                                  info.push(infowindow);

                                  google.maps.event.addListener(markers['.$i.'], "click", function() { info['.$i.'].open(peta,markers['.$i.']); });';

                          
                              $i++;  
                          }*/

                          // kita tampilin deh output jsnya :D
                          echo $js;
                        ?>
                        
                        // nah untuk yang satu ini...kita push semua markernya kedalam array untuk dikelompokan
                        var markerCluster = new MarkerClusterer(peta, markers);
                        
                    }

                    // fungsi inilah yang akan menampilkan gambar ikon sesuai dengan kategori markernya sendiri
                    function set_icon(icon){
                        if (icon == "") {
                        } else {
                            gambar_tanda = "assets/icon/"+icon;
                        }
                    }
                  </script>
                </div>
              </div>
            </div>
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
</body>
</html>
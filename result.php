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
  <link rel="stylesheet" href="dist/css/skins/skin-red.css">
    <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBpp6B9kDPrk0cZRRM4HsKz4Phj79KwNAU&callback=initmap"
  type="text/javascript"></script>
  <script type="text/javascript" src="assets/js/jquery.js"></script>
  <script type="text/javascript" src="assets/js/markerclusterer_packed.js"></script>
</head>
<?php
    $connect_db = mysqli_connect("localhost", "root", ""); // Connect to database server(localhost) with username and password.
    mysqli_select_db($connect_db, "db_livestockmapping") or die(mysqli_error()); // Select registrations database.

    if(empty($_SESSION)) // if the session not yet started 
      session_start();

    $loc_finaldata = $_SESSION['FINALRESULT'];

    usort($loc_finaldata, function($a, $b) {
      return $b['12'] <=> $a['12'];
    });

?>
<body class="hold-transition skin-red layout-top-nav">
<div class="wrapper">

  <!-- Main Header -->
    <header class="main-header">
      <div class="topheader"></div>
        <nav class="navbar navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <a href="index.php" class="navbar-brand"> <img src="assets/icon/ugm_logo.png" width="50" height="50"></a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <i class="fa fa-bars"></i>
              </button>
            </div>
            <div class="navbar-header">
              <a href="index.php" class="navbar-brand"> <i><b>Sistem Pendukung Keputusan</b> <br> Pembantu Penentuan Lokasi Ternak </i></a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <i class="fa fa-bars"></i>
              </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
              <ul class="nav navbar-nav">
                <li class="active"><a href="#"><i class="fa fa-home"></i> Home <span class="sr-only">(current)</span></a></li>
                <li><a href="sawstart.php"><i class="fa fa-balance-scale"></i> Mulai SAW</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-database"></i> Data <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="animaldata.php"><i class="fa fa-paw"></i><span>Data Hewan</span></a></li>
                    <li><a href="criteriadata.php"><i class="fa fa-list-ul"></i><span>Data Kriteria</span></a></li>
                    <li><a href="locationdata.php"><i class="fa fa-location-arrow"></i><span>Data Lokasi</span></a></li>
                  </ul>
                </li>
              </ul>
            </div>
            <!-- /.navbar-collapse -->
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
              <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="dist/img/user-img.jpg" width="100px" height="100px" class="user-image" alt="User Image">
                    <span class="hidden-xs"><?php echo $_SESSION['user_name']; ?></span>
                  </a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="signout.php"><i class="fa fa-sign-out"></i><span> Sign out</span></a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
      </nav>
    </header>

  <div class="content-wrapper">
  <div class="container">
    <section class="content-header">
      <h1>
        Hasil Perhitungan
      </h1>
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
          <div class="box-body">
          
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

            function initmap() {
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
                zoom: 11,
                center: yogyakarta,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                styles: myStyles 
              };

              peta = new google.maps.Map(document.getElementById("map_canvas"),petaoption);
              takedb();
            }

            function takedb() {
              var markers = [];
              var info = [];
                        
              <?php
                $js = "";
                $imgicon = 'point.png';
                          
                for ($i = 0; $i < count($loc_finaldata); $i++)
                {
                  $js .= 'js_locid['.$i.'] = "'.$loc_finaldata[$i]['0'].'";
                          js_locname['.$i.'] = "'.$loc_finaldata[$i]['1'].'";
                          js_locdis['.$i.'] = "'.$loc_finaldata[$i]['2'].'";
                          js_sumres['.$i.'] = "'.$loc_finaldata[$i]['12'].'";
                          js_status['.$i.'] = "'.$loc_finaldata[$i]['5'].'";
                          y['.$i.'] = "'.$loc_finaldata[$i]['3'].'";
                          x['.$i.'] = "'.$loc_finaldata[$i]['4'].'";
                          set_icon("'.$imgicon.'");

                          var point = new google.maps.LatLng(parseFloat(x['.$i.']),parseFloat(y['.$i.']));

                          var contentString = "<table>"+
                                                "<tr>"+
                                                  "<td><b>" + js_locid['.$i.'] + "</b></td>"+
                                                "</tr>"+
                                                "<tr>"+
                                                  "<td>" + js_locname['.$i.'] + ", " + js_locdis['.$i.'] + "</td>"+
                                                "</tr>"+
                                                "<tr>"+
                                                  "<td>Status : <b>" + js_status['.$i.'] + "</b></td>"+
                                                "</tr>"+
                                                "<tr>"+
                                                  "<td>Total : <b>" + js_sumres['.$i.'] + "</b></td>"+
                                                "</tr>"+
                                              "</table>";

                          var infowindow = new google.maps.InfoWindow({
                                            content: contentString });

                          tanda = new google.maps.Marker({
                                    position: point,
                                    map: peta,
                                    icon: gambar_tanda,
                                    clickable: true
                                  });
                                  
                          markers.push(tanda);
                          info.push(infowindow);

                          google.maps.event.addListener(markers['.$i.'], "click", function() { info['.$i.'].open(peta,markers['.$i.']); });';
                }
                echo $js;
              ?>
              // Cluster all markerer
              var markerCluster = new MarkerClusterer(peta, markers);  
              }
              function set_icon(icon){
                if (icon == "") {
                } else {
                  gambar_tanda = "assets/icon/"+icon;
                }
              }
              </script>
              <center>
                <div id="map_canvas" style="width:1050px; height:700px;"></div>
                </center>
                </div>
              </div>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</div>

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>&copy; 2018 <a href="http://fapet.ugm.ac.id/">FAKULTAS PETERNAKAN UGM</a>.</strong>
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
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
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.css">
    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  </head>

  <?php
    $connect_db = mysqli_connect("localhost", "root", ""); // Connect to database server(localhost) with username and password.
    mysqli_select_db($connect_db, "db_livestockmapping") or die(mysqli_error()); // Select registrations database.

    if(empty($_SESSION)) // if the session not yet started 
      session_start();

    if( isset( $_GET['selectanimal'] ) AND isset( $_GET['weight']) AND isset( $_GET['chk_loc']) )
    {
      $_SESSION['m_animalIDsess'] = $_GET['selectanimal']; // Get animal
      $m_criteriaweight = $_GET['weight']; // Get weight
      $m_location = $_GET['chk_loc']; // Get location

      // -------------------------------------------------------------------------- Normalize weight
      $m_totalweight = array_sum($m_criteriaweight);
      foreach ($m_criteriaweight as $w) 
      {
        $m_weightfinal[] = number_format((($w / $m_totalweight) * 100),2);
      }

      $_SESSION['m_weightsess'] = $m_weightfinal; // save to session
      $_SESSION['m_locationsess'] = $m_location; // save location to session

      // ------------------------------------------------------------------------- Copy data from location data to temporary sel
      $querylocedit = mysqli_query($connect_db, "SELECT l.loc_id, l.loc_name, l.loc_district, 
                      l.loc_longitude, l.loc_latitude,  w.value_total, f.value_total, m.value_total, 
                      l.loc_altitude, l.loc_humidity, l.loc_temp
                      FROM tb_locationdata l 
                      JOIN tb_waterdata w ON l.loc_id = w.water_id 
                      JOIN tb_fodderdata f ON l.loc_id = f.fodder_id 
                      JOIN tb_mobilitydata m ON l.loc_id = m.mobility_id 
                      WHERE l.loc_id IN ('" . implode("','",$m_location) . "')" );

      $finalcb = array();
      $m_locnewID = array();
      while($rowloc= mysqli_fetch_row($querylocedit)) 
      {
        $finalcb[]= $rowloc;
        $m_locnewID[] = $rowloc['0'];
        $_SESSION['m_locname'] = $rowloc['1'];
        $_SESSION['m_locnewID'] = $m_locnewID;
      }
    }
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="height: 1000px">
    <div class="container">
    <section class="content-header">
      <h1><small></small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Edit Lokasi</a></li>
        <li class="active"> Edit Lokasi</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <div class="row">
          <div class="box box-solid" style="height: 800px">
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
                  <center>
                    <br>
                    <b> Silahkan edit data dari lokasi apabila diperlukan :</b>
                    <br>(*untuk nilai air, makanan, dan mobilitas, mohon hanya memasukan nilai dengan 0 - 4.
                    <br><br>
                    <div class="form-group">
                    <table id="choosecrit" class="table table-bordered table-striped">
                      <thead>
                      <th> ID Lokasi </th>
                      <th> Nama Lokasi </th>
                      <th> Kabupaten </th>
                      <th> Longitude </th>
                      <th> Latitude </th>
                      <th> K.Air </th>>
                      <th> K.Pakan </th>
                      <th> K.Akses </th>
                      <th> Ketinggian </th>
                      <th> Kelembapan </th>
                      <th> Suhu </th>
                      </thead>
                      <tbody>
                      <?php
                        foreach ( $finalcb as $fbc )
                        {
                          echo "<tr>";
                          $i = 0;
                          foreach ($fbc as $a) 
                          {
                            if ( $i < 5 )
                            {
                              echo "<td>" . $a . "</td>";
                            }
                            else
                            {
                              echo "<td><input type=\"text\" size=\"7\" name=\"inputloc[]\" id=\"" .$a."\" value=" . $a . "></td>";
                            }
                            $i++;
                          }
                          echo "</tr>";
                        }
                      ?>
                    </tbody>
                  </table>
                    <br><br>
                    <button type="Submit" name="update_tempselect" class="btn btn-primary"> Start </button>
                    <br><br>
                    </div>
                </div>
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
</div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>&copy; 2018 <a href="http://fapet.ugm.ac.id/">FAKULTAS PETERNAKAN UGM</a>.</strong>
  </footer>
  <div class="control-sidebar-bg"></div>
</div>
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
</script>
</body>
</html>
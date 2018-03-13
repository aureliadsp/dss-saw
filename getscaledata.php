<?php
if(empty($_SESSION))
{
  session_start();
}
if(!isset($_SESSION['email']))
{
  header("Location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Sistem Pendukung Keputusan (DSS-SAW) Penentuan Lokasi Peternakan | Home</title>
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
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  </head>

  <?php
    $connect_db = mysqli_connect("localhost", "dsswg_admin", "dsssawugm"); // Connect to database server(localhost) with username and password.
    mysqli_select_db($connect_db, "dsswg_livestockmapping") or die(mysqli_error()); // Select registrations database.
    $sql_maxcriteria = mysqli_query($connect_db, "SELECT cri_id FROM tb_criteria");
    while (mysqli_fetch_array($sql_maxcriteria)) 
    {
      $get_maxcriteria[] = $sql_maxcriteria;
    }

    $get_maxcriteria = count($get_maxcriteria);
    $_SESSION['get_maxcriteria'] = $get_maxcriteria;
    //------------------------------------------------------------------------ Store edit data to new variable
    if (isset($_GET['update_tempselect'])) 
    {
      $val_editdata = count($_GET['inputloc']);
      for ($i=0; $i <  $val_editdata; $i++) 
      { 
        $get_editdata[] =$_GET['inputloc'][$i];
      }
    }
    else
    {
      header("Location: sawstart.php");
    }
    //---------------------------------------------------------------------- Chunk array based on criteria
    $chunk_data = array_chunk($get_editdata, $get_maxcriteria);
    $_SESSION['chunk_seldata'] = $chunk_data;
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
              <a href="index.php" class="navbar-brand"> <i><b>Sistem Pendukung Keputusan</b> <br> Penentuan Lokasi Peternakan </i></a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <i class="fa fa-bars"></i>
              </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
              <ul class="nav navbar-nav">
                <li><a href="index.php"><i class="fa fa-home"></i> Home <span class="sr-only">(current)</span></a></li>
                <li  class="active"><a href="#"><i class="fa fa-balance-scale"></i> Mulai SAW</a></li>
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
    <?php
      include ($_SERVER["DOCUMENT_ROOT"] . '/dss-saw/function/scalingdata.php');
      include ($_SERVER["DOCUMENT_ROOT"] . '/dss-saw/function/dsssawprocess.php');

      function generate_value($input)
      {
        foreach ( $input as $key ) 
        {
          if ( $key == 4 ) {
            $status = "Sangat baik";
          }
          else if ( $key == 3 ) {
            $status = "Baik";    
          } 
          else if ( $key == 2 ) {
            $status = "Sedang";
          }
          else if ( $key == 1 ) {
            $status = "Buruk";
          }
          else {
            $status = "Sangat buruk";
          }
          $set_status[] = $status;
        }
        return $set_status;
      }

      function transpose_data($input, $max)
      {
        $chunk = array_chunk($input, $max);

        array_unshift($chunk, null);
          $transposed = call_user_func_array('array_map', $chunk);

        return $transposed;
      }


      $water_status = generate_value($_SESSION['water_value']);
      $fodder_status = generate_value($_SESSION['fodder_value']);
      $mob_status = generate_value($_SESSION['mob_value']);

      $water_merge = array_merge($_SESSION['m_locnewID'], $_SESSION['m_locname'], $_SESSION['water_value'], $water_status);
      $fodder_merge = array_merge($_SESSION['m_locnewID'], $_SESSION['m_locname'], $_SESSION['fodder_value'], $fodder_status);
      $mob_merge = array_merge($_SESSION['m_locnewID'], $_SESSION['m_locname'], $_SESSION['mob_value'], $mob_status);
      $alt_merge = array_merge($_SESSION['m_locnewID'], $_SESSION['m_locname'], $_SESSION['col_alt'], $_SESSION['new_alt']);
      $hum_merge = array_merge($_SESSION['m_locnewID'], $_SESSION['m_locname'], $_SESSION['col_hum'], $_SESSION['new_hum']);
      $tmp_merge = array_merge($_SESSION['m_locnewID'], $_SESSION['m_locname'], $_SESSION['col_temp'], $_SESSION['new_temp']);

      $tb_water = transpose_data($water_merge, count($_SESSION['m_locnewID']));
      $tb_fodder = transpose_data($fodder_merge, count($_SESSION['m_locnewID']));
      $tb_mob = transpose_data($mob_merge, count($_SESSION['m_locnewID']));
      $tb_alt = transpose_data($alt_merge, count($_SESSION['m_locnewID']));
      $tb_hum = transpose_data($hum_merge, count($_SESSION['m_locnewID']));
      $tb_tmp = transpose_data($tmp_merge, count($_SESSION['m_locnewID']));

      $sqlcriteria = mysqli_query($connect_db, "SELECT cri_id, criteria_name, type_name FROM tb_criteria");
      while($row = mysqli_fetch_row($sqlcriteria))
      {
        $criteria_id[] = $row['0'];
        $criteria_name[] = $row['1'];
        $criteria_type[] = $row['2'];
      }
    ?>

  <div class="content-wrapper">
  <div class="container">
    <section class="content-header">
      <h1>
        Scaling Data
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
          <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
        <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title"><li class="fa fa-check"></li> Hasil scaling data kriteria</h3>
          </div>
          <div class="box-body">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_water" data-toggle="tab"> Keadaan Air</a></li>
              <li><a href="#tab_fodder" data-toggle="tab"> Keadaan Pakan</a></li>
              <li><a href="#tab_mob" data-toggle="tab"> Keadaan Akses</a></li>
              <li><a href="#tab_alt" data-toggle="tab"> Ketinggian</a></li>
              <li><a href="#tab_hum" data-toggle="tab"> Kelembapan</a></li>
              <li><a href="#tab_tmp" data-toggle="tab"> Suhu Lokasi</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_water">
                <table class="table table-bordered table-striped">
                  <thead>
                    <th> ID Lokasi </th>
                    <th> Nama Lokasi </th>
                    <th> Value Lokasi </th>
                    <th> Status Lokasi </th>
                  </thead>
                  <tbody>
                      <?php
                        foreach($tb_water as $water)
                        {
                          echo '<tr>';
                          foreach ($water as $wtr) 
                          {
                            echo '<td>' . $wtr . '</td>';
                          }
                          echo '</tr>';
                        }
                      ?>
                  </tbody>
                </table>


              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_fodder">
                <table class="table table-bordered table-striped">
                  <thead>
                    <th> ID Lokasi </th>
                    <th> Nama Lokasi </th>
                    <th> Value Lokasi </th>
                    <th> Status Lokasi </th>
                  </thead>
                  <tbody>
                      <?php                        
                        foreach($tb_fodder as $fodder)
                        {
                          echo '<tr>';
                          foreach ($fodder as $fdr) 
                          {
                            echo '<td>' . $fdr . '</td>';
                          }
                          echo '</tr>';
                        }
                      ?>
                  </tbody>
                </table>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_mob">
                <table class="table table-bordered table-striped">
                  <thead>
                    <th> ID Lokasi </th>
                    <th> Nama Lokasi </th>
                    <th> Value Lokasi </th>
                    <th> Status Lokasi </th>
                  </thead>
                  <tbody>
                      <?php                        
                        foreach($tb_mob as $mobi)
                        {
                          echo '<tr>';
                          foreach ($mobi as $mob) 
                          {
                            echo '<td>' . $mob . '</td>';
                          }
                          echo '</tr>';
                        }
                      ?>
                  </tbody>
                </table>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_alt">
                <table class="table table-bordered table-striped">
                  <thead>
                    <th> ID Lokasi </th>
                    <th> Nama Lokasi </th>
                    <th> Ketinggian </th>
                    <th> Skala </th>
                  </thead>
                  <tbody>
                      <?php                        
                        foreach($tb_alt as $alti)
                        {
                          echo '<tr>';
                          foreach ($alti as $alt) 
                          {
                            echo '<td>' . $alt . '</td>';
                          }
                          echo '</tr>';
                        }
                      ?>
                  </tbody>
                </table>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_hum">
                <table class="table table-bordered table-striped">
                  <thead>
                    <th> ID Lokasi </th>
                    <th> Nama Lokasi </th>
                    <th> Kelembapan </th>
                    <th> Skala </th>
                  </thead>
                  <tbody>
                      <?php                        
                        foreach($tb_hum as $humi)
                        {
                          echo '<tr>';
                          foreach ($humi as $hum) 
                          {
                            echo '<td>' . $hum . '</td>';
                          }
                          echo '</tr>';
                        }
                      ?>
                  </tbody>
                </table>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_tmp">
                <table class="table table-bordered table-striped">
                  <thead>
                    <th> ID Lokasi </th>
                    <th> Nama Lokasi </th>
                    <th> Suhu Lokasi </th>
                    <th> Skala </th>
                  </thead>
                  <tbody>
                      <?php                        
                        foreach($tb_tmp as $temp)
                        {
                          echo '<tr>';
                          foreach ($temp as $tmp) 
                          {
                            echo '<td>' . $tmp . '</td>';
                          }
                          echo '</tr>';
                        }
                      ?>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.tab-content -->
          </div>
          </div>
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>

      <div class="row">
        <div class="col-md-6">
        <div class="box box-solid">
        <div class="box-body">
          <!-- Custom Tabs (Pulled to the right) -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-left">
              <li class="active"><a href="#tab_1-1" data-toggle="tab"> Bobot Kriteria</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1-1">
              <?php
                $merge_weight = array_merge($criteria_id, $criteria_name, $criteria_type, $_SESSION['m_rawweight'], $_SESSION['m_weightsess']);
                $tb_weight = transpose_data($merge_weight, count($_SESSION['m_weightsess']));
              ?>
              <table class="table table-bordered table-striped">
                <thead>
                  <th> ID Kriteria </th>
                  <th> Nama Kriteria </th>
                  <th> Jenis Kriteria </th>
                  <th> Bobot Awal </th>
                  <th> Bobot Setelah Normalisasi </th>
                </thead>
                <tbody>
                <?php                        
                  foreach($tb_weight as $weight)
                  {
                    echo '<tr>';
                    foreach ($weight as $wgt) 
                    {
                      echo '<td>' . $wgt . '</td>';
                    }
                    echo '</tr>';
                  }
                ?>
                </tbody>
              </table>
              </div>
            </div>
            <!-- /.tab-content -->
          </div>
          </div>
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col (left) -->
        <div class="col-md-6">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"> Proses perhitungan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <br>

            Hewan yang di pilih untuk uji ini adalah : <b> <?php echo $_SESSION['animal_name']; ?> </b>, dengan ketahanan suhu minimal <b><?php echo $_SESSION['lower_temp']; ?></b> dan batas suhu maksimal <b><?php echo $_SESSION['upper_temp']; ?></b>.
            <br><br>
            Data di atas merupakan hasil scaling dari data lokasi yang telah di input sebelumnya. Setiap kriteria memiliki ketentuan tersendiri dalam penentuan skalanya.<br><br>
            <center>
            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#directing" id="startcount"> Mulai proses </button>
            </center>
            <!-- Modal -->
            <div class="modal fade" id="directing" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title"> Sedang proses </h4>
                  </div>
                  <div class="modal-body">
                    <br><br>
                      <center> Mohon tunggu sebentar, sedang dalam proses perhitungan. 
                    <br><br>
                      <i class="fa fa-refresh fa-spin"></i>
                      </center>
                    <br><br>
                  </div>
                  <div class="modal-footer">
                  </div>
                </div>     
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col (right) -->
      </div>
      </div>
    </div>
  </section>
  </div>
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
<script type="text/javascript">
$("#startcount").click( function(){
   var counter = 5;
   setInterval(function() {
     counter--;
      if (counter >= 0) {
        //wait
      }
      if (counter === 0) {
         clearInterval(counter);
         window.location = "result.php";
       }
     }, 1000);
});
    
</script>
</body>
</html>
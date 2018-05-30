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
    <title> Sistem Pendukung Keputusan (DSS-SAW) Penentuan Lokasi Peternakan | Data Criteria</title>
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
    // USE WHEN LIVE
    //$connect_db = mysqli_connect("localhost", "dsswg_admin", "dsssawugm"); // Connect to database server(localhost) with username and password.
    //mysqli_select_db($connect_db, "dsswg_livestockmapping") or die(mysqli_error()); // Select registrations database.

    // USE WHEN BETA
    $connect_db = mysqli_connect("localhost", "root", ""); // Connect to database server(localhost) with username and password.
    mysqli_select_db($connect_db, "db_livestockmapping") or die(mysqli_error()); // Select registrations database.
    
    $sql_selectcriteria = mysqli_query($connect_db, "SELECT * FROM tb_criteria");
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
                <li><a href="sawstart.php"><i class="fa fa-balance-scale"></i> Mulai SAW</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-database"></i> Data <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="animaldata.php"><i class="fa fa-paw"></i><span>Data Hewan</span></a></li>
                    <li  class="active"><a href="#"><i class="fa fa-list-ul"></i><span>Data Kriteria</span></a></li>
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
        Data Criteria
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
          <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
        <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-list-ul"></i> Criteria yang digunakan dan tipenya.</h3>
          </div>
          <div class="box-body">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_cri" data-toggle="tab"> Criteria </a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_cri">
              <br>Criteria yang digunakan dalam proses perhitungan SAW ini ada 6. Setiap criteria memiliki tipe masing-masing (<b>Benefit</b> & <b> Cost</b>). <br>Criteria yang memiliki tipe <b>Benefit</b> menunjukan semakin besar nilai dari criteria itu semakin baik, berbeda dengan criteria yang memiliki tipe <b>Cost</b>. Criteria yang memiliki tipe <b>Cost</b> semakin besar nilainya semakin buruk.<br><br>
                <table class="table table-bordered table-striped">
                  <thead>
                    <th> ID Criteria </th>
                    <th> Nama Criteria </th>
                    <th> Tipe Criteria </th>
                    <th> Nama Tipe </th>
                  </thead>
                  <tbody>
                    <?php
                      while ($row = mysqli_fetch_assoc($sql_selectcriteria)) 
                      {
                        echo "<tr>\n";
                        foreach($row as $td) 
                        {
                          echo "<td>".$td."</td>";
                        }
                        echo "</tr>\n";
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
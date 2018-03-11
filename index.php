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
    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  </head>
  <?php
    $connect_db = mysqli_connect("localhost", "root", ""); // Connect to database server(localhost) with username and password.
    mysqli_select_db($connect_db, "db_livestockmapping") or die(mysqli_error()); // Select registrations database.

    if(empty($_SESSION)) // if the session not yet started 
     session_start();

    if(!isset($_SESSION['email'])) { //if not yet logged in
     header("Location: login.php");// send to login page
     exit;
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
    <div class="content-wrapper">
      <div class="container">
        <section class="content-header">
          <h1>
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="box box-solid">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                </ol>
                <div class="carousel-inner">
                  <div class="item active">
                    <img src="assets/icon/Cover-1.png"" alt="First slide">
                  </div>
                  <div class="item">
                    <img src="http://placehold.it/900x500/3c8dbc/ffffff&text=I+Love+Bootstrap" alt="Second slide">
                    </div>
                  <div class="item">
                    <img src="http://placehold.it/900x500/f39c12/ffffff&text=I+Love+Bootstrap" alt="Third slide">
                  </div>
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                <span class="fa fa-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                <span class="fa fa-angle-right"></span>
                </a>
              </div>
            </div>
          </div>
          <div class="row" style="width:100%">
            <div class="col-sm-8">
            <div class="box box-solid">
              <div class="box-header with-border">
                <h5><b>Selamat datang di aplikasi SPK (DSS) sebagai pembantu penentuan lokasi ternak</b></h5>
              </div>
              <div class="box-body">
                <p align="justify">
                Selamat datang di aplikasi berbasis website <b>sistem pendukung keputusan (decision support system)</b> mata kuliah <b>ilmu lingkungan ternak.</b>
                Aplikasi ini dikembangkan dalam rangka meningkatkan kualitas pembelajaran Ilmu Lingkungan Ternak. Sistem pendukung keputusan merupakan sistem berbasis komputer yang dikembangkan untuk membantu pengguna untuk menggunakan data dan model dalam memecahkan masalah-masalah yang tidak terstruktur.<br><br>
                Sistem pendukung keputusan dapat memberikan alternatif solusi bagi penguna sehingga pengambilan keputusan dapat dilakukan dengan cepat dan tepat. Dengan dukungan tambahan media interaktif diharapkan mahasiswa dapat melakukan analisis kesesuaian lingkungan pada potensi ternak secara mandiri sehingga proses belajar berikutnya melalui diskusi dapat berjalan dengan lebih interaktif.
                <br><br>
                Sebelum memulai menggunakan aplikasi, di sarankan untuk mempelajari apakah SPK dan bagaimana cara kerjanya di aplikasi ini.
              </p>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="box box-solid">
              <div class="box-header with-border">
                <h5><b>Tentang SPK</b></h5>

              </div>
              <div class="box-body">
              </div>
            </div>
        </div>
        <div class="row">
          <div class="col-sm-8">
            <div class="box box-solid">
              <div class="box-body">
                <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs pull-left">
                    <li class="active"><a href="#tab_1-1" data-toggle="tab"> Sistem Pendukung Keputusan</a></li>
                    <li><a href="#tab_1-2" data-toggle="tab"> Simple Additive Weighting</a></li>
                    <li><a href="#tab_1-3" data-toggle="tab"> Flow Cara Kerja Sistem</a></li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane active" id="tab_1-1">
                    <p align="justify">
                    </p>
                    </div>
                    <div class="tab-pane" id="tab_1-2">
                    <p align="justify">
                    </p>
                    </div>
                    <div class="tab-pane" id="tab_1-3">
                    <p align="justify">
                    </p>
                    </div>
                  </div>
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
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="dist/js/adminlte.min.js"></script>
  </body>
</html>
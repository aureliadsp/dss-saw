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
    <title>Sistem Pendukung Keputusan (DSS-SAW) Penentuan Lokasi Peternakan | Mulai SAW </title>
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
    $connect_db = mysqli_connect("localhost", "dsswg_admin", "dsssawugm"); // Connect to database server(localhost) with username and password.
    mysqli_select_db($connect_db, "dsswg_livestockmapping") or die(mysqli_error()); // Select registrations database.

    $sqlanimal = mysqli_query($connect_db, "SELECT animal_id, animal_name FROM tb_animaldata");
    $sqlcriteria = mysqli_query($connect_db, "SELECT cri_id, criteria_name, type_name FROM tb_criteria");
    $sqllocation = mysqli_query($connect_db,"SELECT loc_id, loc_name, loc_district FROM tb_locationdata");
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
                <li class="active"><a href="#"><i class="fa fa-balance-scale"></i> Mulai SAW</a></li>
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
      <h1><small>Input Data</small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Input Data</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <div class="row">
          <div class="box box-solid" style="height: 800px">
            <div class="box-header with-border">
              <h4><b><i class="fa fa-circle-o-notch"></i> Input Data </b></h4>
            </div>
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <br>
              <li class="active"><a href="#tab_1" data-toggle="tab"> <i class="fa fa-paw"></i> Pilih hewan </a></li>
              <li><a href="#tab_2" data-toggle="tab"> <i class="fa fa-balance-scale"></i> Edit bobot kriteria </a></li>
              <li><a href="#tab_3" data-toggle="tab"> <i class="fa fa-location-arrow"></i> Pilih lokasi </a></li>
            </ul>
            <form name="inputdata" action="editlocation.php" method="get">
              <div class="tab-content" style="height: 800px">
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
                    
                    <a class="btn btn-primary btnNext" > Next <span class="fa fa-arrow-right"></span></a>
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
                  <div class="box-body" style="width:800px">
                  <div class="table-responsive">
                  <!--<script type="text/javascript">
                    function checkweight(form)
                    {
                      if(form.<?php print_r($row1[$c]) ?>.value < 1 
                        || form.<?php print_r($row1[$c]) ?>.value > 10) 
                      {
                        alert("Error: Mohon masukkan bobot antara 1 - 10!");
                        form.<?php print_r($row1[$c]) ?>.focus();
                        return false;
                      }
                    return true;
                    }
                  </script>-->
                  <table id="choosecrit" class="table table-bordered table-striped table-hover">
                      <thead>
                      <tr>
                        <th style="width:20%">ID Kriteria</th>
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
                                function checkweight(form)
                                {
                                  if(form.<?php print_r($rowcrit[$c]) ?>.value < 1
                                    || form.<?php print_r($rowcrit[$c]) ?>.value > 10) 
                                  {
                                    alert("Error: Mohon masukkan bobot antara 1 - 10!");
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
                    </div>
                  </div>
                  <a class="btn btn-primary btnPrevious" > <span class="fa fa-arrow-left"></span> Previous</a>
                  <a class="btn btn-primary btnNext" onclick="return checkweight(inputdata)" > Next <span class="fa fa-arrow-right"></span></a>
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
                          alert("Error: Mohon pilih lokasi minimal 5!");
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
                    table th, table td { overflow: auto; }
                  </style>
                  <table id="chooseloc" class="table table-bordered table-striped" style="width:1000px">
                    <thead>
                    <?php
                      echo "<tr>
                        <th class=\"col-md-2\"><label><input type=\"checkbox\" id=\"select_all\" /> ALL </label>  </th>
                        <th class=\"col-md-5\">ID Lokasi</th>
                        <th class=\"col-md-5\">Nama Lokasi</th>
                        <th class=\"col-md-5\">Daerah</th>
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
                    <a class="btn btn-primary btnPrevious" ><span class="fa fa-arrow-left"></span> Previous</a>
                    <button type="Submit" name="input_data" onclick="return checkForm(inputdata)" class="btn btn-primary"><span class="fa fa-edit"></span>  Edit lokasi </button>

                  </center>
                  </div>
                </div>
              </div>
            </form>
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
    <strong>&copy; 2018 <a href="http://fapet.ugm.ac.id/">FAKULTAS PETERNAKAN UGM</a>.</strong>
  </footer>
  <div class="control-sidebar-bg"></div>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
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
      'paging'      : false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
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
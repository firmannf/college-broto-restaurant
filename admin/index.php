<?php
  require_once "../proses/connection.php";
  session_start();
  
  if(isset($_SESSION['pekerjaan'])){
    if($_SESSION['pekerjaan'] != 'Admin') {
      echo "<script type=text/javascript>document.location.href='../index.php?e=unauthorized'</script>";
    }
	} else {
    echo "<script type=text/javascript>document.location.href='../index.php?e=unauthorized'</script>";
  }
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
  <title>Resto Broto</title>
</head>

<body class="sidebar-mini fixed">
  <div class="wrapper">
    <header class="main-header hidden-print"><a href="#" class="logo">Resto Broto</a>
      <nav class="navbar navbar-static-top">
        <a href="#" data-toggle="offcanvas" class="sidebar-toggle"></a>
        <div class="navbar-custom-menu">
          <ul class="top-nav">
            <li class="dropdown">
              <a href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-user fa-lg" style="margin-right: 16px;"></i><b>Hello, <?php echo $_SESSION['nama_pegawai'];?></b></a>
              <ul class="dropdown-menu settings-menu">
                <li><a href="setting.php"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
                <li><a href="../proses/logout.php"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <aside class="main-sidebar hidden-print">
      <section class="sidebar">
        <ul class="sidebar-menu" style="padding-top: 24px;">
          <li class="active"><a href="index.php"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
          <li class="treeview"><a href="#"><i class="fa fa-user"></i><span>Atur Pegawai</span><i class="fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a href="pegawai_list.php"><i class="fa fa-th-large"></i> Daftar Pegawai</a></li>
              <li><a href="pegawai_tambah.php"><i class="fa fa-plus"></i> Tambah Pegawai</a></li>
            </ul>
          </li>
          <li><a href="menu_list.php"><i class="fa fa-cutlery"></i><span>Atur Menu</span></a></li>
        </ul>
      </section>
    </aside>
    <div class="content-wrapper">
      <div class="page-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
          <p>Selamat datang di halaman admin resto broto</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
          <div class="widget-small primary"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <h4>CS</h4>
              <p>
                <b>
                  <?php
                    $strQuery = "SELECT nik FROM pegawai WHERE pekerjaan = 'Customer Service'";
                    $query = mysqli_query($connection, $strQuery);
                    echo mysqli_num_rows($query); 
                  ?>    
                </b>
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="widget-small primary"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <h4>Kasir</h4>
              <p>
                <b>
                  <?php
                    $strQuery = "SELECT nik FROM pegawai WHERE pekerjaan = 'Kasir'";
                    $query = mysqli_query($connection, $strQuery);
                    echo mysqli_num_rows($query); 
                  ?>    
                </b>
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="widget-small primary"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <h4>Koki</h4>
              <p>
                <b>
                  <?php
                    $strQuery = "SELECT nik FROM pegawai WHERE pekerjaan = 'Koki'";
                    $query = mysqli_query($connection, $strQuery);
                    echo mysqli_num_rows($query); 
                  ?>    
                </b>
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="widget-small primary"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <h4>Pantry</h4>
              <p>
                <b>
                  <?php
                    $strQuery = "SELECT nik FROM pegawai WHERE pekerjaan = 'Pantry'";
                    $query = mysqli_query($connection, $strQuery);
                    echo mysqli_num_rows($query); 
                  ?>    
                </b>
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="widget-small primary"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <h4>Pelayan</h4>
              <p>
                <b>
                  <?php
                    $strQuery = "SELECT nik FROM pegawai WHERE pekerjaan = 'Pelayan'";
                    $query = mysqli_query($connection, $strQuery);
                    echo mysqli_num_rows($query); 
                  ?>    
                </b>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Javascripts-->
  <script src="../assets/js/jquery-2.1.4.min.js"></script>
  <script src="../assets/js/essential-plugins.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/pace.min.js"></script>
  <script src="../assets/js/main.js"></script>
  <?php
    echo mysqli_close($connection);
  ?>
</body>

</html>
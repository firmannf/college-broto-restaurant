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

  if(isset($_GET['nik'])) {
        $nik = $_GET['nik'];
        $nama = "";
        $pekerjaan = "";
        $strQuery = "SELECT nik, nama, pekerjaan FROM pegawai WHERE nik = '$nik'";
        $query = mysqli_query($connection, $strQuery);
        if($query){
            $result = mysqli_fetch_array($query, MYSQLI_ASSOC);
            $nik = $result['nik'];
            $nama = $result['nama'];
            $pekerjaan = $result['pekerjaan'];
        }
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
                <a href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-user fa-lg" style="margin-right: 16px;"></i><b>Hello, <?php echo $_SESSION['nama'];?></b></a>
                <ul class="dropdown-menu settings-menu">
                  <li><a href="#"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
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
            <li><a href="index.php"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
            <li class="treeview active"><a href="#"><i class="fa fa-user"></i><span>Atur Pegawai</span><i class="fa fa-angle-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="pegawai_list.php"><i class="fa fa-th-large"></i> Daftar Pegawai</a></li>
                <li><a href="pegawai_tambah.php"><i class="fa fa-plus"></i> Tambah Pegawai</a></li>
              </ul>
            </li>
          </ul>
        </section>
      </aside>
      <div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-user"></i> Atur Pegawai</h1>
            <p>Olah data pegawai yang terdaftar di resto broto</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
            <div class="card">
              <h3 class="card-title">Edit Data Pegawai</h3>
              <div class="card-body">
                <form action="proses/pegawai_edit_proses.php" method="POST">
                  <div class="form-group">
                    <label class="control-label">NIK</label>
                    <input type="text" name="nik" placeholder="Masukkan NIK pegawai" class="form-control" value="<?php echo $nik;?>" readonly>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Nama</label>
                    <input type="text" name="nama" placeholder="Masukkan nama pegawai" class="form-control" value="<?php echo $nama;?>" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Pekerjaan</label>
                    <select class="form-control" name="pekerjaan">
                      <option value="Customer Service" <?php if($pekerjaan == "Customer Service") echo "selected"; ?>>Customer Service</option>
                      <option value="Kasir" <?php if($pekerjaan == "Kasir") echo "selected"; ?>>Kasir</option>
                      <option value="Koki" <?php if($pekerjaan == "Koki") echo "selected"; ?>>Koki</option>
                      <option value="Pantry" <?php if($pekerjaan == "Pantry") echo "selected"; ?>>Pantry</option>
                      <option value="Pelayan" <?php if($pekerjaan == "Pelayan") echo "selected"; ?>>Pelayan</option>
                      <option value="Admin" <?php if($pekerjaan == "Admin") echo "selected"; ?>>Admin</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Password</label>
                    <input type="password" name="password" placeholder="Biarkan kosong jika tidak ingin mengganti password" class="form-control">
                  </div>
                  <div class="card-footer" style="text-align: center;">
                    <button type="submit" class="btn btn-primary icon-btn input-lg"><i class="fa fa-fw fa-lg fa-check-circle"></i>Simpan</button>
                  </div>
                </form>
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
    <script src="../assets/js/plugins/sweetalert.min.js"></script>
    <!--Handling Error and Success Message-->
    <?php
    if(isset($_GET['e'])) {
      if($_GET['e'] === 'bad-request') {
          echo "<script type=text/javascript>
                swal('400 Bad Request', 'Terjadi Kesalahan Saat Memproses Data Login', 'error');
          </script>";
      }
    }
    ?>
  </body>

  </html>
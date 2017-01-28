<?php
  session_start();
  
  if(isset($_SESSION['pekerjaan'])){
    if($_SESSION['pekerjaan'] != 'Pelayan') {
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
  <link rel="stylesheet" type="text/css" href="../assets/css/stylepelanggan.css">
  <title>Resto Broto</title>
</head>

<body class="sidebar-mini fixed">
  <div class="wrapper">
    <header class="container">
      <nav id="menu" class="navbar navbar-default navbar-fixed-top">
        <div class="logo-center">Resto Broto</div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-left">
            <li class="nav">
              <a href="index.php"><i class="fa fa-arrow-left fa-lg" style="margin-left: 16px;"></i></a>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-user fa-lg" style="margin-right: 16px;"></i></a>
                <ul class="dropdown-menu settings-menu" style="width: 20px;">
                  <li><a href="setting.php"><i class="fa fa-cog fa-lg"></i> Setting</a></li>
                  <li><a href="../proses/logout.php"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
                </ul>
              </li>
          </ul>
        </div>
      </nav>
    </header>
    <div class="">
      <div class="row" style="margin: 80px 20px;">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <div class="card">
            <h3 class="card-title">Edit Profil</h3>
            <div class="card-body">
              <form action="proses/profil_edit_proses.php" method="POST">
                <div class="form-group">
                  <label class="control-label">NIK</label>
                  <input type="text" name="nik" placeholder="Masukkan NIK pegawai" class="form-control" value="<?php echo $_SESSION['nik'];?>"
                    readonly>
                </div>
                <div class="form-group">
                  <label class="control-label">Nama Pegawai</label>
                  <input type="text" name="nama_pegawai" placeholder="Masukkan nama pegawai" class="form-control" value="<?php echo $_SESSION['nama_pegawai'];?>"
                    required>
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
    if(isset($_GET['m'])) {
      if($_GET['m'] === 'success-edit-data') {
          echo "<script type=text/javascript>
                swal('Berhasil', 'Profil Berhasil diedit', 'success');
          </script>";
      }
    }
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
<?php
  require_once "../proses/connection.php";
  session_start();
  
  if(isset($_SESSION['pekerjaan'])){
    if($_SESSION['pekerjaan'] != 'Pantry') {
      echo "<script type=text/javascript>document.location.href='../index.php?e=unauthorized'</script>";
    }
	} else {
    echo "<script type=text/javascript>document.location.href='../index.php?e=unauthorized'</script>";
  }

  if(isset($_GET['id2'])) {
        $id_detail_bahanbaku = $_GET['id2'];
        $tgl_kadaluarsa = "";
        $qty = "";
        $strQuery = "SELECT id_detail_bahanbaku, tgl_kadaluarsa, qty FROM bahanbaku_detail WHERE id_detail_bahanbaku = '$id_detail_bahanbaku'";
        $query = mysqli_query($connection, $strQuery);
        if($query){
            $result = mysqli_fetch_array($query, MYSQLI_ASSOC);
            $id_detail_bahanbaku = $result['id_detail_bahanbaku'];
            $tgl_kadaluarsa = $result['tgl_kadaluarsa'];
            $qty = $result['qty'];
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
                <a href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-user fa-lg" style="margin-right: 16px;"></i><b>Hello, <?php echo $_SESSION['nama_pegawai'];?></b></a>
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
            <li class="treeview active"><a href="#"><i class="fa fa-user"></i><span>Atur Bahan</span><i class="fa fa-angle-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="bahan_list.php"><i class="fa fa-th-large"></i> Daftar Bahan</a></li>
                <li><a href="bahan_tambah.php"><i class="fa fa-plus"></i> Tambah Bahan</a></li>
              </ul>
            </li>
          </ul>
        </section>
      </aside>
      <div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-glass"></i> Atur Bahan Baku</h1>
            <p>Olah data bahan baku di resto broto</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
            <div class="card">
              <h3 class="card-title">Edit Data Detail Bahan Baku</h3>
              <div class="card-body">
                <form action="proses/bahan_detail_edit_proses.php" method="POST">
                  <div class="form-group">
                    <label class="control-label">Tanggal Kadaluarsa</label>
                    <input type="date" name="tgl_kadaluarsa" placeholder="Masukkan tanggal kadaluarsa" class="form-control input-sm" value="<?php echo $tgl_kadaluarsa;?>" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Kuantitas</label>
                    <input type="number" name="qty" placeholder="Masukkan kuantitas" class="form-control" value="<?php echo $qty;?>" required>
                  </div>
                  <div class="card-footer" style="text-align: center;">
                    <input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
                    <input type="hidden" name="id2" value="<?php echo $_GET['id2'];?>" />
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
                swal('400 Bad Request', 'Terjadi Kesalahan Saat Memproses Data Bahan Baku', 'error');
          </script>";
      }
    }
    ?>
  </body>

  </html>
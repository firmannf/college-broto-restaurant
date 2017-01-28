<?php
  require_once "../proses/connection.php";
  session_start();
  
  if(isset($_SESSION['pekerjaan'])){
    if($_SESSION['pekerjaan'] != 'Koki') {
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
                <a href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-user fa-lg" style="margin-right: 16px;"></i><b>Koki</b></a>
                <ul class="dropdown-menu settings-menu">
                  <li><a href="#"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
                  <li><a href="#"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
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
            <li><a href="pesanan_list.php"><i class="fa fa-list-alt"></i><span>Daftar Pesanan</span></a></li>
            <li class="treeview active"><a href="#"><i class="fa fa-cutlery"></i><span>Atur Menu</span><i class="fa fa-angle-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="menu_list.php"><i class="fa fa-th-large"></i> Daftar Menu</a></li>
                <li><a href="menu_tambah.php"><i class="fa fa-plus"></i> Tambah Menu</a></li>
              </ul>
            </li>
          </ul>
        </section>
      </aside>
      <div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-glass"></i> Atur Menu</h1>
            <p>Olah data menu di resto broto</p>
          </div>
          <div class="col-md-4">
            <a href="#" onClick="searchKeywords()" class="btn btn-default pull-right" style="margin-left: 12px;"><i class="fa fa-search"></i>&nbsp;&nbsp;&nbsp;Cari</a>
            <?php
            if(isset($_GET['q'])) {
            ?>
              <a href="menu_list.php" class="btn btn-primary pull-right"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;&nbsp;Kembali</a>
              <?php
            }
            ?>
          </div>
        </div>
        <div class="row">
          <?php
        if(isset($_GET['q'])){
          $strQuery = "SELECT id_menu, nama_menu, foto, kategori, estimasi_penyajian FROM menu WHERE nama_menu LIKE '%$_GET[q]%' ORDER BY id_menu DESC";
        }else {
          $strQuery = "SELECT id_menu, nama_menu, foto, kategori, estimasi_penyajian FROM menu ORDER BY id_menu DESC";
        }
        $query = mysqli_query($connection, $strQuery);
        $i = 0;
        while($result = mysqli_fetch_assoc($query)){
        ?>
            <div class="col-md-6" id="<?php echo $result['id_menu'];?>">
              <div class="card">
                <div class="row">
                  <div class="col-md-4">
                    <img class="img-circle" src="../uploads/menu/<?php echo $result['foto'];?>" style="width: 120px; height: 120px;" />
                  </div>
                  <div class="col-md-8">
                    <h3><b><?php echo $result['nama_menu'];?></b></h3>
                    <h5>
                      <?php echo $result['kategori'];?>
                    </h5>
                    <h5>
                      <?php echo $result['estimasi_penyajian'];?> Menit Penyajian</h5>
                  </div>
                  <div class="col-md-12" style="text-align: right;">
                    <a class="btn btn-primary" href="#" onClick="deleteConfirm(<?php echo $result['id_menu'];?>)">Hapus</a>                    &nbsp;&nbsp;&nbsp;
                    <a class="btn btn-warning">Edit</a>
                  </div>
                </div>
              </div>
            </div>
            <?php
        }
        ?>
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
    <script type="text/javascript">
      var id = "";

      function deleteConfirm(id) {
        this.id = id;
        var self = this;
        $(document).ready(function () {
          swal({
              title: "Apakah Anda Yakin ?",
              type: "warning",
              inputType: "hidden",
              showCancelButton: true,
              confirmButtonText: "Ya",
              cancelButtonText: "Tidak",
              showLoaderOnConfirm: true,
              closeOnConfirm: false
            },
            function (isConfirm) {
              if (isConfirm) {
                $.ajax({
                  url: 'proses/menu_delete_proses.php',
                  data: {
                    'id': self.id
                  },
                  dataType: "html",
                  type: 'POST',
                  cache: false,
                  success: function (data) {
                    if (data == 'error') {
                      swal("400 Bad Request", "Data Tidak Dapat dihapus", "error");
                    } else {
                      document.getElementById(self.id).remove();
                      swal("Berhasil", "Data Terhapus", "success");
                    }
                  },
                  error: function (data) {
                    swal("400 Bad Request", "Data Tidak Dapat dihapus", "error");
                  }
                });
              }
            });
        });
      }

      function searchKeywords() {
        swal({
            title: "Cari Menuu",
            text: "Masukkan nama menu",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            inputPlaceholder: "Nama Menu"
          },
          function (inputValue) {
            if (inputValue === false) return false;
            if (inputValue === "") {
              swal.showInputError("Nama Menu Masih Kosong");
              return false
            }

            document.location.href = 'menu_list.php?q=' + inputValue;
          });
      }
    </script>
    <!--Handling Error and Success Message-->
    <?php
    if(isset($_GET['m'])) {
      if($_GET['m'] === 'success-add-data') {
          echo "<script type=text/javascript>
                swal('Berhasil', 'Data Berhasil Ditambahkan', 'success');
          </script>";
      } else if($_GET['m'] === 'success-edit-data') {
          echo "<script type=text/javascript>
                swal('Berhasil', 'Data Berhasil diedit', 'success');
          </script>";
      }
    }

    echo mysqli_close($connection);
    ?>
  </body>

  </html>
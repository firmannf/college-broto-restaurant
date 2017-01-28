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
            <h1><i class="fa fa-cutlery"></i> Atur Menu</h1>
            <p>Olah data menu di resto broto</p>
          </div>
          <div>
            <?php
            if(isset($_GET['q'])) {
            ?>
              <a href="menu_list.php" class="btn btn-success btn-flat"><i class="fa fa-arrow-left"></i></a>
              <?php
            }
            ?>
            <a href="#" onClick="searchKeywords()" class="btn btn-default btn-flat"><i class="fa fa-search"></i></a>
          </div>
        </div>
        <div class="row">
          <?php
        if(isset($_GET['q'])){
          $strQuery = "SELECT id_menu, nama_menu, foto, kategori, estimasi_penyajian, harga FROM menu WHERE nama_menu LIKE '%$_GET[q]%' ORDER BY id_menu DESC";
        }else {
          $strQuery = "SELECT id_menu, nama_menu, foto, kategori, estimasi_penyajian, harga FROM menu ORDER BY id_menu DESC";
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
                    <h3 data-toggle="modal" data-target="#detail<?php echo $i;?>" style="cursor: pointer;"><b><?php echo $result['nama_menu'];?></b></h3>
                    <h5>
                      <?php echo $result['kategori'];?>
                    </h5>
                    <h5>
                      <?php echo $result['estimasi_penyajian'];?> Menit Penyajian</h5>
                  </div>
                  <div class="col-md-12" style="text-align: right;">
                    <a class="btn btn-primary btn-flat" href="#" onClick="deleteConfirm(<?php echo $result['id_menu'];?>)"><i class="fa fa-trash"></i></a>                    &nbsp;&nbsp;&nbsp;
                    <a class="btn btn-warning btn-flat" href="menu_edit.php?id=<?php echo $result['id_menu'];?>"><i class="fa fa-pencil"></i></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal fade" id="detail<?php echo $i;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <form action="proses/pembayaran_edit_proses.php" method="POST">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel"><?php echo $result['nama_menu'];?></h4>
                    </div>
                    <div class="modal-body">
                      <center><img class="img-responsive img-circle" src="../uploads/menu/<?php echo $result['foto'];?>" style="width: 200px; height: 200px;"/></center>
                      <br/><br/>
                      <h4><b>Nama Menu</b></h4>
                      <h5><?php echo $result['nama_menu'];?></h5>
                      <br/>
                      <h4><b>Kategori</b></h4>
                      <h5><?php echo $result['kategori'];?></h5>
                      <br/>
                      <h4><b>Estimasi Penyajian</b></h4>
                      <h5><?php echo $result['estimasi_penyajian'];?> Menit</h5>
                      <br/>
                      <h4><b>Harga</b></h4>
                      <h5>Rp.<?php echo $result['harga'];?></h5>
                      <br/>
                      <h4><b>Bahan Baku</b></h4>
                      <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                          <thead>
                            <tr>
                              <td>Nama Bahan Baku</td>
                              <td>Jumlah</td>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
                            $strQuery = "SELECT bb.nama_bahanbaku, bb.satuan, md.qty, m.id_menu 
                                          FROM menu_detail md INNER JOIN menu m ON md.id_menu = m.id_menu
                                          INNER JOIN bahanbaku bb ON md.id_bahanbaku = bb.id_bahanbaku 
                                          WHERE md.id_menu = $result[id_menu]";
                            $subQuery = mysqli_query($connection, $strQuery);
                            $i = 0;
                            while($subResult = mysqli_fetch_assoc($subQuery)){
                              echo "<tr>";
                              echo "<td>$subResult[nama_bahanbaku]</td>";
                              echo "<td>$subResult[qty] $subResult[satuan]</td>";
                              echo "</tr>";
                            }
                          ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Close</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <?php
            $i++;
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
                swal('Berhasil', 'Data Berhasil Diedit', 'success');
          </script>";
      }
    }

    mysqli_close($connection);
    ?>
  </body>

  </html>
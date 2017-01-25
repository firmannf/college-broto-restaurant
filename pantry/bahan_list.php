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
            <h1><i class="fa fa-glass"></i> Atur Bahan</h1>
            <p>Olah data bahan di resto broto</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card" style="padding: 16px 48px;">
              <div style="margin-top: 16px;">
                <a href="#" class="btn btn-default pull-right"><i class="fa fa-search"></i>&nbsp;&nbsp;&nbsp;Cari</a>
                <h3 class="card-title">Daftar Bahan</h3>
              </div>
              <div class="table-responsive">
                <table class="table table-hover table-bordered" style="border-collapse:collapse;">
                  <thead>
                    <tr>
                      <th>Nama Bahan</th>
                      <th>Qty</th>
                      <th>Harga per Satuan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if(isset($_GET['q'])){
                      $strQuery = "SELECT nik, nama, pekerjaan FROM pegawai WHERE pekerjaan != 'Admin'
                                    AND nik LIKE '%$_GET[q]%' OR nama LIKE '%$_GET[q]%' OR pekerjaan LIKE '%$_GET[q]%' ORDER BY nik ASC";
                    }else {
                      $strQuery = "SELECT bahanbaku_id, nama, total_qty, satuan, harga_per_satuan FROM bahanbaku ORDER BY bahanbaku_id ASC";
                    }
                    $query = mysqli_query($connection, $strQuery);
                    $i = 0;
                    while($result = mysqli_fetch_assoc($query)){
                      echo "<tr id=$result[bahanbaku_id] data-toggle=collapse data-target=#detail$i class=\"accordion-toggle\" style=\"cursor:pointer;\">";
                      echo "<td>$result[nama]</td>";
                      echo "<td>$result[total_qty] $result[satuan]</td>";
                      echo "<td style=\"text-align: right;\">Rp. $result[harga_per_satuan]</td>";
                      echo "<td><a href='bahan_edit.php?nik=$result[bahanbaku_id]'><i class=\"fa fa-pencil\"></i></a>";
                      echo "&nbsp;&nbsp;&nbsp;";
                      echo "<a href=# class=btn-link onClick=deleteConfirm($result[bahanbaku_id])>
                                <i class=\"fa fa-trash\"></i>
                            </a>";
                      echo "</tr>";
                      echo "<tr>
                          <td colspan=5 style=\"padding: 0 !important;\"><div id=detail$i class=\"accordion-body collapse\">$i</div></td>
                      </tr>";
                      $i++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>
              <!--<center>
                <ul class="pagination">
                  <li class="disabled"><a href="#">«</a></li>
                  <li class="active"><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">4</a></li>
                  <li><a href="#">5</a></li>
                  <li><a href="#">»</a></li>
                </ul>
              </center>-->
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
                  url: 'proses/bahan_delete_proses.php',
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
            title: "Cari Bahan Baku",
            text: "Masukkan keyword yang ingin anda cari",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            inputPlaceholder: "Nama Bahan Baku atau Harga atau Tanggal Kadaluarsa"
          },
          function (inputValue) {
            if (inputValue === false) return false;
            if (inputValue === "") {
              swal.showInputError("Keywords Masih Kosong");
              return false
            }

            document.location.href = 'bahan_list.php?q=' + inputValue;
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
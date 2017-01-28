<?php
  require_once "../proses/connection.php";
  session_start();
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

<body>
  <div class="page">
    <header class="container">
      <nav id="menu" class="navbar navbar-default navbar-fixed-top">
        <div class="logo-center">Resto Broto</div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-left">
            <li class="nav">
              <a href="menu.php"><i class="fa fa-arrow-left fa-lg" style="margin-left: 16px;"></i></a>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="nav">
              <a href="order_list.php"><i class="fa fa-shopping-cart fa-lg" style="margin-right: 16px;"></i></a>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <section id="body" class="container" style="margin-top:80px;">
      <h2 align="center" style="margin-bottom:30px;"> Daftar Pesanan </h2>
      <div class="card" style="padding: 16px 48px; margin-top:40px">
        <div class="table-responsive" style="margin-top: 20px; background-color=#FFFFFF">
          <table class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>Nama Pesanan</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
                    $strQuery = "SELECT pd.id_detail_pesanan, p.id_pesanan, m.nama_menu, pd.qty, pd.status 
                                  FROM pesanan p INNER JOIN pesanan_detail pd ON p.id_pesanan = pd.id_pesanan 
                                  INNER JOIN meja me ON p.id_meja = me.id_meja
                                  INNER JOIN menu m ON pd.id_menu = m.id_menu WHERE p.id_pesanan = '$_SESSION[id_pesanan]' ORDER BY p.tgl_order DESC";
                    $query = mysqli_query($connection, $strQuery);
                    $i = 0;
                    while($result = mysqli_fetch_assoc($query)){
                      echo "<tr id=$result[id_detail_pesanan]>";
                      echo "<td>$result[nama_menu]</td>";
                      echo "<td>$result[qty]</td>";
                      echo "<td>$result[status]</td>";
                      if($result['status'] === "Belum"){
                        echo "<td><a onClick=\"deleteConfirm($result[id_detail_pesanan])\" style=\"cursor: pointer;\"><i class=\"fa fa-trash\"></i></a></td>";
                      }else {
                        echo "<td></td>";
                      }
                      echo "&nbsp;&nbsp;&nbsp;";
                      echo "</tr>";
                    }
                  ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <a href="menu_kategori.php" class="btn btn-success center-block" style="margin: 20px auto; width: 70%;">
              Pilih Menu Lagi
            </a>
        </div>
      </div>
    </section>
    <!-- Javascripts-->
    <script src="../assets/js/jquery-2.1.4.min.js"></script>
    <script src="../assets/js/essential-plugins.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/pace.min.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/plugins/sweetalert.min.js"></script>
    <script>
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
                  url: 'proses/pesanan_delete_proses.php',
                  data: {
                    'id': self.id
                  },
                  dataType: "html",
                  type: 'POST',
                  cache: false,
                  success: function (data) {
                    if (data == 'error') {
                      swal("400 Bad Request", "Data Tidak Dapat Dihapus", "error");
                    } else {
                      document.getElementById(self.id).remove();
                      swal("Berhasil", "Data Terhapus", "success");
                    }
                  },
                  error: function (data) {
                    swal("400 Bad Request", "Data Tidak Dapat Dihapus", "error");
                  }
                });
              }
            });
        });
      }
    </script>
</body>

</html>
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
      <h2 align="center" style="margin-bottom:30px;"> Bayar Order </h2>
      <div class="card" style="padding: 16px 24px; margin-top: 40px">
        <div class="table-responsive" style="margin-top: 20px; background-color=#FFFFFF">
          <table class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>Nama Pesanan</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
              </tr>
            </thead>
            <tbody>
              <?php
                            $strQuery = "SELECT m.id_menu, p.id_pesanan,m.nama_menu, m.harga, pd.qty 
                            FROM pesanan_detail pd INNER JOIN pesanan p ON pd.id_pesanan = p.id_pesanan
                            INNER JOIN menu m on pd.id_menu = m.id_menu 
                            WHERE p.id_pesanan = '$_SESSION[id_pesanan]' ORDER BY m.id_menu ASC";
                            $subquery = mysqli_query($connection, $strQuery);
                            $i = 0;
                            $total = 0;
                            while($subRresult = mysqli_fetch_assoc($subquery)){
                              echo "<tr>";
                              echo "<td>$subRresult[nama_menu]</td>";
                              echo "<td style=\"text-align: right\">Rp. $subRresult[harga]</td>";
                              echo "<td>$subRresult[qty]</td>";
                              $subtotal = $subRresult['harga'] * $subRresult['qty'];
                              $total += $subtotal;
                              echo "<td style=\"text-align: right\">Rp. $subtotal</td>";
                              echo "</tr>";
                            }
                            $pajak = $total * 0.10;
                            $grandtotal = $total + $pajak;
                          ?>
            </tbody>
          </table>
        </div>
        <div class="row">
          <div class="col-md-6 text-right">
            <b>Subtotal</b> Rp. <?php echo $total;?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 text-right">
            <b>Pajak</b> &nbsp;&nbsp;&nbsp;Rp. <?php echo $pajak;?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 text-right">
            <b>Total</b> &nbsp;Rp. <?php echo $grandtotal;?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <button onClick="bayarOrder(<?php echo $_SESSION['id_meja'];?>)" class="btn btn-success center-block" style="margin: 20px auto; width: 70%;">
            Bayar Order
          </button>
        </div>
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
    function bayarOrder(id) {
      this.id = id;
      var self = this;
      swal({
        title: "Mohon Tunggu",
        text: "Pelayanan kami akan datang untuk melakukan konfirmasi pembayaran, Terimakasih sudah mengunjungi Resto Broto. semoga anda puas dan dapat kembali Lagi kesini, tekan OK untuk Melanjutkan",
        type: "success",
        showCancelButton: false,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "OK",
        closeOnConfirm: false
      });

      $.ajax({
        url: 'proses/bayar_proses.php',
        data: {
          'id': self.id
        },
        dataType: "html",
        type: 'POST',
        cache: false,
        success: function (data) {
          if (data == 'error') {
            swal("400 Bad Request", "Terjadi Kesalahan Pada Sistem", "error");
          }
        },
        error: function (data) {
          swal("400 Bad Request", "Terjadi Kesalahan Pada Sistem", "error");
        }
      });
    }
  </script>
  <?php
    mysqli_close($connection);
  ?>
</body>

</html>
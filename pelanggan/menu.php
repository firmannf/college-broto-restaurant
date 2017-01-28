<?php
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
            <li class="nav"></a>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="nav"><a href="#"><i class="fa fa-shopping-cart fa-lg" style="margin-right: 16px;"></i></a>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <section id="body" class="container" style="margin-top:80px;">
      <div class="col-md-6 col-lg-6 col-xs-6">
        <a href="menu_kategori.php">
        <div class="card text-center">
          <div class="card-block">
            <h4 class="card-title"><i class="fa fa-cutlery fa-3x" aria-hidden="true"></i></h4>
            <p class="card-text">
              <h6><b>Pilih Menu</b><h6>
            </p>
          </div>
        </div>
        </a>
      </div>
      <div class="col-md-6 col-lg-6 col-xs-6">
        <a href="bayar_order.php">
          <div class="card text-center">
            <div class="card-block">
              <h4 class="card-title"><i class="fa fa-money fa-3x" aria-hidden="true"></i></h4>
              <p class="card-text">
                <h6><b>Bayar Order</b><h6>
              </p>
            </div>
          </div>
        </a>
      </div>
      <div class="col-md-6 col-lg-6 col-xs-6">
        <a href="review.php">
          <div class="card text-center">
            <div class="card-block">
              <h4 class="card-title"><i class="fa fa-star fa-3x" aria-hidden="true"></i></h4>
              <p class="card-text">
                <h6><b>Beri Review</b><h6>
              </p>
            </div>
          </div>
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
  <?php
    if(isset($_GET['m'])) {
      if($_GET['m'] === 'welcome') {
          echo "<script type=text/javascript>
                swal('Selamat Datang $_SESSION[nama_pelanggan]');
          </script>";
      }
    }
  ?>
</body>

</html>
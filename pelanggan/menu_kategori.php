<?php
  session_start();
  if(!isset($_SESSION['id_meja'])){
      echo "<script type=text/javascript>document.location.href='index.php?e=unauthorized'</script>";
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
      <h2 align="center" style="margin-bottom:30px;"> Pilih Kategori Menu </h2>
      <div class="col-md-6 col-lg-6 col-xs-6">
        <a href="menu_makanan.php">
          <div class="card text-center">
            <div class="card-block">
              <h4 class="card-title"><i class="fa fa-cutlery fa-3x" aria-hidden="true"></i></h4>
              <p class="card-text">
                <h6><b>Makanan</b><h6>
              </p>
            </div>
          </div>
        </a>
      </div>
      <div class="col-md-6 col-lg-6 col-xs-6">
        <a href="menu_minuman.php">
          <div class="card text-center">
            <div class="card-block">
              <h4 class="card-title"><i class="fa fa-glass fa-3x" aria-hidden="true"></i></h4>
              <p class="card-text">
                <h6><b>Minuman</b>
                  <h6>
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
</body>

</html>
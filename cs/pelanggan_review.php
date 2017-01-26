<?php
  require_once "../proses/connection.php";
  session_start();
  
  if(isset($_SESSION['pekerjaan'])){
    if($_SESSION['pekerjaan'] != 'Customer Service') {
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
            <li class="active"><a href="pelanggan_review.php"><i class="fa fa-star"></i><span>Review Pelanggan</span></a></li>
          </ul>
        </section>
      </aside>
      <div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-user"></i> Review Pelanggan</h1>
            <p>Review pelanggan yang pernah berkunjung ke resto broto</p>
          </div>
        </div>
        <div class="row">
          <?php
          $strQuery = "SELECT p.id_pesanan, p.nama_pelanggan, k.pelayanan, k.harga, k.makanan, k.minuman, k.review
                          FROM pesanan p INNER JOIN kuesioner k 
                          ON p.id_pesanan = k.id_pesanan
                          ORDER BY p.tgl_order ASC";
          $query = mysqli_query($connection, $strQuery);
          while($result = mysqli_fetch_assoc($query)){
          ?>
          <div class="col-md-6">
            <div class="card">
              <div class="row">
                <div class="col-md-6">
                  <div class="table-responsive">
                    <table class="table table-borderless">
                      <tbody>
                        <tr>
                          <td><b>ID Pesanan</b></td>
                          <td><?php echo $result['id_pesanan'];?></td>
                        </tr>
                        <tr>
                          <td><b>Nama</b></td>
                          <td><?php echo $result['nama_pelanggan'];?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="table-responsive">
                    <table class="table table-borderless">
                      <tbody>
                        <tr>
                          <td><b>Pelayanan</b></td>
                          <td>
                            <?php
                              $sisa_pelayanan = 5 - $result['pelayanan'];
                              for($i = 1; $i <= $result['pelayanan']; $i++) {
                                echo "<i class=\"fa fa-star\"></i>";
                                echo "&nbsp;&nbsp;";
                              }
                              for($i = 1; $i <= $sisa_pelayanan; $i++) {
                                echo "<i class=\"fa fa-star-o\"></i>";
                                echo "&nbsp;&nbsp;";
                              }
                            ?>
                          </td>
                        </tr>
                        <tr>
                          <td><b>Harga</b></td>
                          <td>
                            <?php
                              $sisa_harga = 5 - $result['harga'];
                              for($i = 1; $i <= $result['harga']; $i++) {
                                echo "<i class=\"fa fa-star\"></i>";
                                echo "&nbsp;&nbsp;";
                              }
                              for($i = 1; $i <= $sisa_harga; $i++) {
                                echo "<i class=\"fa fa-star-o\"></i>";
                                echo "&nbsp;&nbsp;";
                              }
                            ?>
                          </td>
                        </tr>
                        <tr>
                          <td><b>Makanan</b></td>
                          <td>
                            <?php
                              $sisa_makanan = 5 - $result['makanan'];
                              for($i = 1; $i <= $result['makanan']; $i++) {
                                echo "<i class=\"fa fa-star\"></i>";
                                echo "&nbsp;&nbsp;";
                              }
                              for($i = 1; $i <= $sisa_makanan; $i++) {
                                echo "<i class=\"fa fa-star-o\"></i>";
                                echo "&nbsp;&nbsp;";
                              }
                            ?>
                          </td>
                        </tr>
                        <tr>
                          <td><b>Minuman</b></td>
                          <td>
                            <?php
                              $sisa_minuman = 5 - $result['minuman'];
                              for($i = 1; $i <= $result['minuman']; $i++) {
                                echo "<i class=\"fa fa-star\"></i>";
                                echo "&nbsp;&nbsp;";
                              }
                              for($i = 1; $i <= $sisa_minuman; $i++) {
                                echo "<i class=\"fa fa-star-o\"></i>";
                                echo "&nbsp;&nbsp;";
                              }
                            ?>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="row" style="border: 1px solid #AAA; padding: 8px 0px; margin: 8px 0px 0px;">
                <div class="col-md-12">
                  <p><b>Review</b></p>
                  <p><?php $review = $result['review'] == NULL ? "-" : $result['review']; echo $review;?></p>
                </div>
              </div>
            </div>
          </div>
          <?php
          }
          ?>
        </div>
      </div>
      <!-- Javascripts-->
      <script src="../assets/js/jquery-2.1.4.min.js"></script>
      <script src="../assets/js/essential-plugins.js"></script>
      <script src="../assets/js/bootstrap.min.js"></script>
      <script src="../assets/js/plugins/pace.min.js"></script>
      <script src="../assets/js/main.js"></script>
    </div>
  </body>

  </html>
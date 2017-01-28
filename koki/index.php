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
            <li class="active"><a href="index.php"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
            <li><a href="pesanan_list.php"><i class="fa fa-list-alt"></i><span>Daftar Pesanan</span></a></li>
            <li class="treeview"><a href="#"><i class="fa fa-cutlery"></i><span>Atur Menu</span><i class="fa fa-angle-right"></i></a>
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
            <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
            <p>Selamat datang di halaman koki resto broto</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="widget-small primary"><i class="icon fa fa-users fa-3x"></i>
              <div class="info">
                <h4>Pesanan</h4>
                <p>
                  <b>
                  <?php
                    $strQuery = "SELECT id_detail_pesanan FROM pesanan_detail WHERE status = 'Belum'";
                    $query = mysqli_query($connection, $strQuery);
                    echo mysqli_num_rows($query); 
                  ?>    
                </b>
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="widget-small info"><i class="icon fa fa-users fa-3x"></i>
              <div class="info">
                <h4>Makanan Tersedia</h4>
                <p>
                  <b>
                  <?php
                    $strQuery = "SELECT m.id_menu, m.nama_menu, m.foto
                            FROM menu m INNER JOIN menu_detail md ON m.id_menu = md.id_menu
                            INNER JOIN bahanbaku bb ON md.id_bahanbaku = bb.id_bahanbaku
                            WHERE m.kategori = 'Makanan'
                            GROUP BY m.id_menu
                            HAVING m.id_menu 
                            NOT IN(
                              SELECT m.id_menu
                              FROM menu m INNER JOIN menu_detail md ON m.id_menu = md.id_menu
                              INNER JOIN bahanbaku bb ON md.id_bahanbaku = bb.id_bahanbaku
                              WHERE bb.tgl_kadaluarsa < NOW()
                            )";
                    $query = mysqli_query($connection, $strQuery);
                    echo mysqli_num_rows($query); 
                  ?>    
                </b>
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="widget-small warning"><i class="icon fa fa-users fa-3x"></i>
              <div class="info">
                <h4>Minuman Tersedia</h4>
                <p>
                  <b>
                  <?php
                    $strQuery = "SELECT nik FROM pegawai WHERE pekerjaan = 'Kasir'";
                    $query = mysqli_query($connection, $strQuery);
                    echo mysqli_num_rows($query); 
                  ?>    
                </b>
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-12" style="margin-top: 24px;">
            <div class="card" style="padding: 16px 48px;">
              <div style="margin-top: 16px;">
                <h3 class="card-title">Menu Makanan Tersedia</h3>
              </div>
              <div class="table-responsive">
                <table class="table table-hover table-borderless">
                  <tbody>
                    <?php
                      $strQuery = "SELECT m.id_menu, m.nama_menu, m.foto
                            FROM menu m INNER JOIN menu_detail md ON m.id_menu = md.id_menu
                            INNER JOIN bahanbaku bb ON md.id_bahanbaku = bb.id_bahanbaku
                            WHERE m.kategori = 'Makanan'
                            GROUP BY m.id_menu
                            HAVING m.id_menu 
                            NOT IN(
                              SELECT m.id_menu
                              FROM menu m INNER JOIN menu_detail md ON m.id_menu = md.id_menu
                              INNER JOIN bahanbaku bb ON md.id_bahanbaku = bb.id_bahanbaku
                              WHERE bb.tgl_kadaluarsa < NOW()
                            )";
                      $query = mysqli_query($connection, $strQuery);
                      $i = 0;
                      while($result = mysqli_fetch_assoc($query)){
                      ?>
                      <tr>
                        <td><img class="img-circle" width="40px" height="40px" src="../uploads/menu/<?php echo $result['foto'];?>"
                          /><b>&nbsp;&nbsp;&nbsp;<?php echo $result['nama_menu'];?></b></td>
                      </tr>
                      <?php
                      }
                      ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card" style="padding: 16px 48px;">
              <div style="margin-top: 16px;">
                <h3 class="card-title">Menu Minuman Tersedia</h3>
              </div>
              <div class="table-responsive">
                <table class="table table-hover table-bordered">
                  <tbody>
                    <?php
                      $strQuery = "SELECT m.id_menu, m.nama_menu, m.foto
                            FROM menu m INNER JOIN menu_detail md ON m.id_menu = md.id_menu
                            INNER JOIN bahanbaku bb ON md.id_bahanbaku = bb.id_bahanbaku
                            WHERE m.kategori = 'Minuman'
                            GROUP BY m.id_menu
                            HAVING m.id_menu 
                            NOT IN(
                              SELECT m.id_menu
                              FROM menu m INNER JOIN menu_detail md ON m.id_menu = md.id_menu
                              INNER JOIN bahanbaku bb ON md.id_bahanbaku = bb.id_bahanbaku
                              WHERE bb.tgl_kadaluarsa < NOW()
                            )";
                      $query = mysqli_query($connection, $strQuery);
                      $i = 0;
                      while($result = mysqli_fetch_assoc($query)){
                      ?>
                      <tr>
                        <td><img class="img-circle" width="40px" height="40px" src="../assets/images/<?php echo $result['foto'];?>"
                          /><b>&nbsp;&nbsp;&nbsp;<?php echo $result['nama_menu'];?></b></td>
                      </tr>
                      <?php
                      }
                      ?>
                  </tbody>
                </table>
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
  </body>

  </html>
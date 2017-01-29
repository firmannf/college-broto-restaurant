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
            <li class="active"><a href="pesanan_list.php"><i class="fa fa-list-alt"></i><span>Daftar Pesanan</span></a></li>
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
            <h1><i class="fa fa-user"></i> Daftar Pesanan</h1>
            <p>Olah data pesanan yang masuk di resto broto</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card" style="padding: 16px 48px;">
              <div style="margin-top: 16px;">
                <h3 class="card-title">Daftar Pesanan</h3>
              </div>
              <div class="table-responsive">
                <table id="pesanan" class="table table-hover table-bordered">
                  <thead>
                    <tr>
                      <th>ID Order</th>
                      <th>No Meja</th>
                      <th>Nama Menu</th>
                      <th>Jumlah</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody id="table-content">
                    <?php
                    $strQuery = "SELECT pd.id_detail_pesanan, p.id_pesanan, me.id_meja, me.nama_meja, m.nama_menu, pd.qty 
                                  FROM pesanan p INNER JOIN pesanan_detail pd ON p.id_pesanan = pd.id_pesanan 
                                  INNER JOIN meja me ON p.id_meja = me.id_meja
                                  INNER JOIN menu m ON pd.id_menu = m.id_menu WHERE pd.status = 'Belum' ORDER BY p.tgl_order DESC";
                    $query = mysqli_query($connection, $strQuery);
                    $i = 0;
                    while($result = mysqli_fetch_assoc($query)){
                      echo "<tr id=$result[id_detail_pesanan]>";
                      echo "<td>$result[id_pesanan]</td>";
                      echo "<td>$result[nama_meja]</td>";
                      echo "<td>$result[nama_menu]</td>";
                      echo "<td>$result[qty]</td>";
                      echo "<td><a onClick=\"finishOrder($result[id_detail_pesanan], $result[id_meja])\" style=\"cursor: pointer;\"><i class=\"fa fa-check\"></i></a></td>";
                      echo "&nbsp;&nbsp;&nbsp;";
                      echo "</tr>";
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
    <script src="../assets/js/plugins/sweetalert.min.js"></script>
    <script src="../assets/js/main.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function () {
        refresh();
      });

      function refresh() {
        $.ajax({
          type: 'GET',
          url: 'proses/pesanan_list_proses.php',
          cache: false,
          success: function (response) {
            $('#table-content').html(response);
          },
          complete: function () {
            setTimeout(refresh, 2000);
          }, error: function (response) {
            console.log(response);
          },
        });
      }
      
      function finishOrder(id, id_meja) {
        this.id = id;
        this.id_meja = id_meja;
        var self = this;
        $(document).ready(function () {
                $.ajax({
                  url: 'proses/pesanan_edit_proses.php',
                  data: {
                    'id': self.id,
                    'id_meja': self.id_meja
                  },
                  dataType: "html",
                  type: 'POST',
                  cache: false,
                  success: function (data) {
                    if (data == 'error') {
                      swal("400 Bad Request", "Data Tidak Dapat Diedit", "error");
                    } else {
                      document.getElementById(self.id).remove();
                    }
                  },
                  error: function (data) {
                    swal("400 Bad Request", "Data Tidak Dapat Diedit", "error");
                  }
                });
        });
      }
    </script>
  </body>

  </html>
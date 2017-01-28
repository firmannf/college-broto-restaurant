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
              </a>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-user fa-lg" style="margin-right: 16px;"></i></a>
                <ul class="dropdown-menu settings-menu" style="width: 20px;">
                  <li><a href="setting.php"><i class="fa fa-cog fa-lg"></i> Setting</a></li>
                  <li><a href="../proses/logout.php"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
                </ul>
              </li>
          </ul>
        </div>
      </nav>
    </header>
    <section id="body" class="container" style="margin-top:80px;">
      <?php
        $strQuery = "SELECT id_meja, nama_meja, status FROM meja ORDER BY id_meja ASC";
        $query = mysqli_query($connection, $strQuery);
        while($result = mysqli_fetch_assoc($query)){
      ?>
      <div class="col-md-6 col-lg-6 col-xs-6">
        <a style="cursor: pointer;" onClick="actionPelayan('<?php echo $result['status'];?>', <?php echo $result['id_meja'];?>)">
          <div class="card text-center">
            <div class="card-block">
              <h4 class="card-title">
                <?php
                  if($result['status'] === "Bayar") {
                ?>
                <i class="fa fa-money fa-3x" aria-hidden="true" style="color: #FF9800;"></i>
                <?php
                  } else if ($result['status'] === "Siap Saji") {
                ?>
                <i class="fa fa-cutlery fa-3x" aria-hidden="true" style="color: #2196F3;"></i>
                <?php
                  } else if ($result['status'] === "Kosong") {
                ?>
                <i class="fa fa-check fa-3x" aria-hidden="true" style="color: #4caf50;"></i>
                <?php
                  } else if ($result['status'] === "Terisi") {
                ?>
                <i class="fa fa-users fa-3x" aria-hidden="true"></i>
                <?php
                  }
                ?>
              </h4>
              <p class="card-text">
                <h6 style="color: #212121;"><b><?php echo "$result[nama_meja]";?></b>
                  <h6>
              </p>
            </div>
          </div>
        </a>
      </div>
      <?php
        }
      ?>
  </div>
  </section>
  <!-- Javascripts-->
  <script src="../assets/js/jquery-2.1.4.min.js"></script>
  <script src="../assets/js/essential-plugins.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/pace.min.js"></script>
  <script src="../assets/js/main.js"></script>
  <script src="../assets/js/plugins/sweetalert.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      refresh();
    });

    function refresh() {
      $.ajax({
        type: 'POST',
        url: 'proses/meja_list_proses.php',
        success: function (response) {
          $('#body').html(response);
        },
        complete: function () {
          setTimeout(refresh, 2000);
        }
      });
    }

    String.prototype.strcmp = function (s) {
      if (this < s) return -1;
      if (this > s) return 1;
      return 0;
    }

    function actionPelayan(status, id) {
      this.id = id;
      var self = this;
      if ((status == 'Siap Saji') || status == 'Bayar') {
        $.ajax({
          url: 'proses/meja_edit_proses.php',
          data: {
            'id': self.id
          },
          dataType: "html",
          type: 'POST',
          success: function (response) {
            console.log(response)
          }
        });
      }
    }
  </script>
  <?php
    if(isset($_GET['m'])) {
      if($_GET['m'] === 'welcome') {
          echo "<script type=text/javascript>
                swal('Selamat Datang $_SESSION[nama_pelanggan]');
          </script>";
      } else if($_GET['m'] === 'success-add-data') {
          echo "<script type=text/javascript>
                swal('Berhasil', 'Data Berhasil Ditambahkan', 'success');
          </script>";
      } else if($_GET['m'] === 'success-edit-data') {
          echo "<script type=text/javascript>
                swal('Berhasil', 'Data Berhasil Diedit', 'success');
          </script>";
      }
    }

    if(isset($_GET['e'])) {
      if($_GET['e'] === 'bad-request') {
          echo "<script type=text/javascript>
                swal('400 Bad Request', 'Terjadi Kesalahan Saat Memproses Data Pelanggan', 'error');
          </script>";
      }else if($_GET['e'] === 'already-exist') {
          echo "<script type=text/javascript>
                swal('Terima Kasih', 'Anda Sudah Memberikan Review, Semoga Kedepannya Resto Broto Menjadi Lebih Baik', 'success');
          </script>";
      }
    }
  ?>
</body>

</html>
<?php
  require_once "../proses/connection.php";

  $id = 0;
  $nama_meja = "";
  $status = "";
  if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $strQuery = "SELECT id_meja, nama_meja, status FROM meja WHERE id_meja = '$id'";
    $query = mysqli_query($connection, $strQuery);
      if($query){
        $result = mysqli_fetch_array($query, MYSQLI_ASSOC);
        $id = $result['id_meja'];
        $nama_meja = $result['nama_meja'];
        $status = $result['status'];
      }
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

<body>
  <section class="material-half-bg">
    <div class="cover"></div>
  </section>
  <section class="login-content">
    <div class="logo">
      <h1>Resto Broto</h1>
    </div>
    <div class="login-box">
      <form method="POST" action="proses/mulai.php" class="login-form">
        <div class="form-group btn-container" style="text-align: center; margin-top: -8px;">
          <h1><b><?php echo strtoupper($nama_meja);?></b></h1>
        </div>
        <div class="form-group">
          <label class="control-label">Nama</label>
          <input type="text" name="nama" placeholder="Silahkan tulis nama untuk memesan" autofocus required class="form-control"
            required>
        </div>
        <div class="form-group btn-container">
          <input type="hidden" name="id" value="<?php echo $id;?>"/>
          <button class="btn btn-primary btn-block input-lg" <?php if(empty($id)) echo "disabled";?>>Mulai Memesan</button>
        </div>
      </form>
    </div>
  </section>
  <script src="../assets/js/jquery-2.1.4.min.js"></script>
  <script src="../assets/js/essential-plugins.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/pace.min.js"></script>
  <script src="../assets/js/main.js"></script>
  <script src="../assets/js/plugins/sweetalert.min.js"></script>
  <?php
    if(!isset($_GET['id'])) {
        echo "<script type=text/javascript>
      			swal('401 Unauthorized', 'Meja Tidak Ditemukan', 'error');
      </script>";
    }

    if(isset($_GET['e'])) {
      if($_GET['e'] === 'bad-request') {
          echo "<script type=text/javascript>
                swal('400 Bad Request', 'Terjadi Kesalahan Pada Sistem', 'error');
          </script>";
      }
    }
  ?>
</body>
</html>
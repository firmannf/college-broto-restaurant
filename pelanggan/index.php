<?php
  require_once "../proses/connection.php";

  $id = 0;
  if(isset($_GET['id'])) {
    $id = $_GET['id'];
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
        <form action="proses/mulai.php" class="login-form">
          <div class="form-group btn-container" style="text-align: center; margin-top: -8px;">
            <h1><b>MEJA <?php echo $id;?></b></h1>
          </div>
          <div class="form-group">
            <label class="control-label">Nama</label>
            <input type="text" name="nama_pelanggan" placeholder="Silahkan tulis nama untuk memesan" autofocus required class="form-control" required>
          </div>
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block input-lg">Mulai Memesan</button>
          </div>
        </form>
      </div>
    </section>
  </body>
  <script src="../assets/js/jquery-2.1.4.min.js"></script>
  <script src="../assets/js/essential-plugins.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/pace.min.js"></script>
  <script src="../assets/js/main.js"></script>

  </html>
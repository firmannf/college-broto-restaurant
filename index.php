<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
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
      <form action="proses/login.php" method="POST" class="login-form">
        <div class="form-group">
          <label class="control-label">NIK</label>
          <input type="text" name="nik" placeholder="NIK" class="form-control" autofocus>
        </div>
        <div class="form-group" style="margin-bottom: 24px;">
          <label class="control-label">PASSWORD</label>
          <input type="password" name="password" placeholder="Password" class="form-control">
        </div>
        <div class="form-group btn-container">
          <button class="btn btn-primary btn-block input-lg">SIGN IN</button>
        </div>
      </form>
    </div>
  </section>
  <script src="assets/js/jquery-2.1.4.min.js"></script>
  <script src="assets/js/essential-plugins.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/plugins/pace.min.js"></script>
  <script src="assets/js/main.js"></script>
  <script src="assets/js/plugins/sweetalert.min.js"></script>
  <!--Handling Error and Success Message-->
  <?php
  if(isset($_GET['e'])) {
    if($_GET['e'] === 'invalid-login-credential') {
      echo "<script type=text/javascript>
      			swal('Login Gagal', 'Username atau Password Tidak Cocok', 'error');
      </script>";
    } else if($_GET['e'] === 'bad-request') {
      echo "<script type=text/javascript>
      			swal('400 Bad Request', 'Terjadi Kesalahan Saat Memproses Data Login', 'error');
      </script>";
    } else if($_GET['e'] === 'unauthorized') {
      echo "<script type=text/javascript>
      			swal('401 Unauthorized', 'Anda Tidak Mempunyai Akses ke Halaman Tersebut', 'error');
      </script>";
    }
  }
  ?>
</body>

</html>
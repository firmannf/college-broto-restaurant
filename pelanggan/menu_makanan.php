<?php
  require_once "../proses/connection.php";
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
              <a href="menu_kategori.php"><i class="fa fa-arrow-left fa-lg" style="margin-left: 16px;"></i></a>
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
      <h2 align="center" style="margin-bottom:15px;"> Pilih Makanan Terbaik </h2>
      <h5 align="center" style="margin-bottom:30px;"> Dari lidah turun ke hati, makanan yang bikin jatuh cinta lagi</h5>
      <?php
        $strQuery = "SELECT m.id_menu, m.nama_menu, m.foto, bb.stok, m.harga, m.status
                                    FROM menu m INNER JOIN menu_detail md ON m.id_menu = md.id_menu
                                    INNER JOIN bahanbaku bb ON md.id_bahanbaku = bb.id_bahanbaku
                                    WHERE m.kategori = 'Makanan'
                                    GROUP BY m.id_menu
                                    HAVING m.id_menu 
                                    NOT IN(
                                      SELECT m.id_menu
                                      FROM menu m INNER JOIN menu_detail md ON m.id_menu = md.id_menu
                                      INNER JOIN bahanbaku bb ON md.id_bahanbaku = bb.id_bahanbaku
                                      WHERE bb.tgl_kadaluarsa < NOW() OR bb.stok <= 0 OR m.id_menu IN
                                      (
                                        SELECT m.id_menu
                                        FROM menu m INNER JOIN menu_detail md ON m.id_menu = md.id_menu
                                        INNER JOIN bahanbaku bb ON md.id_bahanbaku = bb.id_bahanbaku
                                        WHERE m.id_menu IN (
                                          SELECT m.id_menu
                                          FROM menu m INNER JOIN menu_detail md ON m.id_menu = md.id_menu
                                          INNER JOIN bahanbaku bb ON md.id_bahanbaku = bb.id_bahanbaku
                                          WHERE (bb.stok - md.qty) < 0
                                        )
                                      )
                                    )
                                    AND m.status = 'Ya';";
        $query = mysqli_query($connection, $strQuery);
        $i = 0;
        while($result = mysqli_fetch_assoc($query)){
      ?>
      <div class="col-md-6 col-lg-6 col-xs-6">
        <div class="card" style="padding: 0px 0px 32px !important;">
          <img class="card-img-top" src="../uploads/menu/<?php echo $result['foto'];?>" style="width:100%; height:96px" alt="Card image cap">
          <div class="card-block">
            <h5 class="card-title" align="center" style="margin-top: 12px;"><b><?php echo $result['nama_menu'];?><b></h5>
            <div class="row">
              <div class="col-md-6" style="text-align: center;">
                <h6><b>Rp. <?php echo $result['harga'];?><b><h6>
              </div>
              <div class="col-md-6" style="text-align: center;">
                <button onClick="choose(<?php echo $result['id_menu'];?>)" class="btn btn-primary">Pilih</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
          $i++;
        }
      ?>
    </section>
  </div>
  <!-- Javascripts-->
  <script src="../assets/js/jquery-2.1.4.min.js"></script>
  <script src="../assets/js/essential-plugins.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/pace.min.js"></script>
  <script src="../assets/js/main.js"></script>
  <script src="../assets/js/plugins/sweetalert.min.js"></script>
  <script>
    function choose(id) {
        this.id = id;
        var self = this;
        swal({
            title: "Masukkan Jumlah",
            type: "input",
            inputType: "number",
            showCancelButton: true,
            closeOnConfirm: false,
            inputPlaceholder: "Jumlah"
          },
          function (inputValue) {
            if (inputValue === false) return false;
            if (inputValue === "") {
              swal.showInputError("Jumlah Masih Kosong");
              return false
            }
            $.ajax({
                  url: 'proses/pesanan_tambah_proses.php',
                  data: {
                    'id': self.id,
                    'jumlah': inputValue
                  },
                  dataType: "html",
                  type: 'POST',
                  cache: false,
                  success: function (data) {
                    if (data == 'error') {
                      swal("400 Bad Request", "Menu Tidak Dapat Ditambahkan", "error");
                    } else {
                      swal("Sukses", "Menu Ditambahkan", "success");
                      console.log(data);
                    }
                  },
                  error: function (data) {
                    swal("400 Bad Request", "Data Tidak Dapat Dihapus", "error");
                  }
            });
          });
      }
  </script>
</body>

</html>
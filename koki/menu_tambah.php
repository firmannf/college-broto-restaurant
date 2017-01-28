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
          <li><a href="pesanan_list.php"><i class="fa fa-list-alt"></i><span>Daftar Pesanan</span></a></li>
          <li class="treeview active"><a href="#"><i class="fa fa-cutlery"></i><span>Atur Menu</span><i class="fa fa-angle-right"></i></a>
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
          <h1><i class="fa fa-cutlery"></i> Atur Menu</h1>
          <p>Olah data menu di resto broto</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <div class="card">
            <h3 class="card-title">Tambah Data Menu</h3>
            <div class="card-body">
              <form id="form-menu" method="post" action="proses/menu_tambah_proses.php" enctype="multipart/form-data">
                <div class="form-group">
                  <label class="control-label">Foto</label>
                  <input type="file" class="form-control" name="foto" required>
                </div>
                <div class="form-group">
                  <label class="control-label">Nama Menu</label>
                  <input type="text" name="nama" placeholder="Masukkan nama menu" class="form-control" required>
                </div>
                <div class="form-group">
                  <label class="control-label">Kategori</label>
                  <select class="form-control" name="kategori">
                    <option value="Makanan">Makanan</option>
                    <option value="Minuman">Minuman</option>
                  </select>
                </div>
                <div class="form-group">
                  <label class="control-label">Estimasi Penyajian (menit)</label>
                  <input type="number" name="estimasi" placeholder="Masukkan estimasi penyajian" class="form-control" required>
                </div>
                <div class="form-group">
                  <label class="control-label">Usulan Harga</label>
                  <input type="number" name="harga" placeholder="Masukkan harga" class="form-control" required>
                </div>
                <div class="form-group">
                  <label class="control-label">Bahan Baku &nbsp;&nbsp;&nbsp;<a onClick="addField()" style="cursor: pointer;"><i class="fa fa-plus-square"></i></a>&nbsp;&nbsp;&nbsp;<a onClick="deleteField()" style="cursor: pointer;"><i class="fa fa-minus-square"></i></a></label>
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="table-ingredients">
                      <thead>
                        <tr>
                          <th>Bahan</th>
                          <th>Jumlah</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <select class="form-control input-sm" name="id_bahanbaku">
                              <?php
                              $strQuery = "SELECT id_bahanbaku, nama_bahanbaku, satuan FROM bahanbaku ORDER BY nama_bahanbaku ASC";
                              $query = mysqli_query($connection, $strQuery);
                              while($result = mysqli_fetch_assoc($query)){
                                echo "<option value=$result[id_bahanbaku]>$result[nama_bahanbaku] ($result[satuan])</option>";
                              }
                              ?>
                            </select>
                          </td>
                          <td>
                            <input type="number" step="any" name="qty" placeholder="Masukkan jumlah" class="form-control input-sm" required>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="card-footer" style="text-align: center;">
                  <button type="submit" class="btn btn-primary icon-btn input-lg"><i class="fa fa-fw fa-lg fa-check-circle"></i>Simpan</button>
                </div>
              </form>
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
  <script src="../assets/js/plugins/sweetalert.min.js"></script>
  <script>
    function addField() {
      $.ajax({
        url: "proses/bahanbaku_data_json.php",
        method: "GET",
        cache: false,
        success: function (data) {
          var myTable = document.getElementById("table-ingredients");
          var id = [];
          var nama = [];
          var tempData = [];
          tempData = JSON.parse(data);
          var currentIndex = myTable.rows.length;
          var currentRow = myTable.insertRow(-1);

          var bahanbakuBox = document.createElement("select");
          bahanbakuBox.setAttribute("name", "id_bahanbaku");
          bahanbakuBox.setAttribute("class", "form-control input-sm");

          for (var i = 0; i < tempData.length; i++) {
            var option = document.createElement("option");
            option.setAttribute("value", tempData[i].id_bahanbaku);
            option.text = tempData[i].nama_bahanbaku + " (" + tempData[i].satuan + ")";
            bahanbakuBox.appendChild(option);
          }

          var jumlahBox = document.createElement("input");
          jumlahBox.setAttribute("name", "qty");
          jumlahBox.setAttribute("type", "number");
          jumlahBox.setAttribute("step", "any");
          jumlahBox.setAttribute("class", "form-control input-sm");
          jumlahBox.setAttribute("placeholder", "Masukkan jumlah");

          currentCell = currentRow.insertCell(-1);
          currentCell.appendChild(bahanbakuBox);

          currentCell = currentRow.insertCell(-1);
          currentCell.appendChild(jumlahBox);
        }
      });
    }

    (function ($) {
      $.extend({
        toDictionary: function (query) {
          var parms = {};
          var items = query.split("&"); // split
          for (var i = 0; i < items.length; i++) {
            var values = items[i].split("=");
            var key = decodeURIComponent(values.shift());
            var value = values.join("=")
            parms[key] = decodeURIComponent(value);
          }
          return (parms);
        }
      })
    })(jQuery);


    (function ($) {
      $.fn.serializeFormJSON = function () {
        var o = [];
        $(this).find('tr').each(function () {
          var elements = $(this).find('input, textarea, select')
          console.log($(this));
          if (elements.size() > 0) {
            var serialized = $(this).find('input, textarea, select').serialize();
            var item = $.toDictionary(serialized);
            o.push(item);
          }
        });
        return o;
      };
    })(jQuery);

    function deleteField() {
      var myTable = document.getElementById("table-ingredients");
      if(myTable.rows.length > 2)
        myTable.deleteRow(myTable.rows.length - 1);
    }

    $("#form-menu").submit(function(event) {
        var rawData = $('#table-ingredients').serializeFormJSON();
        var input = $("<input>")
               .attr("type", "hidden")
               .attr("name", "bahanbaku").val(JSON.stringify(rawData));
        $('#form-menu').append($(input));
    });
  </script>

  <!--Handling Error and Success Message-->
  <?php
    if(isset($_GET['e'])) {
      if($_GET['e'] === 'bad-request') {
        echo "<script type=text/javascript>
               swal('400 Bad Request', 'Terjadi Kesalahan Saat Memproses Data Menu', 'error');
        </script>";
    }
  }
  ?>
</body>

</html>
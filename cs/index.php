<?php
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
            <li class="active"><a href="index.php"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
            <li><a href="pelanggan_review.php"><i class="fa fa-star"></i><span>Review Pelanggan</span></a></li>
          </ul>
        </section>
      </aside>
      <div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
            <p>Selamat datang di halaman customer service resto broto</p>
          </div>
          <div class="col-md-2">
            <a href="#" class="btn btn-success pull-right"><i class="fa fa-print"></i>&nbsp;&nbsp;&nbsp;Cetak</a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-10">
                <div class="form-group">
                  <!--<label for="inputSmall">Pilih berdasarkan</label>
                <select id="inputSmall" type="text" class="form-control input-sm" style="width: 156px;">
                  <option>Minggu</option>
                  <option selected>Bulan</option>
                  <option>Tahun</option>
                </select>-->
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="embed-responsive embed-responsive-16by9">
                <canvas id="pelayanan" class="embed-responsive-item"></canvas>
              </div>
              <br/>
              <center>
                <h3 class="card-title">Pelayanan</h3>
              </center>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="embed-responsive embed-responsive-16by9">
                <canvas id="harga" class="embed-responsive-item"></canvas>
              </div>
              <br/>
              <center>
                <h3 class="card-title">Harga</h3>
              </center>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="embed-responsive embed-responsive-16by9">
                <canvas id="makanan" class="embed-responsive-item"></canvas>
              </div>
              <br/>
              <center>
                <h3 class="card-title">Makanan</h3>
              </center>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="embed-responsive embed-responsive-16by9">
                <canvas id="minuman" class="embed-responsive-item"></canvas>
              </div>
              <br/>
              <center>
                <h3 class="card-title">Minuman</h3>
              </center>
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
    <script type="text/javascript" src="../assets/js/plugins/chart.js"></script>
    <script type="text/javascript">
      $(document).ready(function () {
        $.ajax({
          url: "proses/pelayanan_data_json.php",
          method: "GET",
          success: function (data) {
            var bulan = [];
            var pelayanan = [];

            data = JSON.parse(data);
            for (i = 0; i < data.length; i++) {
              bulan.push(data[i].bulan);
              pelayanan.push(data[i].pelayanan);
            }

            var chartData = {
              labels: bulan,
              datasets: [{
                label: "Pelayanan",
                fillColor: "rgba(220,220,220,0.5)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#FFFFFF",
                pointHighlightFill: "#FFFFFF",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: pelayanan
              }]
            };

            var ctx = $("#pelayanan").get(0).getContext("2d");
            var barChart1 = new Chart(ctx).Bar(chartData);
          }
        })
      });

      $(document).ready(function () {
        $.ajax({
          url: "proses/harga_data_json.php",
          method: "GET",
          success: function (data) {
            var bulan = [];
            var harga = [];

            data = JSON.parse(data);
            for (i = 0; i < data.length; i++) {
              bulan.push(data[i].bulan);
              harga.push(data[i].harga);
            }

            var chartData = {
              labels: bulan,
              datasets: [{
                label: "Harga",
                fillColor: "rgba(220,220,220,0.5)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#FFFFFF",
                pointHighlightFill: "#FFFFFF",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: harga
              }]
            };

            var ctx = $("#harga").get(0).getContext("2d");
            var barChart1 = new Chart(ctx).Bar(chartData);
          }
        })
      });

      $(document).ready(function () {
        $.ajax({
          url: "proses/makanan_data_json.php",
          method: "GET",
          success: function (data) {
            var bulan = [];
            var makanan = [];

            data = JSON.parse(data);
            for (i = 0; i < data.length; i++) {
              bulan.push(data[i].bulan);
              makanan.push(data[i].makanan);
            }

            var chartData = {
              labels: bulan,
              datasets: [{
                label: "Makanan",
                fillColor: "rgba(220,220,220,0.5)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#FFFFFF",
                pointHighlightFill: "#FFFFFF",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: makanan
              }]
            };

            var ctx = $("#makanan").get(0).getContext("2d");
            var barChart1 = new Chart(ctx).Bar(chartData);
          }
        })
      });

      $(document).ready(function () {
        $.ajax({
          url: "proses/minuman_data_json.php",
          method: "GET",
          success: function (data) {
            var bulan = [];
            var minuman = [];

            data = JSON.parse(data);
            for (i = 0; i < data.length; i++) {
              bulan.push(data[i].bulan);
              minuman.push(data[i].minuman);
            }

            var chartData = {
              labels: bulan,
              datasets: [{
                label: "Minuman",
                fillColor: "rgba(220,220,220,0.5)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#FFFFFF",
                pointHighlightFill: "#FFFFFF",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: minuman
              }]
            };

            var ctx = $("#minuman").get(0).getContext("2d");
            var barChart1 = new Chart(ctx).Bar(chartData);
          }
        })
      });
    </script>
  </body>

  </html>
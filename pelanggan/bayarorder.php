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
  <div class="page">
    <header class="container">
      <div id="menu" class="navbar navbar-default navbar-fixed-top">
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-left">
            <li class="nav"><a href="#"><i class="fa fa-arrow-left fa-lg" style="margin-right: 16px;"></i></a>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="nav"><a href="#"><i class="fa fa-shopping-cart fa-lg" style="margin-right: 16px;"></i></a>
            </li>
          </ul>
        </div>
      </div>
    </header>
  <section id="body" class="container">
    <div class="page-header" style="margin-top: 50px;">
        <h1>Bayar Order</h1>
    </div>
    <div class="card" style="padding: 16px 48px; margin-top:40px">
    <div class="table-responsive" style="margin-top: 20px; background-color=#FFFFFF">
      <table class="table table-hover table-bordered">
        <thead>
          <tr>
            <th>Nama Pesanan</th>
            <th>Qty</th>
            <th>Subtotal</th>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </thead>
      </table>
    </div>
    <div class="row">
    <div class="col-md-6 text-right"><h4> Subtotal : Rp. 42</h4></div>
    </div>
    <div class="row">
    <div class="col-md-6 text-right"><h4> Pajak : Rp. 42</h4></div>
    </div>
    <div class="row">
    <div class="col-md-6 text-right"><h4> Total : Rp. 42</h4></div>
    </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-xs-12 col-lg-12 center-block">
       <button id="buttonBayar" name="buttonBayar" class="btn btn-success center-block" onClick="bayarOrder()" style="margin-top: 40px;">
           <h3> Bayar Order </h3>
       </button>
       <script>
       function bayarOrder(){
         swal({
           title: "Mohon Tunggu",
           text: "Pelayanan kami akan datang untuk melakukan konfirmasi pembayaran, Terimakasih sudah mengunjungi Resto Broto. semoga anda puas dan dapat kembali Lagi kesini, tekan OK untuk Melanjutkan",
           type: "success",
           showCancelButton: false,
           confirmButtonColor: "#DD6B55",
           confirmButtonText: "OK",
           closeOnConfirm: false
         });
       }
       </script>
   </div>
    </div>
  </div>

  </section>
  <!-- Javascripts-->
  <script src="../assets/js/jquery-2.1.4.min.js"></script>
  <script src="../assets/js/essential-plugins.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/pace.min.js"></script>
  <script src="../assets/js/main.js"></script>
  <script src="../assets/js/plugins/sweetalert.min.js"></script>
</body>

</html>

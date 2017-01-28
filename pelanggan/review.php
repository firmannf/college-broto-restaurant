<?php
    require_once "../proses/connection.php";
    session_start();
    $strQuery = "SELECT id_kuesioner FROM kuesioner WHERE id_pesanan = '$_SESSION[id_pesanan]'";
    $query = mysqli_query($connection, $strQuery);
    if($query){
        if(mysqli_num_rows($query) > 0) {
            echo "<script type=text/javascript>document.location.href='menu.php?e=already-exist'</script>";
        }
    } else {
        echo "<script type=text/javascript>document.location.href='menu.php?e=bad-request'</script>";
    }
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
                            <a href="menu.php"><i class="fa fa-arrow-left fa-lg" style="margin-left: 16px;"></i></a>
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
            <h2 align="center" style="margin-bottom:30px;"> Beri Review </h2>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <h5 align="center"> Untuk Meningkatkan pelayanan dan kualitas restoran, kami mohon memberi review berupa komentar kritik
                            dan saran dengan Sejujur Mungkin
                        </h5>
                    </div>
                </div>
                <div class="col-md-12">
                    <form method="post" action="proses/kuesioner_tambah_proses.php">
                        <div class="form-group">
                            <div class="form-group">
                                <label class="control-label col-md-2">Kritik dan Saran </label>
                                <div class="col-md-10">
                                    <textarea name="review" cols="40" rows="6" class="form-control" placeholder="Silahkan masukan kritik dan Saran "></textarea>
                                </div>
                            </div>
                            <div class="container">
                                <div class="row">
                                </div>
                                <div class="row lead">
                                    <div class="col-md-6 col-xs-6">
                                        Rating Pelayanan
                                        <div id="pelayanan" class="starrr"></div>
                                        <input id="valuepelayanan" type="hidden" name="pelayanan"/>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        Rating Harga
                                        <div id="harga" class="starrr"></div>
                                        <input id="valueharga" type="hidden" name="harga"/>
                                    </div>
                                </div>
                                <div class="row lead">
                                    <div class="col-md-6 col-xs-6">
                                        Rating Makanan
                                        <div id="makanan" class="starrr"></div>
                                        <input id="valuemakanan" type="hidden" name="makanan"/>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        Rating Minuman
                                        <div id="minuman" class="starrr"></div>
                                        <input id="valueminuman" type="hidden" name="minuman"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button id="singlebutton" name="singlebutton" class="btn btn-success center-block" style="margin: 20px auto; width: 70%;">
                                    KIRIM REVIEW
                            </button>
                        </div>
                    </form>
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
    <script>
        // Starrr plugin (https://github.com/dobtco/starrr)
        var __slice = [].slice;

        (function ($, window) {
            var Starrr;

            Starrr = (function () {
                Starrr.prototype.defaults = {
                    rating: void 0,
                    numStars: 5,
                    change: function (e, value) {}
                };

                function Starrr($el, options) {
                    var i, _, _ref,
                        _this = this;

                    this.options = $.extend({}, this.defaults, options);
                    this.$el = $el;
                    _ref = this.defaults;
                    for (i in _ref) {
                        _ = _ref[i];
                        if (this.$el.data(i) != null) {
                            this.options[i] = this.$el.data(i);
                        }
                    }
                    this.createStars();
                    this.syncRating();
                    this.$el.on('mouseover.starrr', 'i', function (e) {
                        return _this.syncRating(_this.$el.find('i').index(e.currentTarget) + 1);
                    });
                    this.$el.on('mouseout.starrr', function () {
                        return _this.syncRating();
                    });
                    this.$el.on('click.starrr', 'i', function (e) {
                        console.log(_this.$el.find('i').index(e.currentTarget) + 1);
                        return _this.setRating(_this.$el.find('i').index(e.currentTarget) + 1);
                    });
                    this.$el.on('starrr:change', this.options.change);
                }

                Starrr.prototype.createStars = function () {
                    var _i, _ref, _results;

                    _results = [];
                    for (_i = 1, _ref = this.options.numStars; 1 <= _ref ? _i <= _ref : _i >= _ref; 1 <=
                        _ref ? _i++ : _i--) {
                        _results.push(this.$el.append("<i class='fa fa-star-o'></i>"));
                    }
                    return _results;
                };

                Starrr.prototype.setRating = function (rating) {
                    if (this.options.rating === rating) {
                        rating = void 0;
                    }
                    this.options.rating = rating;
                    this.syncRating();
                    return this.$el.trigger('starrr:change', rating);
                };

                Starrr.prototype.syncRating = function (rating) {
                    var i, _i, _j, _ref;

                    rating || (rating = this.options.rating);
                    if (rating) {
                        for (i = _i = 0, _ref = rating - 1; 0 <= _ref ? _i <= _ref : _i >= _ref; i =
                            0 <= _ref ? ++_i : --_i) {
                            this.$el.find('i').eq(i).removeClass('fa-star-o').addClass('fa-star');
                        }
                    }
                    if (rating && rating < 5) {
                        for (i = _j = rating; rating <= 4 ? _j <= 4 : _j >= 4; i = rating <= 4 ? ++
                            _j : --_j) {
                            this.$el.find('i').eq(i).removeClass('fa-star').addClass('fa-star-o');
                        }
                    }
                    if (!rating) {
                        return this.$el.find('i').removeClass('fa-star').addClass('fa-star-o');
                    }
                };

                return Starrr;

            })();
            return $.fn.extend({
                starrr: function () {
                    var args, option;

                    option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
                    return this.each(function () {
                        var data;

                        data = $(this).data('star-rating');
                        if (!data) {
                            $(this).data('star-rating', (data = new Starrr($(this), option)));
                        }
                        if (typeof option === 'string') {
                            return data[option].apply(data, args);
                        }
                    });
                }
            });
        })(window.jQuery, window);

        $(function () {
            return $(".starrr").starrr();
        });

        $(document).ready(function () {
            $('#pelayanan').on('starrr:change', function (e, value) {
                $('#valuepelayanan').val(value);
            });

            $('#harga').on('starrr:change', function (e, value) {
                $('#valueharga').val(value);
            });

            $('#makanan').on('starrr:change', function (e, value) {
                $('#valuemakanan').val(value);
            });

            $('#minuman').on('starrr:change', function (e, value) {
                $('#valueminuman').val(value);
            });
        });
    </script>
    <?php
    if(isset($_GET['e'])) {
      if($_GET['e'] === 'bad-request') {
          echo "<script type=text/javascript>
                swal('400 Bad Request', 'Terjadi Kesalahan Saat Memproses Data Pelanggan', 'error');
          </script>";
      }
    }
    ?>
</body>

</html>
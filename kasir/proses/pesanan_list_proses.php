<?php
    require "../../proses/connection.php";
    session_start();
          if(isset($_GET['q'])){
            $strQuery = "SELECT id_pesanan, tgl_order, nama_pelanggan, uang_bayar, status 
                          FROM pesanan WHERE id_pesanan = '$_GET[q]' 
                          OR nama_pelanggan LIKE '%$_GET[q]%' ORDER BY tgl_order DESC";
          }else {
            $strQuery = "SELECT id_pesanan, tgl_order, nama_pelanggan, uang_bayar, status 
                          FROM pesanan ORDER BY tgl_order DESC";
          }
          $query = mysqli_query($connection, $strQuery);
          $i = 0;
          while($result = mysqli_fetch_assoc($query)){
?>
<div class="col-md-6">
    <div class="card" style="padding-bottom: 0px;">
        <div class="table-responsive">
            <table class="table table-borderless">
                <tr>
                    <td><b>ID Pesanan</b></td>
                    <td>
                        <?php echo $result['id_pesanan'];?>
                    </td>
                </tr>
                <tr>
                    <td><b>Tanggal Pesanan</b></td>
                    <td>
                        <?php echo $result['tgl_order'];?>
                    </td>
                </tr>
                <tr>
                    <td><b>Nama Pelanggan</b></td>
                    <td>
                        <?php echo $result['nama_pelanggan'];?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right;">
                        <br/>
                        <?php
                          if($result['status'] === "Belum Bayar") {
                        ?>
                        <a data-toggle="modal" data-target="#detail<?php echo $i;?>" class="btn btn-primary">Validasi</a>
                        <?php
                          } else {
                        ?>
                        <a href="proses/nota_cetak_proses.php?id=<?php echo $result['id_pesanan'];?>" class="btn btn-default" target="_blank"><i class="fa fa-print"></i></a>
                        <a data-toggle="modal" data-target="#detail<?php echo $i;?>" class="btn btn-success">Sudah Bayar</a>
                        <?php
                          }
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="detail<?php echo $i;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form action="proses/pembayaran_edit_proses.php" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Detail Order</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-borderless">
                        <tr>
                            <td><b>ID Pesanan</b></td>
                            <td>
                                <?php echo $result['id_pesanan'];?>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Tanggal</b></td>
                            <td>
                                <?php echo $result['tgl_order'];?>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Nama Pelanggan</b></td>
                            <td>
                                <?php echo $result['nama_pelanggan'];?>
                            </td>
                        </tr>
                    </table>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>Nama Menu</td>
                                <td>Harga</td>
                                <td>Qty</td>
                                <td>Subtotal</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $strQuery = "SELECT m.id_menu, p.id_pesanan,m.nama_menu, m.harga, pd.qty 
                            FROM pesanan_detail pd INNER JOIN pesanan p ON pd.id_pesanan = p.id_pesanan
                            INNER JOIN menu m on pd.id_menu = m.id_menu 
                            WHERE p.id_pesanan = '$result[id_pesanan]' ORDER BY m.id_menu ASC";
                            $subquery = mysqli_query($connection, $strQuery);
                            $i = 0;
                            $total = 0;
                            while($subRresult = mysqli_fetch_assoc($subquery)){
                              echo "<tr>";
                              echo "<td>$subRresult[nama_menu]</td>";
                              echo "<td style=\"text-align: right\">Rp. $subRresult[harga]</td>";
                              echo "<td>$subRresult[qty]</td>";
                              $subtotal = $subRresult['harga'] * $subRresult['qty'];
                              $total += $subtotal;
                              echo "<td style=\"text-align: right\">Rp. $subtotal</td>";
                              echo "</tr>";
                            }
                            $pajak = $total * 0.10;
                            $grandtotal = $total + $pajak;
                          ?>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-8">
                            <table class="table table-borderless">
                                <tr>
                                    <td><b>Total</b></td>
                                    <td style="text-align: right">Rp.
                                        <?php echo $total;?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Pajak</b></td>
                                    <td style="text-align: right">Rp.
                                        <?php echo $pajak;?>
                                    </td>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Total Keseluruhan</b></td>
                                    <td style="text-align: right">Rp.
                                        <?php echo $grandtotal;?>
                                    </td>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Bayar</b></td>
                                    <?php
                              if($result['status'] === "Belum Bayar") {
                              ?>
                                    <td style="text-align: right"><input type="number" name="uang_bayar" class="form-control input-sm" required/></td>
                                    <?php
                              } else {
                              ?>
                                    <td style="text-align: right"><input type="number" value="<?php echo $result['uang_bayar'];?>" class="form-control input-sm"
                                            readonly/></td>
                                    <?php
                              }
                              ?>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php
                      if($result['status'] === "Belum Bayar") {
                      ?>
                    <input type="hidden" name="id" value="<?php echo $result['id_pesanan'];?>">
                    <input type="hidden" name="total_bayar" value="<?php echo $grandtotal;?>">
                    <button type="submit" class="btn btn-primary">Validasi dan Cetak Nota</a>
                      <?php
                      }
                      ?>
                      <button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Close</button>
                </div>
        </form>
        </div>
    </div>
</div>
<?php
            $i++;
          }
          ?>
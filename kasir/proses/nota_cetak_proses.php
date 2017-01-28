<?php
	require "../../proses/connection.php";
    session_start();
    $strQuery = "SELECT id_pesanan, tgl_order, nama_pelanggan, uang_bayar, status 
                          FROM pesanan WHERE id_pesanan = '$_GET[id]'";
    $query = mysqli_query($connection, $strQuery);
    $result = mysqli_fetch_array($query, MYSQLI_ASSOC);
    echo $result['nama_pelanggan'];
?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Resto Broto</title>
</head>

<body>
    <br/>
    <?php
		echo "<h1>Resto Broto</h1>"; 
    ?>
    <br/>
    <table border="0">
        <tr>
            <td><b>ID Pesanan</b></td>
            <td>&nbsp;&nbsp;&nbsp;<?php echo $result['id_pesanan'];?></td>
        </tr>
        <tr>
            <td><b>Tanggal Pesanan</b></td>
            <td>&nbsp;&nbsp;&nbsp;<?php echo $result['tgl_order'];?></td>
        </tr>
        <tr>
            <td><b>Nama Pelanggan</b></td>
            <td>&nbsp;&nbsp;&nbsp;<?php echo $result['nama_pelanggan'];?></td>
        </tr>
    </table>
    <table border="1" cellspacing="0">
        <tr>
            <td><b>Nama Menu</b></td>
            <td><b>Harga</b></td>
            <td><b>Jumlah</b></td>
            <td><b>Subtotal</b></td>
        </tr>
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
                $grandtotal = $total - $pajak;
            ?>
        </tbody>
    </table>
    <table border="0">
        <tr>
            <td><b>Total</b></td>
            <td style="text-align:right;">&nbsp;&nbsp;&nbsp;Rp. <?php echo $total;?></td>
        </tr>
        <tr>
            <td><b>Pajak</b></td>
            <td style="text-align:right;">&nbsp;&nbsp;&nbsp;Rp. <?php echo $pajak;?></td>
        </tr>        
        <tr>
            <td><b>Total Keseluruhan</b></td>
            <td style="text-align:right;">&nbsp;&nbsp;&nbsp;Rp. <?php echo $grandtotal;?></td>
        </tr>
    </table>
    <table>        
        <tr>
            <td><b>Uang Bayar</b></td>
            <td style="text-align:right;">&nbsp;&nbsp;&nbsp;Rp. <?php echo $result['uang_bayar'];?></td>
        </tr>
        <tr>
            <td><b>Kembalian</b></td>
            <td style="text-align:right;">&nbsp;&nbsp;&nbsp;Rp. <?php echo $result['uang_bayar'] - $grandtotal;?></td>
        </tr>
    </table>
</body>

</html>
<?php
		$filename = "reviewpelanggan".date("YmdHis").".pdf";
		$content = ob_get_clean();
		$content = '<page style="font-family: freeserif">'.nl2br($content).'</page>';
		 require_once('../../assets/html2pdf/html2pdf.class.php');
		 try
		 {
		  $html2pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15',array(30, 0, 20, 0));
		  $html2pdf->setDefaultFont('Arial');
		  $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		  $html2pdf->Output($filename);
		 }
		 catch(HTML2PDF_exception $e) { echo $e; }
?>
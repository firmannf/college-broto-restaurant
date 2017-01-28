<?php
	require "../../proses/connection.php";
    session_start();
    $strQuery = "SELECT p.id_pesanan, p.nama_pelanggan, p.tgl_order, k.pelayanan, k.harga, k.makanan, k.minuman, k.review
                            FROM pesanan p INNER JOIN kuesioner k 
                            ON p.id_pesanan = k.id_pesanan
                            ORDER BY p.tgl_order DESC";
    $query = mysqli_query($connection, $strQuery);
    $result = mysqli_fetch_array($query, MYSQLI_ASSOC);
?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Resto Broto</title>
</head>

<body>
    <br/>
    <?php
		echo "<h1>Resto Broto Review Pelanggan</h1>"; 
    ?>
    <br/>
    <table border="1" cellspacing="0">
        <tr>
            <td><b>ID Pesanan</b></td>
            <td width="150"><b>Nama Pelanggan</b></td>
            <td><b>Tanggal Pesanan</b></td>
            <td><b>Pelayanan</b></td>
            <td><b>Harga</b></td>
            <td><b>Makanan</b></td>
            <td><b>Minuman</b></td>
            <td width="300"><b>Review</b></td>
        </tr>
        <tbody>
            <?php
                $query = mysqli_query($connection, $strQuery);
                while($result = mysqli_fetch_assoc($query)){
                    echo "<tr>";
                        echo "<td>$result[id_pesanan]</td>";
                        echo "<td>$result[nama_pelanggan]</td>";
                        echo "<td>$result[tgl_order]</td>";
                        echo "<td>$result[pelayanan]</td>";
                        echo "<td>$result[harga]</td>";
                        echo "<td>$result[makanan]</td>";
                        echo "<td>$result[minuman]</td>";
                        echo "<td>$result[review]</td>";
                    echo "</tr>";
                }
                ?>
        </tbody>
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
		  $html2pdf = new HTML2PDF('L','A4','en', false, 'ISO-8859-15',array(30, 0, 20, 0));
		  $html2pdf->setDefaultFont('Arial');
		  $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		  $html2pdf->Output($filename);
		 }
		 catch(HTML2PDF_exception $e) { echo $e; }
?>
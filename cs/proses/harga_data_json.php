<?php
	require "../../proses/connection.php";
			
	$strQuery = "SELECT SUM(k.harga) as harga, MONTHNAME(p.tgl_order) as bulan FROM kuesioner k INNER JOIN pesanan p 
                    ON k.id_pesanan = p.id_pesanan
                    GROUP BY MONTHNAME(p.tgl_order)
                    ORDER BY MONTHNAME(p.tgl_order) DESC";
	$query = mysqli_query($connection, $strQuery);
    $data = array();
    foreach ($query as $row) {
        $data[] = $row;
    }

	mysqli_close($connection);
    echo json_encode($data);
?>
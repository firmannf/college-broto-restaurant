<?php
	require "../../proses/connection.php";
    $strQuery = "SELECT pd.id_detail_pesanan, p.id_pesanan, me.nama_meja, m.nama_menu, pd.qty 
                                  FROM pesanan p INNER JOIN pesanan_detail pd ON p.id_pesanan = pd.id_pesanan 
                                  INNER JOIN meja me ON p.id_meja = me.id_meja
                                  INNER JOIN menu m ON pd.id_menu = m.id_menu WHERE pd.status = 'Belum' ORDER BY p.tgl_order DESC";
    $query = mysqli_query($connection, $strQuery);
    $i = 0;
        while($result = mysqli_fetch_assoc($query)){
            echo "<tr id=$result[id_detail_pesanan]>";
            echo "<td>$result[id_pesanan]</td>";
            echo "<td>$result[nama_meja]</td>";
            echo "<td>$result[nama_menu]</td>";
            echo "<td>$result[qty]</td>";
            echo "<td><a onClick=\"finishOrder($result[id_detail_pesanan])\" style=\"cursor: pointer;\"><i class=\"fa fa-check\"></i></a></td>";
            echo "&nbsp;&nbsp;&nbsp;";
            echo "</tr>";
        }
?>
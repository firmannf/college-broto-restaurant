<?php
	require "../../proses/connection.php";
	$id = $_POST['id'];
			
	
	$strQuery = "SELECT m.nama_menu, pd.id_pesanan, bb.id_bahanbaku, bb.nama_bahanbaku, bb.stok, md.qty as jumlah_dibutuhkan, pd.qty as jumlah_pesan
			FROM pesanan_detail pd INNER JOIN menu m ON pd.id_menu = m.id_menu
			INNER JOIN menu_detail md ON pd.id_menu = md.id_menu
			INNER JOIN bahanbaku bb ON md.id_bahanbaku = bb.id_bahanbaku WHERE pd.id_detail_pesanan = '$id'";
		
	$query = mysqli_query($connection, $strQuery);
	while($result = mysqli_fetch_array($query, MYSQLI_ASSOC)){
		$strSubQuery = "UPDATE bahanbaku SET stok = ($result[stok] + $result[jumlah_dibutuhkan] * $result[jumlah_pesan]) WHERE id_bahanbaku = '$result[id_bahanbaku]'";
		$subQuery = mysqli_query($connection, $strSubQuery);
		if(!$subQuery) {
			echo "error";
		}
	}
	if(!$query){
		echo "error";
	}

	$strQuery = "DELETE FROM pesanan_detail WHERE id_detail_pesanan = $id";
	$query = mysqli_query($connection, $strQuery);
	if(!$query){
	    echo "error";
	}
	
	mysqli_close($connection);
?>
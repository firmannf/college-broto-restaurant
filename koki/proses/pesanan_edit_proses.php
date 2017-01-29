<?php
	require "../../proses/connection.php";
	$id = $_POST['id'];
	$id_meja = $_POST['id_meja'];
			
	$strQuery = "UPDATE pesanan_detail set status = 'Selesai' WHERE id_detail_pesanan = $id";
	$query = mysqli_query($connection, $strQuery);
	if(!$query){
	    echo "error";
	} else {
		$strQuery = "UPDATE meja SET status = 'Siap Saji' WHERE id_meja = $id_meja";
		$query = mysqli_query($connection, $strQuery);
		if(!$query){
	    	echo "error";
		}
	}
	
	mysqli_close($connection);
?>
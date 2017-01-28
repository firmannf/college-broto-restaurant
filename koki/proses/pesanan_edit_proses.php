<?php
	require "../../proses/connection.php";
	$id = $_POST['id'];
			
	$strQuery = "UPDATE pesanan_detail set status = 'Selesai' WHERE id_detail_pesanan = $id";
	$query = mysqli_query($connection, $strQuery);
	if(!$query){
	    echo "error";
	} 
	
	mysqli_close($connection);
?>
<?php
	require "../../proses/connection.php";
	$id = $_POST['id'];
			
	$strQuery = "DELETE FROM pesanan_detail WHERE id_detail_pesanan = $id";
	$query = mysqli_query($connection, $strQuery);
	if(!$query){
	    echo "error";
	} 
	
	mysqli_close($connection);
?>
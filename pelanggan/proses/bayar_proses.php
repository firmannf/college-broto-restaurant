<?php
	require "../../proses/connection.php";
	$id = $_POST['id'];
			
	$strQuery = "UPDATE meja SET status = 'Bayar' WHERE id_meja = $id";
	$query = mysqli_query($connection, $strQuery);
	if(!$query){
	    echo "error";
	} 
	
	mysqli_close($connection);
?>
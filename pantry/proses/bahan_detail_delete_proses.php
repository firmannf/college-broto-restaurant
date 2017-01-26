<?php
	require "../../proses/connection.php";
	$id = $_POST['id'];
			
	$strQuery = "DELETE FROM bahanbaku_detail WHERE id_detail_bahanbaku = $id";
	$query = mysqli_query($connection, $strQuery);
	if(!$query){
	    echo "error";
	} 
	
	mysqli_close($connection);
?>
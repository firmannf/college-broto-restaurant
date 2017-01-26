<?php
	require "../../proses/connection.php";
	$id = $_POST['id'];
			
	$strQuery = "DELETE FROM bahanbaku WHERE id_bahanbaku = $id";
	$query = mysqli_query($connection, $strQuery);
	if(!$query){
	    echo "error";
	} 
	
	mysqli_close($connection);
?>
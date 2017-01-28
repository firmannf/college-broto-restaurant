<?php
	require "../../proses/connection.php";
	$id = $_POST['id'];
			
	$strQuery = "DELETE FROM menu_detail WHERE id_detail_menu = $id";
	$query = mysqli_query($connection, $strQuery);
	if(!$query){
	    echo "error";
	} 
	
	mysqli_close($connection);
?>
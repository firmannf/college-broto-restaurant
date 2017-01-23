<?php
	require "../../proses/connection.php";
	$nik = $_POST['nik'];
			
	$strQuery = "DELETE FROM pegawai WHERE nik = $nik";
	$query = mysqli_query($connection, $strQuery);
	if(!$query){
	    echo "error";
	} 
	
	mysqli_close($connection);
?>
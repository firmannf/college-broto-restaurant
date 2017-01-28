<?php
	require "../../proses/connection.php";
	session_start();
	$id = $_POST['id'];
	$jumlah = $_POST['jumlah'];
			
	$strQuery = "INSERT INTO pesanan_detail VALUES(NULL, '$_SESSION[id_pesanan]', '$id', '$jumlah', 'Belum')";
	$query = mysqli_query($connection, $strQuery);

	if(!$query){
	    echo "error";
	}
	
	mysqli_close($connection);
?>
<?php
	require "../../proses/connection.php";
	session_start();
	$id = $_POST['id'];

	$strQuery = "UPDATE meja SET status = 'Terisi' WHERE id_meja = '$id'";
	$query = mysqli_query($connection, $strQuery);
	mysqli_close($connection);
?>
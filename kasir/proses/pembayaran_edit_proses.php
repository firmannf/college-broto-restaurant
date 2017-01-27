<?php
	require "../../proses/connection.php";

	$id = $_POST['id'];
	$total_bayar = $_POST['total_bayar'];
	$uang_bayar = $_POST['uang_bayar'];

	$strQuery = "UPDATE pesanan set total_bayar = '$total_bayar', uang_bayar = '$uang_bayar', status = 'Bayar' WHERE id_pesanan = '$id'";

	$query = mysqli_query($connection, $strQuery);
	if(!$query){
	    echo "<script type=text/javascript>document.location.href='../index.php?e=bad-request'</script>";
	}else {
	    echo "<script type=text/javascript>document.location.href='../index.php?m=success-edit-data'</script>";
    }

	mysqli_close($connection);
?>
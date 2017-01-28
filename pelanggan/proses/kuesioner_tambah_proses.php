<?php
	require "../../proses/connection.php";
	session_start();
	$pelayanan = $_POST['pelayanan'];
	$harga = $_POST['harga'];
	$makanan = $_POST['makanan'];
	$minuman = $_POST['minuman'];
	$review = $_POST['review'];
			
	$strQuery = "INSERT INTO kuesioner VALUES(NULL, '$_SESSION[id_pesanan]', '$pelayanan', '$harga', '$makanan', '$minuman', '$review')";
	$query = mysqli_query($connection, $strQuery);
	if(!$query){
	    echo "<script type=text/javascript>document.location.href='../review.php?e=bad-request'</script>";
	}else {
	    echo "<script type=text/javascript>document.location.href='../menu.php?m=success-add-data'</script>";
    }

	mysqli_close($connection);
?>
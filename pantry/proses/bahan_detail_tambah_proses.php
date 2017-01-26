<?php
	require "../../proses/connection.php";
	session_start();
	
	$id_bahanbaku = $_POST['id'];
	$tgl_masuk = date("Y-m-d");
	$tgl_kadaluarsa = $_POST['tgl_kadaluarsa'];
	$qty = $_POST['qty'];

	$strQuery = "INSERT INTO bahanbaku_detail(id_bahanbaku, tgl_masuk, tgl_kadaluarsa, qty) 
					VALUES('$id_bahanbaku','$tgl_masuk', '$tgl_kadaluarsa', '$qty')";
	$query = mysqli_query($connection, $strQuery);
	if(!$query){
	    echo "<script type=text/javascript>document.location.href='../bahan_detail_tambah.php?id=$id_bahanbaku&e=bad-request'</script>";
	}else {
	    echo "<script type=text/javascript>document.location.href='../bahan_detail_list.php?id=$id_bahanbaku&m=success-add-data'</script>";
    }

	mysqli_close($connection);
?>
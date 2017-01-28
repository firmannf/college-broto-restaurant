<?php
	require "../../proses/connection.php";

	$id_bahanbaku = $_POST['id'];
	$stok = $_POST['stok'];
	$satuan = $_POST['satuan'];
	date_default_timezone_set("Asia/Jakarta");
	$tgl_masuk = date("Y-m-d");
	$tgl_kadaluarsa = $_POST['tgl_kadaluarsa'];

	$strQuery = "UPDATE bahanbaku set stok = '$stok', satuan = '$satuan', tgl_masuk = '$tgl_masuk', tgl_kadaluarsa = '$tgl_kadaluarsa' 
	WHERE id_bahanbaku = '$id_bahanbaku'";
	
	$query = mysqli_query($connection, $strQuery);
	if(!$query){
	    echo "<script type=text/javascript>document.location.href='../bahan_tambah_restock.php?e=bad-request'</script>";
	}else {
	    echo "<script type=text/javascript>document.location.href='../bahan_list.php?m=success-edit-data'</script>";
    }

	mysqli_close($connection);
?>
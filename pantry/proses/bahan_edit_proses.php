<?php
	require "../../proses/connection.php";

	$id_bahanbaku = $_POST['id'];
	$nama_bahanbaku = $_POST['nama_bahanbaku'];
	$stok = $_POST['stok'];
	$satuan = $_POST['satuan'];
	$tgl_kadaluarsa = $_POST['tgl_kadaluarsa'];

	$strQuery = "UPDATE bahanbaku set nama_bahanbaku = '$nama_bahanbaku', stok = '$stok', satuan = '$satuan', tgl_kadaluarsa = '$tgl_kadaluarsa' 
	WHERE id_bahanbaku = '$id_bahanbaku'";
	
	$query = mysqli_query($connection, $strQuery);
	if(!$query){
	    echo "<script type=text/javascript>document.location.href='../bahan_edit.php?e=bad-request'</script>";
	}else {
	    echo "<script type=text/javascript>document.location.href='../bahan_list.php?m=success-edit-data'</script>";
    }

	mysqli_close($connection);
?>
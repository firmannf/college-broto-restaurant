<?php
	require "../../proses/connection.php";

	$id_bahanbaku = $_POST['id'];
	$nama_bahanbaku = $_POST['nama_bahanbaku'];
	$satuan = $_POST['satuan'];

	$strQuery = "UPDATE bahanbaku set nama_bahanbaku = '$nama_bahanbaku', satuan = '$satuan' WHERE id_bahanbaku = '$id_bahanbaku'";
	
	$query = mysqli_query($connection, $strQuery);
	if(!$query){
	    echo "<script type=text/javascript>document.location.href='../bahan_edit.php?e=bad-request'</script>";
	}else {
	    echo "<script type=text/javascript>document.location.href='../bahan_list.php?m=success-edit-data'</script>";
    }

	mysqli_close($connection);
?>
<?php
	require "../../proses/connection.php";

	$id_bahanbaku = $_POST['id'];
	$id_detail_bahanbaku = $_POST['id2'];
	$tgl_kadaluarsa = $_POST['tgl_kadaluarsa'];
	$qty = $_POST['qty'];

	$strQuery = "UPDATE bahanbaku_detail set tgl_kadaluarsa = '$tgl_kadaluarsa', qty = '$qty' WHERE id_detail_bahanbaku = '$id_detail_bahanbaku'";
	
	$query = mysqli_query($connection, $strQuery);
	if(!$query){
	    echo "<script type=text/javascript>document.location.href='../bahan_detail_edit.php?id=$id_bahanbaku&id2=$id_detail_bahanbaku&e=bad-request'</script>";
	}else {
	    echo "<script type=text/javascript>document.location.href='../bahan_detail_list.php?id=$id_bahanbaku&m=success-edit-data'</script>";
    }

	mysqli_close($connection);
?>
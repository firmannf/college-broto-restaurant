<?php
	require "../../proses/connection.php";
	session_start();
	
	$nama_bahanbaku = $_POST['nama_bahanbaku'];
	$satuan = $_POST['satuan'];
			
	$strQuery = "INSERT INTO bahanbaku(nik, nama_bahanbaku, satuan) VALUES('$_SESSION[nik]','$nama_bahanbaku', '$satuan')";
	$query = mysqli_query($connection, $strQuery);
	if(!$query){
	    echo "<script type=text/javascript>document.location.href='../bahan_tambah.php?e=bad-request'</script>";
	}else {
	    echo "<script type=text/javascript>document.location.href='../bahan_list.php?m=success-add-data'</script>";
    }

	mysqli_close($connection);
?>
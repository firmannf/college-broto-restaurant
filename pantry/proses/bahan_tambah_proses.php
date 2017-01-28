<?php
	require "../../proses/connection.php";
	session_start();
	
	$nama_bahanbaku = $_POST['nama_bahanbaku'];
	$stok = $_POST['stok'];
	$satuan = $_POST['satuan'];
	date_default_timezone_set("Asia/Jakarta");
	$tgl_masuk = date("Y-m-d");
	$tgl_kadaluarsa = $_POST['tgl_kadaluarsa'];
			
	$strQuery = "INSERT INTO bahanbaku(nik, nama_bahanbaku, stok, satuan, tgl_masuk, tgl_kadaluarsa)
					VALUES('$_SESSION[nik]','$nama_bahanbaku', '$stok', '$satuan', '$tgl_masuk', '$tgl_kadaluarsa')";
	$query = mysqli_query($connection, $strQuery);
	if(!$query){
	    echo "<script type=text/javascript>document.location.href='../bahan_tambah.php?e=bad-request'</script>";
	}else {
	    echo "<script type=text/javascript>document.location.href='../bahan_list.php?m=success-add-data'</script>";
    }

	mysqli_close($connection);
?>
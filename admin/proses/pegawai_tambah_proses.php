<?php
	require "../../proses/connection.php";

	$nik = $_POST['nik'];
	$nama = $_POST['nama'];
	$pekerjaan = $_POST['pekerjaan'];
	$password = $_POST['password'];
    $encryptedPassword = md5($password);
			
	$strQuery = "INSERT INTO pegawai VALUES('$nik', '$nama', '$pekerjaan', '$encryptedPassword')";
	$query = mysqli_query($connection, $strQuery);
	if(!$query){
	    echo "<script type=text/javascript>document.location.href='../pegawai_tambah.php?e=bad-request'</script>";
	}else {
	    echo "<script type=text/javascript>document.location.href='../pegawai_list.php?m=success-add-data'</script>";
    }

	mysqli_close($connection);
?>
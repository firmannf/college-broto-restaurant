<?php
	require "../../proses/connection.php";

	$nik = $_POST['nik'];
	$nama_pegawai = $_POST['nama_pegawai'];
	$password = $_POST['password'];
    $encryptedPassword = md5($password);
	$pekerjaan = $_POST['pekerjaan'];
			
	$strQuery = "INSERT INTO pegawai VALUES('$nik', '$nama_pegawai', '$encryptedPassword', '$pekerjaan')";
	$query = mysqli_query($connection, $strQuery);
	if(!$query){
	    echo "<script type=text/javascript>document.location.href='../pegawai_tambah.php?e=bad-request'</script>";
	}else {
	    echo "<script type=text/javascript>document.location.href='../pegawai_list.php?m=success-add-data'</script>";
    }

	mysqli_close($connection);
?>
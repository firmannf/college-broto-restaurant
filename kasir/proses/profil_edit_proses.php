<?php
	require "../../proses/connection.php";
	session_start();
	$nik = $_POST['nik'];
	$nama_pegawai = $_POST['nama_pegawai'];
	$password = $_POST['password'];

	if(!empty($password)) {
		$encryptedPassword = md5($password);
		$strQuery = "UPDATE pegawai set nama_pegawai = '$nama_pegawai', password = '$encryptedPassword' WHERE nik = '$nik'";
	} else {
		$strQuery = "UPDATE pegawai set nama_pegawai = '$nama_pegawai' WHERE nik = '$nik'";
	}

	$query = mysqli_query($connection, $strQuery);
	if(!$query){
	    echo "<script type=text/javascript>document.location.href='../setting.php?e=bad-request'</script>";
	}else {
		$_SESSION['nama_pegawai'] = $nama_pegawai;
	    echo "<script type=text/javascript>document.location.href='../setting.php?m=success-edit-data'</script>";
    }

	mysqli_close($connection);
?>
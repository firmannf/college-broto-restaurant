<?php
	require "../../proses/connection.php";

	$nik = $_POST['nik'];
	$nama_pegawai = $_POST['nama_pegawai'];
	$password = $_POST['password'];
	$pekerjaan = $_POST['pekerjaan'];

	if(!empty($password)) {
		$encryptedPassword = md5($password);
		$strQuery = "UPDATE pegawai set nama_pegawai = '$nama_pegawai', password = '$encryptedPassword', pekerjaan = '$pekerjaan' WHERE nik = '$nik'";
	} else {
		$strQuery = "UPDATE pegawai set nama_pegawai = '$nama_pegawai', pekerjaan = '$pekerjaan' WHERE nik = '$nik'";
	}

	$query = mysqli_query($connection, $strQuery);
	if(!$query){
	    echo "<script type=text/javascript>document.location.href='../pegawai_edit.php?e=bad-request'</script>";
	}else {
	    echo "<script type=text/javascript>document.location.href='../pegawai_list.php?m=success-edit-data'</script>";
    }

	mysqli_close($connection);
?>
<?php
	require "../../proses/connection.php";

	$nik = $_POST['nik'];
	$nama = $_POST['nama'];
	$pekerjaan = $_POST['pekerjaan'];
	$password = $_POST['password'];

	if(!empty($password)) {
		$encryptedPassword = md5($password);
		$strQuery = "UPDATE pegawai set nama = '$nama', pekerjaan = '$pekerjaan', password = '$encryptedPassword' WHERE nik = '$nik'";
	} else {
		$strQuery = "UPDATE pegawai set nama = '$nama', pekerjaan = '$pekerjaan' WHERE nik = '$nik'";
	}

	$query = mysqli_query($connection, $strQuery);
	if(!$query){
	    echo "<script type=text/javascript>document.location.href='../pegawai_edit.php?e=bad-request'</script>";
	}else {
	    echo "<script type=text/javascript>document.location.href='../pegawai_list.php?m=success-edit-data'</script>";
    }

	mysqli_close($connection);
?>
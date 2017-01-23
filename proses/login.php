<?php
	require_once "connection.php";
	session_start();
	$nik = $_POST['nik'];
	$password = $_POST['password'];
	$encryptedPassword = md5($password);
	
	$strQuery = "SELECT * FROM pegawai WHERE nik = '$nik' AND password='$encryptedPassword'";
	$query = mysqli_query($connection, $strQuery);
	if($query){
		$thereisAnEmployee = mysqli_num_rows($query);
		if($thereisAnEmployee == 0){
			echo "<script type=text/javascript>document.location.href='../index.php?e=invalid-login-credential'</script>";
		}else{
			$result = mysqli_fetch_array($query, MYSQLI_ASSOC);
            $_SESSION['nik'] = $result['nik'];
			$_SESSION['nama'] = $result['nama'];
			$_SESSION['pekerjaan'] = $result['pekerjaan'];
			if($result['pekerjaan'] === "Admin") {
				echo "<script type=text/javascript>document.location.href='../admin/index.php'</script>";
            } else if($result['pekerjaan'] === "Customer Service") {
				echo "<script type=text/javascript>document.location.href='../CS/index.php'</script>";
            } else if($result['pekerjaan'] === "Kasir") {
				echo "<script type=text/javascript>document.location.href='../kasir/index.php'</script>";
            } else if($result['pekerjaan'] === "Koki") {
				echo "<script type=text/javascript>document.location.href='../koki/index.php'</script>";
            } else if($result['pekerjaan'] === "Pantry") {
				echo "<script type=text/javascript>document.location.href='../pantry/index.php'</script>";
            } else if($result['pekerjaan'] === "Pelayan") {
				echo "<script type=text/javascript>document.location.href='../pelayan/index.php'</script>";
            } else {
	            session_destroy();
		        echo "<script type=text/javascript>document.location.href='../index.php?e=bad-request'</script>";
            }
		}
	}else {
		echo "<script type=text/javascript>document.location.href='../index.php?e=bad-request'</script>";
	}
	
    mysqli_close($connection);
?>
<?php
	require "../../proses/connection.php";
    session_start();
    $id = $_POST['id'];
    $nama_pelanggan = $_POST['nama'];

    $strQuery = "UPDATE meja SET status = 'Terisi' WHERE id_meja = '$id'";

	$query = mysqli_query($connection, $strQuery);
	if(!$query){
	    echo "<script type=text/javascript>document.location.href='../index.php?id=$id&e=bad-request'</script>";
	}else {
        $_SESSION['nama_pelanggan'] = $nama_pelanggan;
	    echo "<script type=text/javascript>document.location.href='../menu.php?m=welcome'</script>";
    }
?>
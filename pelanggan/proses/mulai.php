<?php
	require "../../proses/connection.php";
    session_start();
    $id = $_POST['id'];
    $nama_pelanggan = $_POST['nama'];

    $strQuery = "UPDATE meja SET status = 'Terisi' WHERE id_meja = '$id'";
	$query = mysqli_query($connection, $strQuery);
    date_default_timezone_set("Asia/Jakarta");
    $tgl = date("Y-m-d h:i:s");
    $strQuery = "INSERT INTO pesanan(id_meja, nama_pelanggan, tgl_order) 
                    VALUE('$id', '$nama_pelanggan', '$tgl')";
	$query = mysqli_query($connection, $strQuery);
	if(!$query){
	    echo "<script type=text/javascript>document.location.href='../index.php?id=$id&e=bad-request'</script>";
	}else {
        $_SESSION['nama_pelanggan'] = $nama_pelanggan;
        $_SESSION['id_meja'] = $id;
        $_SESSION['id_pesanan'] = mysqli_insert_id($connection);
	    echo "<script type=text/javascript>document.location.href='../menu.php?m=welcome'</script>";
    }
?>
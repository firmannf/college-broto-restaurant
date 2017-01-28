<?php
	require "../../proses/connection.php";

	$id_menu = $_POST['id'];
	$harga = $_POST['harga'];

	$strQuery = "UPDATE menu set harga = '$harga', status = 'Ya' WHERE id_menu = '$id_menu'";

	$query = mysqli_query($connection, $strQuery);
	if(!$query){
	    echo "<script type=text/javascript>document.location.href='../menu_list.php?e=bad-request'</script>";
	}else {
	    echo "<script type=text/javascript>document.location.href='../menu_list.php?m=success-edit-data'</script>";
    }

	mysqli_close($connection);
?>
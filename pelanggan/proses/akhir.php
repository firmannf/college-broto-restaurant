<?php
	require "../../proses/connection.php";
    session_start();
	$id = $_SESSION['id_meja'];
    
	$strQuery = "UPDATE meja SET status = 'Kosong' WHERE id_meja = '$_SESSION[id_meja]'";
	$query = mysqli_query($connection, $strQuery);
	if(!$query){
	    echo "<script type=text/javascript>document.location.href='../index.php?id=$id&e=bad-request'</script>";
	}else {
	    echo "<script type=text/javascript>document.location.href='../index.php?id=$id&m=good-bye'</script>";
        session_destroy();
    }
?>
<?php
	require "../../proses/connection.php";

	$nama_menu = $_POST['nama'];
	$kategori = $_POST['kategori'];
	$estimasi = $_POST['estimasi'];
	$harga = $_POST['harga'];
	$bahanbaku = json_decode($_POST['bahanbaku'], true);

	$target_dir = "../../uploads/menu/";
	$foto = str_replace(" ","", $nama_menu);
	$temp = explode(".", $_FILES["foto"]["name"]);
	date_default_timezone_set("Asia/Jakarta");
	$foto = strtolower($foto . date('YmdHis') . "." . end($temp));
	$target_file = $target_dir . basename($foto);
	if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
		$strQuery = "INSERT INTO menu VALUES(NULL, '$nama_menu', '$foto', '$kategori', '$estimasi', '$harga', 'Tidak')";
		$query = mysqli_query($connection, $strQuery);
		if(!$query){
			echo "<script type=text/javascript>document.location.href='../menu_tambah.php?e=bad-request'</script>";
		}else {
			$id_menu = mysqli_insert_id($connection);
			foreach((array) $bahanbaku as $key => $value) {
				$strQuery = "INSERT INTO menu_detail VALUES(NULL, '$id_menu', '$value[id_bahanbaku]', '$value[qty]')";
				$query = mysqli_query($connection, $strQuery);
			}
			echo "<script type=text/javascript>document.location.href='../menu_list.php?m=success-add-data'</script>";
		}
	} else {
	    echo "<script type=text/javascript>document.location.href='../menu_tambah.php?e=bad-request'</script>";
	}

	mysqli_close($connection);
?>
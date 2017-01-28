<?php
	require "../../proses/connection.php";

	$id_menu = $_POST['id'];
	$nama_menu = $_POST['nama'];
	$kategori = $_POST['kategori'];
	$estimasi = $_POST['estimasi'];
	$harga = $_POST['harga'];
	$bahanbaku = json_decode($_POST['bahanbaku'], true);

	if($_FILES['foto']['size'] == 0) {
		$strQuery = "UPDATE menu SET nama_menu = '$nama_menu', kategori = '$kategori', estimasi_penyajian = '$estimasi', harga = '$harga'
						WHERE id_menu = '$id_menu'";
		$query = mysqli_query($connection, $strQuery);
		if(!$query){
			echo "<script type=text/javascript>document.location.href='../menu_edit.php?e=bad-request'</script>";
		}else {
			if(!empty($bahanbaku)){
				foreach((array) $bahanbaku as $key => $value) {
					$strQuery = "INSERT INTO menu_detail VALUES(NULL, '$id_menu', '$value[id_bahanbaku]', '$value[qty]')";
					$query = mysqli_query($connection, $strQuery);
				}
			}
			echo "<script type=text/javascript>document.location.href='../menu_list.php?m=success-add-data'</script>";
		}
	} else {
		$target_dir = "../../uploads/menu/";
		$foto = str_replace(" ","", $nama_menu);
		$temp = explode(".", $_FILES["foto"]["name"]);
		$foto = strtolower($foto . date('YmdHis') . "." . end($temp));
		$target_file = $target_dir . basename($foto);
		if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
			$strQuery = "UPDATE menu SET nama_menu = '$nama_menu', foto = '$foto', kategori = '$kategori', estimasi_penyajian = '$estimasi', harga = '$harga'
							WHERE id_menu = '$id_menu'";$query = mysqli_query($connection, $strQuery);
			if(!$query){
				echo "<script type=text/javascript>document.location.href='../menu_edit.php?e=bad-request'</script>";
			}else {
				if(!empty($bahanbaku)){
					foreach((array) $bahanbaku as $key => $value) {
						$strQuery = "INSERT INTO menu_detail VALUES(NULL, '$id_menu', '$value[id_bahanbaku]', '$value[qty]')";
						$query = mysqli_query($connection, $strQuery);
					}
				}
				echo "<script type=text/javascript>document.location.href='../menu_list.php?m=success-edit-data'</script>";
			}
		} else {
			echo "<script type=text/javascript>document.location.href='../menu_edit.php?e=bad-request'</script>";
		}
	}

	mysqli_close($connection);
?>
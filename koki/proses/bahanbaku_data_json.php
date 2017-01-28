<?php
	require "../../proses/connection.php";
			
	$strQuery = "SELECT id_bahanbaku, nama_bahanbaku FROM bahanbaku ORDER BY nama_bahanbaku ASC";
	$query = mysqli_query($connection, $strQuery);
    $data = array();
    foreach ($query as $row) {
        $data[] = $row;
    }

	mysqli_close($connection);
    echo json_encode($data);
?>
<?php
    session_start();
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $_SESSION['nama_pelanggan'] = $nama_pelanggan;

    echo "<script type=text/javascript>document.location.href='../bahan_list.php?m=success-edit-data'</script>";
?>
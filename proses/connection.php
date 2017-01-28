<?php
    // Local
    // $host = "localhost";
    // $user = "root";
    // $pass = "";
    // $database = "db_resto_broto";

    // Azure
    $host = "ap-cdbr-azure-southeast-b.cloudapp.net";
    $user = "bd16c26ce23a01";
    $pass = "8fbce2f7";
    $database = "db_resto_broto";
    
    $connection = mysqli_connect($host, $user, $pass, $database);
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>
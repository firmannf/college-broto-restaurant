<?php
	require "../../proses/connection.php";
    session_start();
			
	$strQuery = "SELECT id_meja, nama_meja, status FROM meja";
	$query = mysqli_query($connection, $strQuery);
    while($result = mysqli_fetch_assoc($query)){
?>
<div class="col-md-6 col-lg-6 col-xs-6">
    <a style="cursor: pointer;" onClick="actionPelayan('<?php echo $result['status'];?>', <?php echo $result['id_meja'];?>)">
        <div class="card text-center">
            <div class="card-block">
                <h4 class="card-title">
                    <?php
                if($result['status'] === "Bayar") {
              ?>
                    <i class="fa fa-money fa-3x" aria-hidden="true" style="color: #FF9800;"></i>
                    <?php
                } else if ($result['status'] === "Siap Saji") {
              ?>
                    <i class="fa fa-cutlery fa-3x" aria-hidden="true" style="color: #2196F3;"></i>
                    <?php
                } else if ($result['status'] === "Kosong") {
              ?>
                    <i class="fa fa-check fa-3x" aria-hidden="true" style="color: #4caf50;"></i>
                    <?php
                } else if ($result['status'] === "Terisi") {
              ?>
                    <i class="fa fa-users fa-3x" aria-hidden="true"></i>
                    <?php
                }
              ?>
                </h4>
                <p class="card-text">
                    <h6 style="color: #212121;"><b><?php echo "$result[nama_meja]";?></b>
                        <h6>
                </p>
            </div>
        </div>
    </a>
</div>
<?php  
    }
	mysqli_close($connection);
?>
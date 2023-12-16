<?php
	include"inc/config.php"; 
	include"layout/header.php";	
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="col-md-9">
        <div class="row">
            <?php
			$q = mysqli_query($konek, "Select * from info_pembayaran limit 1") or die (mysqli_error());
			$data = mysqli_fetch_object($q);
		?>
            <pre><?php echo $data->info; ?></pre>
        </div>
    </div>
</body>

</html>

<?php
	include "layout/footer.php";
?>
<?php 
	include"inc/config.php";
	include"layout/header.php";
	
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

</head>

<body>
    <font color="black">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-13">
                    <h2 class="animate__animated animate__lightSpeedInLeft animate__slower" align="center"> <b>Favorite
                            Menu</b> </h2>

                    <?php 
					$k = mysqli_query($konek, "SELECT * FROM produk ORDER BY id ASC limit 3"); 
					while($data = mysqli_fetch_array($k)){
				?>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <a href="<?php echo $url; ?>menu.php?id=<?php echo $data['id'] ?>">
                                    <img src="<?php echo $url; ?>uploads/<?php echo $data['gambar'] ?>" width="100%">
                                    <h4><?php echo $data['nama'] ?></h4>
                                </a>
                                <p><?php echo $data['deskripsi'] ?></p>
                                <p style="font-size:18px">Harga : <strong> Rp
                                        <?php echo number_format($data['harga'], 0, ',', '.') ?></strong> </p>
                                <p>
                                    <a href="<?php echo $url; ?>menu.php?id=<?php echo $data['id'] ?>"
                                        class="btn btn-success btn-sm" href="#" role="button">Lihat Detail</a>
                                    <a href="<?php echo $url; ?>keranjang.php?act=beli&&produk_id=<?php echo $data['id'] ?>"
                                        class="btn btn-warning btn-sm" href="#" role="button">Pesan</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                </div>
            </div>
            <div class="row">
                <div class="col-md-13">
                    <h2 class="animate__animated animate__lightSpeedInLeft animate__slower" align="center"> <b>Menu
                            Terbaru</b> </h2>
                    <?php 
					$k = mysqli_query($konek, "SELECT * FROM produk ORDER BY id DESC limit 3"); 
					while($data = mysqli_fetch_array($k)){
				?>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <a href="<?php echo $url; ?>menu.php?id=<?php echo $data['id'] ?>">
                                    <img src="<?php echo $url; ?>uploads/<?php echo $data['gambar'] ?>" width="100%">
                                    <h4><?php echo $data['nama'] ?></h4>
                                </a>
                                <p style="font-size:18px">Harga : <strong>Rp
                                        <?php echo number_format($data['harga'], 0, ',', '.') ?></strong> </p>
                                <p>
                                    <a href="<?php echo $url; ?>menu.php?id=<?php echo $data['id'] ?>"
                                        class="btn btn-success btn-sm" href="#" role="button">Lihat Detail</a>
                                    <a href="<?php echo $url; ?>keranjang.php?act=beli&&produk_id=<?php echo $data['id'] ?>"
                                        class="btn btn-warning btn-sm" href="#" role="button">Pesan</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                </div>
            </div>
        </div>
</body>

</html>


<?php include"layout/footer.php"; ?>
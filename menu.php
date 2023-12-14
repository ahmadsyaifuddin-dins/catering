<?php 
	include"inc/config.php";
	include"layout/header.php";
	
	
?>
<?php	if(!empty($_GET['id'])){ ?>
		<?php
			extract($_GET); 
			$k = mysqli_query($konek, "SELECT * FROM produk WHERE id='$id'"); 
			$data = mysqli_fetch_array($k);
		?>
		<div class="col-md-9">
		<font color="black">
			<div class="row">
			<div class="col-md-12">
			<h3>Detail : <?php echo $data['nama'] ?></h3>
				<br/>
				<div class="col-md-12 content-menu" style="margin-top:-20px;">
				
				<?php $kat = mysqli_fetch_array(mysqli_query($konek, "SELECT * FROM kategori_produk WHERE id='$data[kategori_produk_id]'"));  ?>
					<middle>Kategori :<a href="<?php echo $url; ?>menu.php?kategori=<?php echo $kat['id'] ?>"><?php echo $kat['nama'] ?></a></middle>
					<a href="<?php echo $url; ?>menu.php?id=<?php echo $data['id'] ?>">
						
						<img src="<?php echo $url; ?>uploads/<?php echo $data['gambar'] ?>" width="100%"> 
					</a>
					<br><br>
					<p><?php echo $data['deskripsi'] ?></p>
					<p style="font-size:18px">Harga : Rp <?php echo number_format($data['harga'], 0, ',', '.') ?></p>
					<p>
						<a href="<?php echo $url; ?>keranjang.php?act=beli&&produk_id=<?php echo $data['id'] ?>" class="btn btn-warning" href="#" role="button">Pesan</a>
					</p>
				</div>   
				
					
				
			</div>
			</div> 
		</div>
		
<?php }elseif(!empty($_GET['kategori'])){ ?>	

		<?php
			extract($_GET); 
			$kat = mysqli_fetch_array(mysqli_query($konek, "SELECT * FROM kategori_produk WHERE id='$kategori'")); 
		?>
		<div class="col-md-9">
			<div class="row">
			<div class="col-md-12">
			<hr>
			<font color="black">
			<h3>Kategori : <?php echo $kat['nama'] ?></h3>
				<?php 
					$k = mysqli_query($konek, "SELECT * FROM produk WHERE kategori_produk_id='$kategori'");
					while($data = mysqli_fetch_array($k)){
				?>
				<div class="col-md-4">
					<div class="panel panel-default">
						<div class="panel-body">
							<a href="<?php echo $url; ?>menu.php?id=<?php echo $data['id'] ?>">
								<img src="<?php echo $url; ?>uploads/<?php echo $data['gambar'] ?>" width="100%">
								<h4><?php echo $data['nama'] ?></h4>
							</a>
							<p style="font-size:18px">Harga : Rp <?php echo number_format($data['harga'], 0, ',', '.') ?></p>
							<p>
								<a href="<?php echo $url; ?>menu.php?id=<?php echo $data['id'] ?>" class="btn btn-success btn-sm" href="#" role="button">Lihat Detail</a>
								<a href="<?php echo $url; ?>keranjang.php?act=beli&&produk_id=<?php echo $data['id'] ?>" class="btn btn-warning btn-sm" href="#" role="button">Pesan</a>
							</p>
						</div>
					</div>
				</div>  
				<?php } ?>
				
			</div>
			</div>
		</div>

<?php }else{ ?>	
			
		<div class="col-md-9">
			<div class="row">
			<div class="col-md-14">
			
			<h2 align="center"><font color="black"> <b>Daftar Semua Menu</b> </h2>
				<?php 
					$k = mysqli_query($konek, "SELECT * FROM produk");
					while($data = mysqli_fetch_array($k)){
				?>
				<div class="col-sm-4">
					<div class="panel panel-default">
						<div class="panel-body">
							<a href="<?php echo $url; ?>menu.php?id=<?php echo $data['id'] ?>">
								<img src="<?php echo $url; ?>uploads/<?php echo $data['gambar'] ?>" width="100%">
								<h4><?php echo $data['nama'] ?></h4>
							</a>
							<p style="font-size:18px">Harga : Rp <?php echo number_format($data['harga'], 0, ',', '.') ?></p>
							<p>
								<a href="<?php echo $url; ?>menu.php?id=<?php echo $data['id'] ?>" class="btn btn-success btn-sm" href="#" role="button">Lihat Detail</a>
								<a href="<?php echo $url; ?>keranjang.php?act=beli&&produk_id=<?php echo $data['id'] ?>" class="btn btn-warning btn-sm" href="#" role="button">Pesan</a>
							</p>
						</div>
					</div>
				</div>  
				
				<?php } ?>
			</div>
			</div>
		</div>

<?php } ?>	
<?php include"layout/footer.php"; ?>
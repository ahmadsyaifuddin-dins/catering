<?php 
	include"inc/config.php";
	include"layout/header.php";	
?> 
		 
		<div class="col-md-9">
			<div class="row">
			<div class="col-md-12">
			<?php 
				if(!empty($_POST)){
				extract($_POST); 
				$qs = mysqli_query($konek, "INSERT INTO kontak VALUES(NULL,'$nama','$email','$subjek','$pesan')");
					if($qs){  
			?>
			<font color="black">
			<div class="alert alert-success">Terimakasih atas masukannya</div>
				<?php }else{ ?>
			<div class="alert alert-danger">Terjadi kesalahan dalam pengisian form. Data belum terkirim.</div>
				<?php } } ?>
			<?php
				$q = mysqli_query($konek, "select*from kontak");
				$j = mysqli_num_rows($q);
			?>
			<h4>Daftar Kontak Masuk (<?php echo ($j>0)?$j:0; ?>)</h4>
			<table class="table table-striped table-hove"> 
				<thead style="color:black;"> 
					<tr> 
						<th>#</th> 
						<th>Nama</th> 
						<th>Email</th> 
						<th>Subjek</th> 
						<th>Pesan</th> 
						<th>*</th> 
					</tr> 
				</thead> 
				<tbody> 
					

				
				
			<?php while($data=mysqli_fetch_object($q)){ ?> 
					<tr> 
						<th scope="row" style="color:black;"><?php echo $no++; ?></th> 
						<td style="color:black;"><?php echo $data->nama ?></td> 
						<td style="color:black;"><?php echo $data->email ?></td> 
						<td style="color:black;"><?php echo $data->subjek ?></td> 
						<td style="color:black;"><?php echo $data->pesan ?></td> 
					</tr>
			<?php } ?>
				</tbody> 
			</table>   
				 
					
				
			</div>
			</div> 
		</div> 	
<?php include"layout/footer.php"; ?>

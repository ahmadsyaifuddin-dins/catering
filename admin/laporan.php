<?php 
	ob_start();
	include"../inc/config.php"; 
	include"inc/header.php";
?>


<div class="container">
	<!-- icons link cdn -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
	<h4>Laporan Penjualan</h4>
				<a href="export.php" class="btn btn-success"> <i class="fa-solid fa-file-excel"></i> Export ke Excel</a>
	<div class="col-md-12">
		<hr/>
	</div>

	<div class="row">
		<table class="table table-bordered table-striped" border="1">
			<tr>
				<th>#</th>
				<th>Nama</th>
				<th>Tanggal Tempo</th>
				<th>Tanggal Pesan</th>
				<th>Total</th>
				<th>Ongkir</th>
				<th>Status</th>
			</tr>
			<tbody>
				<?php
					$totalSemua = 0;
					$totalOngkir = 0;
					$no = 0;
					$q = mysqli_query($konek, "Select pesanan.* from pesanan order by id desc") or die (mysqli_error());
					while ($data = mysqli_fetch_object($q)) {
						$totalHarga = 0;
						$no++;
						$q2 = mysqli_query($konek, "Select detail_pesanan.*, produk.harga from detail_pesanan INNER JOIN produk ON detail_pesanan.produk_id = produk.id where pesanan_id = '$data->id'") or die (mysqli_error());
						while ($d = mysqli_fetch_object($q2)) {
							$totalHarga += $d->harga * $d->qty;
						}
						$totalSemua += $totalHarga;
						$totalOngkir += $data->ongkir;
						?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $data->nama; ?></td>
							<td><?php echo $data->tanggal_digunakan; ?></td>
							<td><?php echo $data->tanggal_pesan; ?></td>
							<td><?php echo "Rp. " .number_format($totalHarga, 0, ",", "."); ?></td>
							<td><?php echo "Rp. " .number_format($data->ongkir, 0, ",", "."); ?></td>
							<td><?php echo $data->status; ?></td>
						</tr>
						<?php
					}
				?>
				<tr>
					<td colspan="4" align="right">
						<font size="3">
							<b>TOTAL</b>
						</font>
					</td>
					<td>
						<font size="3"><?php echo "Rp. ". number_format($totalSemua, 0, ",", "."); ?></font>
					</td>
					<td>
						<font size="3">
							<?php echo "Rp. ". number_format($totalOngkir, 0, ",", "."); ?>
						</font>
					</td>
					<td></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

<?php
// header("Content-type: application/vnd-ms-excel");
// header("Content-Disposition: attachment; filename=Data Mahasiswa.xls");
// include "data.php";
?>

<?php


	include"inc/footer.php";
?>
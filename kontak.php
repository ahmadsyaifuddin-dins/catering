<?php
include "inc/config.php";
include "layout/header.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css" rel="stylesheet">

</head>

<body>
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-12">

                <?php
                if (!empty($_POST)) {
                    extract($_POST);

                    $q = mysqli_query($konek, "INSERT INTO kontak VALUES(NULL,'$nama','$email','$subjek','$pesan')");
                    if ($q) {
                ?>
                        <font color="black">
                            <!-- <div class="alert alert-success">Terimakasih atas masukannya</div> -->
                            <script type='text/javascript'>
                                setTimeout(function() {
                                    Swal.fire({
                                        title: "Pesan Terkirim!",
                                        text: "Terima kasih Atas Masukannya",
                                        icon: "success",
                                        timer: "3000",
                                        showConfirmButton: true
                                    });
                                }, 1);
                                window.setTimeout(function() {
                                    window.location.replace('kontak.php');
                                }, 3000);
                            </script>
                        <?php } else { ?>
                            <div class="alert alert-danger">Terjadi kesalahan dalam pengisian form. Data belum terkirim.</div>
                    <?php }
                } ?>
                    <h3>
                        <font class="text-color-heading">Kontak Kami </font>
                    </h3>
                    <br>
                    <div class="col-md-8 content-menu" style="margin-top:-20px;">

                        <form action="" method="post" enctype="multipart/form-data">
                            <font color="black">
                                <label>Nama</label><br>
                                <input type="text" class="form-control" name="nama" required><br>
                                <label>Email</label><br>
                                <input type="email" class="form-control" name="email" required><br>
                                <label>Subjek</label><br>
                                <input type="text" class="form-control" name="subjek" required><br>
                                <label>Pesan</label><br>
                                <textarea class="form-control" name="pesan" required></textarea><br>
                                <input type="submit" name="form-input" id="sweetAlert" value="Simpan" class="btn btn-success">
                        </form>

                    </div>



            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
</body>

</html>

<?php include "layout/footer.php"; ?>


<script>
    // 	$(document).ready(function () {
    // 		$("#sweetAlert").click(function (e) {
    // 			e.preventDefault();
    // 			Swal.fire({
    // 			title: "Terkirim!",
    // 			text: "Terima kasih Atas Masukannya",
    // 			icon: "success"
    // });
    // 		})
    // 	})

    // $(document).on('click','#sweetAlert', function() {
    // 	Swal.fire(
    // 		'Sukses',
    // 		'Terima Kasih Telah beri masukan',
    // 		'success'
    // 	)
    // })
</script>
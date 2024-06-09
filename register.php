<?php
include "inc/config.php";

if (!empty($_SESSION['iam_user'])) {
    redir("index.php");
}

include "layout/header.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css" rel="stylesheet">
    <title>Register</title>
</head>

<body>

    <div class="col-md-9">
        <div class="row">
            <div class="col-md-12">

                <?php
                if (!empty($_POST)) {
                    extract($_POST);

                    $login_time = date('l/d/M/Y-H:i:s:a'); // Format datetime standar untuk MySQL
                    $password = md5($password);
                    
                    $q = mysqli_query($konek, "INSERT INTO user (nama, email, password, alamat, jenis_kelamin, telephone, status, last_login) VALUES ('$nama', '$email', '$password', '$alamat', '$jenis_kelamin', '$telephone', 'user', '$login_time')");
                    if ($q) {
                ?>
                        <script type='text/javascript'>
                            setTimeout(function() {
                                Swal.fire({
                                    title: "Registrasi Berhasil!",
                                    text: "Selamat Berbelanja",
                                    icon: "success",
                                    footer: '<a href="login.php" class="btn btn-primary">Silahkan Login!</a>',
                                    showConfirmButton: false
                                });
                            }, 1);
                        </script>
                    <?php } else { ?>
                        <div class="alert alert-danger">Terjadi kesalahan dalam pengisian form. Silahkan Coba Lagi</div>
                <?php }
                } ?>
                <h3>
                    <font class="text-color-heading">Register User </font>
                </h3>
                <br>
                <font color="black">
                    <div class="col-md-7 content-menu" style="margin-top:-20px;">

                        <form action="" method="post" enctype="multipart/form-data">
                            <label>Nama</label><br>
                            <input type="text" class="form-control" name="nama" required><br>
                            <label>Email</label><br>
                            <input type="email" class="form-control" name="email" required><br>
                            <label>Password</label><br>
                            <input type="password" class="form-control" name="password" required><br>
                            <label>Alamat</label><br>
                            <input type="text" class="form-control" name="alamat" required><br>
                            <label for='jenis_kelamin'>Jenis Kelamin</label> <br>
                            <select class="form-control" id="jenis-kelamin" name="jenis_kelamin" required>
                                <option value="LAKI-LAKI">Laki-laki</option>
                                <option value="PEREMPUAN">Perempuan</option>
                                <br>
                            </select>
                            <br>
                            <label>Telephone</label><br>
                            <input type="text" class="form-control" name="telephone" required><br>
                        
                            <br>

                            <input type="hidden" name="login_time" value="<?php echo date('l/d/M/Y-H:i:s:a'); ?>">
                            <button type="submit" class="btn btn-success">Register</button>                        
                        
                        </form>

                    </div>
                    <div class="col-md-7 content-menu">
                        Sudah Punya Akun ? <a href="login.php">Login Sekarang !</a>
                    </div>

                </div>
            </div>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
</body>

</html>

<?php include "layout/footer.php"; ?>

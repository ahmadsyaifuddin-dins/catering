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
                    
                    // Cek duplikasi username dan email
                    $check_query = mysqli_query($konek, "SELECT * FROM user WHERE email='$email' OR username='$username'");
                    if (mysqli_num_rows($check_query) > 0) {
                        echo '<div class="alert alert-danger">Username atau Email sudah terdaftar. Silahkan gunakan yang lain.</div>';
                    } else {
                        $q = mysqli_query($konek, "INSERT INTO user (nama, email, username, password, alamat, jenis_kelamin, telephone, status, last_login) VALUES ('$nama', '$email', '$username', '$password', '$alamat', '$jenis_kelamin', '$telephone', 'user', '$login_time')");
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
                <?php
                        }
                    }
                }
                ?>
                <h3>
                    <font class="text-color-heading"><b>Register User</b> </font>
                </h3>
                <br>
                <font color="black">
                    <div class="col-md-7 content-menu" style="margin-top:-20px;">

                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" placeholder="Ahmad Syaifuddin" class="form-control" id="nama" name="nama" required autofocus="">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" placeholder="ahmad@gmail.com" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" placeholder="Contoh: Asai.ai / asai_123" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" placeholder="Jl. Kacapiring No. 3" class="form-control" id="alamat" name="alamat" required>
                            </div>
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="LAKI-LAKI">Laki-laki</option>
                                    <option value="PEREMPUAN">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="telephone">Telephone / No. WhatsApp Aktif</label>
                                <input type="tel" class="form-control" id="telephone" name="telephone" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required>
                            </div>
                            <input type="hidden" name="login_time" value="<?php echo date('l/d/M/Y-H:i:s:a'); ?>">
                            <button type="submit" class="btn btn-success">Register</button>
                        </form>

                    </div>
                    <div class="col-md-7 content-menu">
                        Sudah Punya Akun? <a href="login.php">Login Sekarang!</a>
                    </div>

                </div>
            </div>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>

<?php include "layout/footer.php"; ?>

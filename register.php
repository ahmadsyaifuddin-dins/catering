<?php 
	include"inc/config.php";
	
	if(!empty($_SESSION['iam_user'])){
		redir("index.php");
	}
	
	include"layout/header.php";
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
				if(!empty($_POST)){
			extract($_POST); 
		
			$password = md5($password);
			$q = mysqli_query($konek, "INSERT INTO user VALUES(NULL,'$nama','$email','$telephone','$alamat','$password','user')");
				if($q){  
			?>
                <font color="black">
                    <!-- <div class="alert alert-success">Register Berhasil.<br></div>-->
                    <script type='text/javascript'>
                    setTimeout(function() {
                        Swal.fire({
                            title: "Registrasi Berhasil !",
                            text: "Selamat Berbelanja",
                            icon: "success",
                            footer: '<a href="login.php">Silahkan Login !</a>',
                            timer: "100000",
                            showConfirmButton: false
                        });
                    }, 1);
                    window.setTimeout(function() {
                        window.location.replace('register.php');
                    }, 100000);
                    </script>
                    <?php }else{ ?>
                    <div class="alert alert-danger">Terjadi kesalahan dalam pengisian form. Silahkan Coba Lagi</div>
                    <?php } } ?>
                    <h3>
                        <font color="black">Register User
                    </h3>
                    <br>
                    <div class="col-md-7 content-menu" style="margin-top:-20px;">

                        <form action="" method="post" enctype="multipart/form-data">
                            <label>Nama</label><br>
                            <input type="text" class="form-control" name="nama" required><br>
                            <label>Email</label><br>
                            <input type="email" class="form-control" name="email" required><br>
                            <label>Telephone</label><br>
                            <input type="text" class="form-control" name="telephone" required><br>
                            <label>Alamat</label><br>
                            <input type="text" class="form-control" name="alamat" required><br>
                            <label>Password</label><br>
                            <input type="password" class="form-control" name="password" required><br>

                            <input type="submit" name="form-input" id="sweetAlert" value="Register"
                                class="btn btn-success">
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



<?php include"layout/footer.php"; ?>
<?php
include "../inc/config.php";

// Check if the admin is not logged in, redirect to login page
if (empty($_SESSION['iam_admin'])) {
    redir("index.php");
    exit; // Stop further execution if the user is not logged in
}

if (!empty($_GET)) {
    if ($_GET['act'] == 'delete') {
        $q = mysqli_query($konek, "DELETE FROM user WHERE id='$_GET[id]'");
        if ($q) {
            alert("Success");
            redir("user.php");
        }
    }
}

if (!empty($_GET['act']) && $_GET['act'] == 'create') {
    if (!empty($_POST)) {
        extract($_POST);
        $login_time = date('l/d/M/Y-H:i:s:a'); // Format datetime standar untuk MySQL
        $password = md5($password);
        $created_acc = date('Y-m-d H:i:s'); // Waktu pembuatan akun
        $q = mysqli_query($konek, "INSERT INTO user (nama, email, username, telephone, alamat, password, jenis_kelamin, status, last_login, created_acc) VALUES ('$nama', '$email', '$username', '$telephone', '$alamat', '$password', '$jk', '$status', '$login_time', '$created_acc')");
        if ($q) {
            alert("Success");
            redir("user.php");
        }
    }
}

if (!empty($_GET['act']) && $_GET['act'] == 'edit') {
    if (!empty($_POST)) {
        extract($_POST);
        $password = md5($password);
        $q = mysqli_query($konek, "UPDATE user SET nama='$nama', email='$email', username='$username', telephone='$telephone', alamat='$alamat', password='$password', jenis_kelamin='$jk', status='$status' WHERE id='$_GET[id]'") or die(mysqli_error($konek));
        if ($q) {
            alert("Success");
            redir("user.php");
        }
    }
}

include "inc/header.php";
?>

<link rel="stylesheet" href="../assets/css/border.css">

<div class="container">
    <?php
    $q = mysqli_query($konek, "SELECT * FROM user");
    $j = mysqli_num_rows($q);
    ?>
    <h4>Daftar User Masuk (<?php echo ($j > 0) ? $j : 0; ?>)</h4>
    <a class="btn btn-sm btn-primary" href="user.php?act=create">Tambah Data User <i class="fa-solid fa-user-plus"></i></a>
    <hr>
    <?php
    if (!empty($_GET)) {
        if ($_GET['act'] == 'create') {
    ?>
            <div class="row col-md-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <label>Nama</label><br>
                    <input type="text" class="form-control" name="nama" required><br>
                    <label>Email</label><br>
                    <input type="email" class="form-control" name="email" required><br>
                    <label>Username</label><br>
                    <input type="text" class="form-control" name="username" required><br>
                    <label>Password</label><br>
                    <input type="password" class="form-control" name="password" required><br>
                    <label>Telephone</label><br>
                    <input type="tel" class="form-control" name="telephone" required><br>
                    <label>Alamat</label><br>
                    <input type="text" class="form-control" name="alamat" required><br>
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select class="form-control" id="jenis_kelamin" name="jk" required>
                        <option value="LAKI-LAKI">Laki-laki</option>
                        <option value="PEREMPUAN">Perempuan</option>
                    </select><br>
                    <label>Status</label><br>
                    <select name="status" required class="form-control">
                        <option value="User">User</option>
                        <option value="Admin">Admin</option>
                    </select><br>
                    <input type="hidden" name="login_time" value="<?php echo date('l/d/M/Y-H:i:s:a'); ?>">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
            <div class="row col-md-12">
                <hr>
            </div>
        <?php
        }
        if ($_GET['act'] == 'edit') {
            $data = mysqli_fetch_object(mysqli_query($konek, "SELECT * FROM user WHERE id='$_GET[id]'"));
        ?>
            <div class="row col-md-6">
                <form action="user.php?act=edit&id=<?php echo $_GET['id'] ?>" method="post" enctype="multipart/form-data">
                    <label>Nama</label><br>
                    <input type="text" class="form-control" name="nama" value="<?php echo $data->nama; ?>" required><br>
                    <label>Email</label><br>
                    <input type="email" class="form-control" name="email" value="<?php echo $data->email; ?>" required><br>
                    <label>Username</label><br>
                    <input type="text" class="form-control" name="username" value="<?php echo $data->username; ?>" required><br>
                    <label>Password</label><br>
                    <input type="password" class="form-control" name="password" required><br>
                    <label>Telephone</label><br>
                    <input type="text" class="form-control" name="telephone" value="<?php echo $data->telephone; ?>" required><br>
                    <label>Alamat</label><br>
                    <input type="text" class="form-control" name="alamat" value="<?php echo $data->alamat; ?>" required><br>
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select class="form-control" id="jenis_kelamin" name="jk" required>
                        <option value="LAKI-LAKI">Laki-laki</option>
                        <option value="PEREMPUAN">Perempuan</option>
                    </select><br>
                    <label>Status</label><br>
                    <select name="status" required class="form-control">
                        <?php if ($data->status === "User") : ?>
                            <option value="User" selected>User</option>
                            <option value="Admin">Admin</option>
                        <?php elseif ($data->status === "Admin") : ?>
                            <option value="User">User</option>
                            <option value="Admin" selected>Admin</option>
                        <?php else : ?>
                            <option value="">Pilih status</option>
                            <option value="User">User</option>
                            <option value="Admin">Admin</option>
                        <?php endif; ?>
                    </select>
                    <br>
                    <input type="submit" name="form-edit" value="Simpan" class="btn btn-success">
                </form>
            </div>
            <div class="row col-md-12">
                <hr>
            </div>
    <?php
        }
    }
    ?>

    <table class="table">
        <thead style="background:#00b4d8">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Telephone</th>
                <th>Alamat</th>
                <th>Gender</th>
                <th>Waktu Online</th>
                <th>Status</th>
                <th>Created_Account</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; while ($data = mysqli_fetch_object($q)) { ?>
                <tr>
                    <th scope="row"><?php echo $no++; ?></th>
                    <td><?php echo $data->nama ?></td>
                    <td><?php echo $data->email ?></td>
                    <td><?php echo $data->telephone ?></td>
                    <td><?php echo $data->alamat ?></td>
                    <td><?php echo $data->jenis_kelamin ?></td>
                    <td><?php echo $data->last_login ?></td>
                    <td><?php echo $data->status ?></td>
                    <td><?php echo $data->created_acc ?></td>
                    <td>
                        <a class="btn btn-sm btn-success" href="user.php?act=edit&id=<?php echo $data->id ?>">Edit <i class="fa-solid fa-user-pen"></i></a>
                        <a class="btn btn-sm btn-danger" href="user.php?act=delete&id=<?php echo $data->id ?>">Delete <i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


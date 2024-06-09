<?php
include "../inc/config.php";
// Check if the admin is not logged in, redirect to login page
if (empty($_SESSION['iam_admin'])) {
    redir("index.php");
    exit; // Stop further execution if the user is not logged in
}


if (!empty($_GET)) {
    if ($_GET['act'] == 'delete') {

        $q = mysqli_query($konek, "delete from kategori_produk WHERE id='$_GET[id]'");
        if ($q) {
            alert("Success");
            redir("kategori_produk.php");
        }
    }
}
if (!empty($_GET['act']) && $_GET['act'] == 'create') {
    if (!empty($_POST)) {
        extract($_POST);

        $q = mysqli_query($konek, "insert into kategori_produk Values(NULL,'$nama','$deskripsi')");
        if ($q) {
            alert("Success");
            redir("kategori_produk.php");
        }
    }
}
if (!empty($_GET['act']) && $_GET['act'] == 'edit') {
    if (!empty($_POST)) {
        extract($_POST);

        $q = mysqli_query($konek, "update kategori_produk SET nama='$nama',deskripsi='$deskripsi' where id=$_GET[id]") or die(mysqli_error());
        if ($q) {
            alert("Success");
            redir("kategori_produk.php");
        }
    }
}


include "inc/header.php";

?>

<link rel="stylesheet" href="../assets/css/border.css">

<div class="container">
    <?php
    $q = mysqli_query($konek, "select*from kategori_produk");
    $j = mysqli_num_rows($q);
    ?>
    <h4>Daftar Kategori Produk (<?php echo ($j > 0) ? $j : 0; ?>)</h4>
    <a class="btn btn-sm btn-primary" href="kategori_produk.php?act=create"> <i class="fa-solid fa-plus"></i> Tambah
        Kategori </a>
    <hr>
    <?php
    if (!empty($_GET)) {
        if ($_GET['act'] == 'create') {
    ?>
            <div class="row col-md-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <label>Nama</label><br>
                    <input type="text" class="form-control" name="nama" required><br>
                    <label>Deskripsi</label><br>
                    <textarea class="form-control" name="deskripsi" required></textarea><br>
                    <input type="submit" name="form-input" value="Simpan" class="btn btn-success">
                </form>
            </div>
            <div class="row col-md-12">
                <hr>
            </div>
        <?php
        }
        if ($_GET['act'] == 'edit') {
            $data = mysqli_fetch_object(mysqli_query($konek, "select*from kategori_produk where id='$_GET[id]'"));
        ?>
            <div class="row col-md-6">
                <form action="kategori_produk.php?act=edit&&id=<?php echo $_GET['id'] ?>" method="post" enctype="multipart/form-data">
                    <label>Nama</label><br>
                    <input type="text" class="form-control" name="nama" value="<?php echo $data->nama; ?>" required><br>
                    <label>Deskripsi</label><br>
                    <textarea class="form-control" name="deskripsi" required><?php echo $data->deskripsi; ?></textarea><br>
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
                <th>Kategori</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>




            <?php while ($data = mysqli_fetch_object($q)) { ?>
                <tr>
                    <th scope="row"><?php echo $no++; ?></th>
                    <td><?php echo $data->nama ?></td>
                    <td><?php echo $data->deskripsi ?></td>
                    <td>
                        <a class="btn btn-sm btn-success" href="kategori_produk.php?act=edit&&id=<?php echo $data->id ?>">Edit <i class="fa-solid fa-pen-to-square"></i> </a>
                        <a class="btn btn-sm btn-danger" href="kategori_produk.php?act=delete&&id=<?php echo $data->id ?>">Delete <i class="fa-solid fa-trash"></i> </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div> <!-- /container -->
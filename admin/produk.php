<?php
include "../inc/config.php";

// Check if the admin is not logged in, redirect to login page
if (empty($_SESSION['iam_admin'])) {
    redir("index.php");
    exit; // Stop further execution if the user is not logged in
}

if (!empty($_GET)) {
    if ($_GET['act'] == 'delete') {

        $q = mysqli_query($konek, "delete from produk WHERE id='$_GET[id]'");
        if ($q) {
            alert("Success");
            redir("produk.php");
        }
    }
}
if (!empty($_GET['act']) && $_GET['act'] == 'create') {
    if (!empty($_POST)) {
        $gambar = md5('Y-m-d H:i:s') . $_FILES['gambar']['name'];
        extract($_POST);
        $deskripsi = (!empty($_POST['deskripsi'])) ? $_POST['deskripsi'] : NULL;
        $q = mysqli_query($konek, "insert into produk Values(NULL,'$nama','$deskripsi','$gambar','$harga','$kategori_produk_id')");
        if ($q) {
            $upload = move_uploaded_file($_FILES['gambar']['tmp_name'], '../uploads/' . $gambar);
            if ($upload) {
                alert("Success");
                redir("produk.php");
            }
        }
    }
}
if (!empty($_GET['act']) && $_GET['act'] == 'edit') {
    if (!empty($_POST)) {

        $gambar = md5('Y-m-d H:i:s') . $_FILES['gambar']['name'];
        extract($_POST);
        $deskripsi = (!empty($_POST['deskripsi'])) ? $_POST['deskripsi'] : NULL;

        $q = mysqli_query($konek, "update produk SET nama='$nama',deskripsi='$deskripsi', gambar='$gambar', harga='$harga', kategori_produk_id='$kategori_produk_id' where id=$_GET[id]") or die(mysqli_error());
        if ($q) {
            $upload = move_uploaded_file($_FILES['gambar']['tmp_name'], '../uploads/' . $gambar);
            if ($upload) {
                alert("Success");
                redir("produk.php");
            }
        }
    }
}


include "inc/header.php";

?>
<link rel="stylesheet" href="../assets/css/border.css">

<div class="container">
    <?php
    $q = mysqli_query($konek, "select*from produk");
    $j = mysqli_num_rows($q);
    ?>
    <h4>Daftar Produk (<?php echo ($j > 0) ? $j : 0; ?>)</h4>
    <a class="btn btn-sm btn-primary" href="produk.php?act=create"> <i class="fa-solid fa-plus"></i> Tambah Produk </a>
    <hr>
    <?php
    if (!empty($_GET)) {
        if ($_GET['act'] == 'create') {
    ?>
            <div class="row col-md-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <label>Kategori Produk</label><br>
                    <select name="kategori_produk_id" required class="form-control">
                        <?php
                        $katpro = mysqli_query($konek, "select*from kategori_produk");
                        while ($kp = mysqli_fetch_array($katpro)) {
                        ?>
                            <option value="<?php echo $kp['id']; ?>"><?php echo $kp['nama'] ?></option>
                        <?php } ?>
                    </select><br>
                    <label>Nama</label><br>
                    <input type="text" class="form-control" name="nama" required><br>
                    <label>Deskripsi</label><br>
                    <textarea class="form-control" name="deskripsi" required></textarea><br>
                    <label>Gambar</label><br>
                    <input type="file" class="form-control" name="gambar" required><br>
                    <label>Harga</label><br>
                    <input type="number" class="form-control" name="harga" required><br>
                    <input type="submit" name="form-input" value="Simpan" class="btn btn-success">
                </form>
            </div>
            <div class="row col-md-12">
                <hr>
            </div>
        <?php
        }
        if ($_GET['act'] == 'edit') {
            $data = mysqli_fetch_object(mysqli_query($konek, "select*from produk where id='$_GET[id]'"));
        ?>
            <div class="row col-md-6">
                <form action="produk.php?act=edit&&id=<?php echo $_GET['id'] ?>" method="post" enctype="multipart/form-data">
                    <label>Kategori Produk</label><br>
                    <select name="kategori_produk_id" required class="form-control">
                        <?php
                        $katpro = mysqli_query($konek, "select*from kategori_produk where id='$data->kategori_produk_id'");
                        $kpa = mysqli_fetch_array($katpro);
                        ?>
                        <option value="<?php echo $kpa['id']; ?>"><?php echo $kpa['nama'] ?></option>
                        <?php
                        $katpro = mysqli_query($konek, "select*from kategori_produk");
                        while ($kp = mysqli_fetch_array($katpro)) {
                        ?>
                            <option value="<?php echo $kp['id']; ?>"><?php echo $kp['nama'] ?></option>
                        <?php } ?>
                    </select><br>
                    <br>
                    <label>Nama</label><br>
                    <input type="text" class="form-control" name="nama" value="<?php echo $data->nama; ?>"><br>
                    <label>Deskripsi</label><br>
                    <textarea class="form-control" name="deskripsi" required><?php echo $data->deskripsi; ?></textarea><br>
                    <label>Gambar</label><br>
                    <input type="file" class="form-control" name="gambar" required><br>
                    <label>Harga</label><br>
                    <input type="number" class="form-control" name="harga" required value="<?php echo $data->harga; ?>"><br>
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
                <th width="100px">Gambar</th>
                <th>Nama Produk</th>
                <th>Harga Produk</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>




            <?php while ($data = mysqli_fetch_object($q)) { ?>
                <tr>
                    <th style="vertical-align: middle" scope="row"><?php echo $no++; ?></th>
                    <td style="vertical-align: middle"><img src="<?php echo $url . 'uploads/' . $data->gambar ?>" width="100%"></td>
                    <td style="vertical-align: middle"><?php echo $data->nama ?></td>
                    <td style="vertical-align: middle"><?php echo number_format($data->harga, 0, ',', '.') ?></td>
                    <td style="vertical-align: middle">
                        <a class="btn btn-sm btn-success" href="produk.php?act=edit&&id=<?php echo $data->id ?>">Edit <i class="fa-solid fa-pen-to-square"></i> </a>
                        <a class="btn btn-sm btn-danger" href="produk.php?act=delete&&id=<?php echo $data->id ?>">Delete <i class="fa-solid fa-trash"></i> </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div> <!-- /container -->
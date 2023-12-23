<?php
include "inc/config.php";
include "layout/header.php";

if (empty($_SESSION['iam_user'])) {
    redir("index.php");
}
$user = mysqli_fetch_object(mysqli_query($konek, "SELECT*FROM user WHERE id='$_SESSION[iam_user]'"));

$q = mysqli_query($konek, "SELECT*FROM pesanan WHERE user_id='$_SESSION[iam_user]' AND status='belum lunas'");
$j = mysqli_num_rows($q);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.all.min.js" integrity="sha256-5+4UA0RwHxrLdxuo+/LioZkIerSs8F/VDnV4Js9ZdwQ=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.min.css" integrity="sha256-ZCK10swXv9CN059AmZf9UzWpJS34XvilDMJ79K+WOgc=" crossorigin="anonymous">
</head>

<body>

    <font color="black">
        <div class="col-md-9">
            <div class="col-md-12">
                <?php
                if (!empty($_GET)) {
                    $q1 = mysqli_query($konek, "SELECT*FROM detail_pesanan WHERE pesanan_id='$_GET[id]'");
                    $total = 0;
                    $dataPesanan = mysqli_fetch_object(mysqli_query($konek, "SELECT * FROM pesanan WHERE id='$_GET[id]'"));
                    $kota = $dataPesanan->kota;
                    $ongkir = $dataPesanan->ongkir;
                    while ($data = mysqli_fetch_object($q1)) { ?>
                        <?php
                        $katpro = mysqli_query($konek, "SELECT*FROM produk WHERE id='$data->produk_id'");
                        $p = mysqli_fetch_object($katpro);
                        ?>
                        <?php $t = $data->qty * $p->harga;
                        $total += $t;
                        ?>
                    <?php } ?>
                    <?php
                    if ($_GET['act'] == 'bayar' && $_GET['id']) {
                        if (!empty($_POST)) {
                            $gambar = md5('Y-m-d H:i:s') . $_FILES['gambar']['name'];
                            extract($_POST);
                            $q = mysqli_query($konek, "INSERT INTO pembayaran VALUES(NULL,'$_GET[id]','$_SESSION[iam_user]','$gambar','$bayar','pending','$keterangan',NOW())");
                            if ($q) {
                                $upload = move_uploaded_file($_FILES['gambar']['tmp_name'], 'uploads/' . $gambar);
                                if ($upload) {
                                    // alert("Success");
                                    echo '<script>
                                    setTimeout(function() {
                                    Swal.fire({
                                    title: "Pembayaran Berhasil 😊",
                                    text: "Silahkan Tunggu Pemesanan Anda!",
                                    icon: "success"
                                    });
                                }, 1);
                                window.setTimeout(function() {
                                    window.location.replace("pembayaran.php");
                                }, 6000);
                                </script>';
                                    // redir("pembayaran.php");
                                }
                            }
                        }

                        extract($_GET);
                        $pesanan = mysqli_fetch_object(mysqli_query($konek, "SELECT*FROM pesanan WHERE id='$id'"));
                        $qPembayaran = mysqli_query($konek, "SELECT * FROM pembayaran WHERE id_pesanan='$id' AND status='verified'") or die(mysqli_error());
                        $totalPembayaran = 0;
                        while ($d = mysqli_fetch_object($qPembayaran)) {
                            $totalPembayaran += $d->total;
                        }
                    ?>
                        <div class="row col-md-6">
                            <form action="" method="post" enctype="multipart/form-data">
                                <label>Total</label><br>
                                <input type="text" class="form-control" name="total" value="<?php echo 'Rp. ' . number_format($total + $pesanan->ongkir, 0, ',', '.'); ?>" disabled required><br>
                                <label>Dibayar</label><br>
                                <input type="text" class="form-control" name="dibayar" value="<?php echo "Rp. " . number_format($totalPembayaran, 0, ",", "."); ?>" disabled required><br>
                                <label>Kekurangan</label><br>
                                <input type="text" class="form-control" name="kekurangan" value="<?php echo "Rp. " . number_format($total + $pesanan->ongkir - $totalPembayaran, 0, ",", "."); ?>" disabled required><br>
                                <label>Bayar</label><br>
                                <input type="number" class="form-control" name="bayar" required><br>
                                <label>Bukti Pembayaran</label><br>
                                <input type="file" class="form-control" name="gambar" required><br>
                                <label>Bukti Pembayaran</label><br>
                                <textarea class="form-control" name="keterangan"></textarea><br />
                                <input type="submit" name="form-input" value="Kirim" class="btn btn-success">
                            </form>
                        </div>
                        <div class="row col-md-12">
                            <br>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
            <h3 class="text-color-heading">Perlu Pembayaran Pemesanan </h3>
            <br>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr style="background:#c3ebf8;font-weight:bold;">
                        <th>No</th>
                        <th>Nama Pemesan</th>
                        <th>Tanggal Pesan</th>
                        <th>Tanggal Digunakan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($data = mysqli_fetch_object($q)) { ?>
                        <tr <?php if ($data->read == 0) {
                                echo 'style="background:#cce9f8 !important;"';
                            } ?>>
                            <th scope="row"><?php echo $no++; ?></th>
                            <?php
                            $katpro = mysqli_query($konek, "SELECT*FROM user WHERE id='$data->user_id'");
                            $user = mysqli_fetch_array($katpro);
                            ?>
                            <td><?php echo $data->nama ?></td>
                            <td><?php echo substr($data->tanggal_pesan, 0, 10) ?></td>
                            <td><?php echo $data->tanggal_digunakan ?></td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="pembayaran.php?act=bayar&id=<?php echo
                                                                                                    $data->id; ?>">Bayar</a>
                                <a class="btn btn-sm btn-danger" href="pembayaran.php?act=delete&&id=<?php echo
                                                                                                        $data->id ?>">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
</body>

</html>

<?php include "layout/footer.php"; ?>

<?php

if (!empty($_GET)) {
    if ($_GET['act'] == 'delete') {

        $q = mysqli_query($konek, "DELETE FROM pesanan WHERE id='$_GET[id]'");
        if ($q) {
            // alert("Success");
            echo '<script>
            setTimeout(function() {
            Swal.fire({
            title: "Pesanan berhasil di Hapus !",
            icon: "success",
            });
        }, 1);
        window.setTimeout(function() {
            window.location.replace("pembayaran.php");
        }, 3000);
            </script>';
            // redir("pembayaran.php");
        }
    }
}

<?php
include "inc/config.php";

if (empty($_SESSION['iam_user'])) {
    redir("index.php");
}
$user = mysqli_fetch_object(mysqli_query($konek, "SELECT * FROM user WHERE id='$_SESSION[iam_user]'"));

include "layout/header.php";

$q = mysqli_query($konek, "SELECT * FROM pesanan WHERE user_id='$_SESSION[iam_user]'");
$j = mysqli_num_rows($q);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile User</title>
    <style>
        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
            }
        }
    </style>
</head>

<body>

    <font color="black">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12 content-menu">
                    <h3>Profile: <?php echo $user->nama; ?></h3>
                    <br>
                    <div class="col-md-6" style="margin-top:-20px;">
                        <table class="table table-bordered">
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td><?php echo $user->nama; ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td><?php echo $user->email; ?></td>
                            </tr>
                            <tr>
                                <td>Username</td>
                                <td>:</td>
                                <td><?php echo $user->username; ?></td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td>:</td>
                                <td>--- *** --</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td><?php echo $user->alamat; ?></td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td><?php echo $user->jenis_kelamin; ?></td>
                            </tr>
                            <tr>
                                <td>Telephone</td>
                                <td>:</td>
                                <td><?php echo $user->telephone; ?></td>
                            </tr>
                            <tr>
                                <td>Online</td>
                                <td>:</td>
                                <td><?php echo $user->last_login; ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Registrasi</td>
                                <td>:</td>
                                <td><?php echo $user->created_acc; ?></td>
                            </tr>
                            
                            
                        </table>
                    </div>

                    <div class="col-md-12 content-menu">
                        <h3>Riwayat Pemesanan</h3>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pemesan</th>
                                        <th>Tanggal Pesan</th>
                                        <th>Tanggal Digunakan</th>
                                        <th>Telephone</th>
                                        <th>Alamat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $no = 1;
                                    while ($data = mysqli_fetch_object($q)) { ?>
                                        <tr <?php if ($data->read == 0) { echo 'style="background:#cce9f8 !important;"'; } ?>>
                                            <th scope="row"><?php echo $no++; ?></th>
                                            <?php
                                            $katpro = mysqli_query($konek, "SELECT * FROM user WHERE id='$data->user_id'");
                                            $user = mysqli_fetch_array($katpro);
                                            ?>
                                            <td><?php echo $data->nama ?></td>
                                            <td><?php echo substr($data->tanggal_pesan, 0, 10) ?></td>
                                            <td><?php echo $data->tanggal_digunakan ?></td>
                                            <td><?php echo $data->telephone ?></td>
                                            <td><?php echo $data->alamat ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
</body>

</html>

<?php include "layout/footer.php"; ?>

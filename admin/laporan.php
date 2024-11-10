<?php
ob_start();
include "../inc/config.php";

// Enable error reporting for mysqli
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Check if the admin is not logged in, redirect to login page
if (empty($_SESSION['iam_admin'])) {
    redir("index.php");
    exit; // Stop further execution if the user is not logged in
}
include "inc/header.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <!-- icons link cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/border.css">
    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">
    <style>
    .dataTables_wrapper .dataTables_filter {
        float: right;
        text-align: right;
    }

    .dataTables_wrapper .dataTables_paginate {
        float: right;
        text-align: right;
    }
    </style>
</head>

<body>
    <div class="container">
        <h3>Laporan Penjualan</h3>
        <a href="export.php" class="btn btn-success"> <i class="fa-solid fa-file-excel"></i> Export ke Excel</a>
        <div class="col-md-12">
            <hr />
        </div>

        <div class="row">
            <table class="table display" border="1">
                <thead style="background:#00b4d8">
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Tanggal Tempo</th>
                        <th>Tanggal Pesan</th>
                        <th>Total</th>
                        <th>Ongkir</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                $totalSemua = 0;
                $totalOngkir = 0;
                $totalHabis = 0;
                $no = 0;
                
                // Fetch pesanan data
                $queryPesanan = "SELECT * FROM pesanan ORDER BY id DESC";
                $resultPesanan = mysqli_query($konek, $queryPesanan);
                
                while ($data = mysqli_fetch_object($resultPesanan)) {
                    $totalHarga = 0;
                    $no++;
                    
                    // Fetch detail_pesanan data
                    $queryDetail = "SELECT detail_pesanan.*, produk.harga 
                                    FROM detail_pesanan 
                                    INNER JOIN produk ON detail_pesanan.produk_id = produk.id 
                                    WHERE pesanan_id = '$data->id'";
                    $resultDetail = mysqli_query($konek, $queryDetail);
                    
                    while ($d = mysqli_fetch_object($resultDetail)) {
                        $totalHarga += $d->harga * $d->qty;
                    }
                    
                    $totalSemua += $totalHarga;
                    $totalOngkir += $data->ongkir;
                    $totalHabis += $totalHarga + $data->ongkir;
                ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo htmlspecialchars($data->nama); ?></td>
                        <td><?php echo htmlspecialchars($data->tanggal_digunakan); ?></td>
                        <td><?php echo htmlspecialchars($data->tanggal_pesan); ?></td>
                        <td><?php echo "Rp. " . number_format($totalHarga, 0, ",", "."); ?></td>
                        <td><?php echo "Rp. " . number_format($data->ongkir, 0, ",", "."); ?></td>
                        <td><?php echo htmlspecialchars($data->status); ?></td>
                    </tr>
                    <?php
                }
                ?>
                    <tr>
                        <td colspan="4" align="right">
                            <font size="3"><b>SUB TOTAL</b></font>
                        </td>
                        <td>
                            <font size="3"><?php echo "Rp. " . number_format($totalSemua, 0, ",", "."); ?></font>
                        </td>
                        <td>
                            <font size="3"><?php echo "Rp. " . number_format($totalOngkir, 0, ",", "."); ?></font>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" align="center">
                            <font size="4"><b>TOTAL SEMUA</b></font>
                        </td>
                        <td colspan="2" align="center">
                            <font size="3"><b><?php echo "Rp. " . number_format($totalHabis, 0, ",", "."); ?></b></font>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- Include DataTables Buttons JS -->
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>

    <script>
    $(document).ready(function() {
        $('table.display').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excelHtml5',
                    text: 'Export ke Excel',
                    className: 'btn btn-success'
                },
                {
                    extend: 'pdfHtml5',
                    text: 'Export ke PDF',
                    className: 'btn btn-danger'
                },
                {
                    extend: 'print',
                    text: 'Print',
                    className: 'btn btn-primary'
                }
            ]
        });
    });
    </script>

</body>

</html>
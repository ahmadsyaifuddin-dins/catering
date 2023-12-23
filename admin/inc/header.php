<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">

    <title><?php echo $title; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $url ?>assets/bootstrap/css/bootstrap_old.min.css" rel="stylesheet">
    <link href="<?php echo $url ?>assets/bootstrap/css/datetimepicker.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug 
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Custom styles for this template -->
    <link href="<?php echo $url ?>assets/css/navbar-fixed-top.css" rel="stylesheet">
    <link href="<?php echo $url ?>assets/css/full-slider.css" rel="stylesheet">
    <!-- <link href="<?php echo $url ?>assets/css/style.css" rel="stylesheet"> -->

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <?php
  // TOTAL PESANAN BELUM DI READ
  $qpesanan = mysqli_query($konek, "select*from pesanan where `read`='0'");
  $totalUnRead = mysqli_num_rows($qpesanan);
  // TOTAL PEMBAYARAN YANG BELUM DI VERIFIKASI
  $qPembayaran = mysqli_query($konek, "select*from pembayaran where `status`='pending'");
  $totalPending =  mysqli_num_rows($qPembayaran);
  ?>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Web Administrator</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo $url ?>admin/index.php"> <i class="fa-solid fa-house"></i> Home</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                            aria-expanded="false"> <i class="fa-solid fa-database"></i> Pangkalan Data <span
                                class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="user.php"> Data User <i class="fa-solid fa-address-book"></i> </a></li>
                            <li><a href="produk.php"> Data Produk <i class="fa-solid fa-clipboard-list"></i> </a></li>
                            <li><a href="kategori_produk.php"> Data Kategori Produk <i
                                        class="fa-solid fa-list-check"></i> </a></li>
                            <li><a href="kota.php"> Kota & Ongkir <i class="fa-solid fa-building-flag"></i> </a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="laporan.php"> <i class="fa-solid fa-file-export"></i> Laporan</a>
                    </li>
                    <li><a href="pesanan.php"> <i class="fa-solid fa-cart-shopping"></i> Pesanan
                            <?php if ($totalUnRead > 0) { ?> <span class="badge"><?php echo $totalUnRead; ?></span>
                            <?php } ?>
                        </a></li>
                    <li><a href="pembayaran.php"> <i class="fa-solid fa-credit-card"></i> Pembayaran
                            <?php if ($totalPending > 0) { ?> <span class="badge"><?php echo $totalPending; ?></span>
                            <?php } ?>
                        </a></li>
                    <li><a href="kontak.php"> <i class="fa-solid fa-address-book"></i> Kontak</a></li>
                    <li><a href="<?php echo $url ?>admin/logout.php"> <i class="fa-solid fa-right-from-bracket"></i>
                            Logout</a></li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>

    <script src="<?php echo $url ?>assets/js/jquery.js"></script>
    <script src="<?php echo $url ?>assets/bootstrap/js/bootstrap.min.js"></script>
</body>
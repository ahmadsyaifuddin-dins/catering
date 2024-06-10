<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>

    <link href="<?php echo $url ?>assets/bootstrap/css/bootstrap_old.min.css" rel="stylesheet">
    <link href="<?php echo $url ?>assets/bootstrap/css/datetimepicker.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="<?php echo $url ?>assets/css/navbar-fixed-top.css" rel="stylesheet">
    <link href="<?php echo $url ?>assets/css/full-slider.css" rel="stylesheet">
    <link href="<?php echo $url ?>assets/css/style.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Helvetica', arial, sans-serif;
            font-size: 15px;
        }
        .navbar .user-icon {
            float: right;
            margin-right: 5px;
        }
        @media (max-width: 767px) {
            .navbar .user-icon {
                margin-right: 0;
            }
        }
    </style>


</head>
<body>
    
<nav class="navbar navbar-default navbar-fixed-top navbar-orange">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Asai's 🍴🍝</a>
                <ul class="nav navbar-nav navbar-right user-icon">
                    <?php if (!empty($_SESSION['iam_user'])) { 
                        $user = mysqli_fetch_object(mysqli_query($konek, "SELECT*FROM user where id='$_SESSION[iam_user]'"));
                    ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fa-solid fa-user"></i> Hi <?php echo $user->username; ?> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo $url ?>profile.php"> <i class="fa-solid fa-address-card"></i> Profile</a></li>
                                <li><a href="<?php echo $url ?>logout.php"> <i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                            </ul>
                        </li>
                    <?php } else { ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fa-solid fa-user"></i> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo $url ?>login.php"> <i class="fa-solid fa-right-to-bracket"></i> Login</a></li>
                                <li><a href="<?php echo $url ?>register.php"> <i class="fa-solid fa-user-plus"></i> Register</a></li>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
                
            </div>

            

            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo $url ?>"> <i class="fa-solid fa-house"></i> Home</a></li>
                    <li><a href="<?php echo $url ?>menu.php"> <i class="fa-solid fa-cart-plus"></i> Menu Makanan & Minuman</a></li>
                    <li><a href="<?php echo $url ?>kontak.php"> <i class="fa-solid fa-message"></i> Kontak Kami</a></li>
                    <li><a href="<?php echo $url ?>info.php"> <i class="fa-solid fa-circle-info"></i> Info Pembayaran</a></li>
                    <?php if (!empty($_SESSION['iam_user'])) { ?>
                        <li><a href="<?php echo $url ?>pembayaran.php"> <i class="fa-regular fa-money-bill-1"></i> Pembayaran</a></li>
                    <?php } ?>
                </ul>
                
                

            </div>

            

        </div>
    </nav>

</body>
</html>
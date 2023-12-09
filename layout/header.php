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
    <link href="<?php echo $url ?>assets/css/style.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<style>
		body{
			font-family: 'Helvetica', arial, sans-serif;
      background-color: #F1BC53;
			background-repeat: no-repeat;
			background-size:cover;
			background-attachment: fixed;
			font-size: 15px;
		}

    .circle{
  position: absolute;
  border-radius: 50%;
  background: white;
  animation: ripple 15s infinite;
  box-shadow: 0px 0px 1px 0px #508fb9;
}

.small{
  width: 200px;
  height: 200px;
  left: -100px;
  bottom: -100px;
}

.medium{
  width: 400px;
  height: 400px;
  left: -200px;
  bottom: -200px;
}

.large{
  width: 600px;
  height: 600px;
  left: -300px;
  bottom: -300px;
}

.xlarge{
  width: 800px;
  height: 800px;
  left: -400px;
  bottom: -400px;
}

.xxlarge{
  width: 1000px;
  height: 1000px;
  left: -500px;
  bottom: -500px;
}

.shade1{
  opacity: 0.2;
}
.shade2{
  opacity: 0.5;
}

.shade3{
  opacity: 0.7;
}

.shade4{
  opacity: 0.8;
}

.shade5{
  opacity: 0.9;
}

@keyframes ripple{
  0%{
    transform: scale(0.8);
  }
  
  50%{
    transform: scale(1.2);
  }
  
  100%{
    transform: scale(0.8);
  }
}
	</style>
	
	
	
  </head>

  <body>

  <!-- Background Animation -->
  <div class='ripple-background'>
  <div class='circle xxlarge shade1'></div>
  <div class='circle xlarge shade2'></div>
  <div class='circle large shade3'></div>
  <div class='circle medium shade4'></div>
  <div class='circle small shade5'></div>
  </div>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top navbar-orange">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Asai's Kitchen</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse"> 
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo $url ?>"> <i class="fa-solid fa-house"></i> Home</a></li>
            <li><a href="<?php echo $url ?>menu.php"> <i class="fa-solid fa-cart-plus"></i> Menu Katering</a></li>
            <li><a href="<?php echo $url ?>kontak.php"> <i class="fa-solid fa-message"></i> Kontak Kami</a></li> 
            <li><a href="<?php echo $url ?>info.php"> <i class="fa-solid fa-circle-info"></i> Info Pembayaran</a></li> 
            <?php if(!empty($_SESSION['iam_user'])){ ?>
			<?php 
				$user = mysqli_fetch_object(mysqli_query($konek, "SELECT*FROM user where id='$_SESSION[iam_user]'"));
			?>
      <li><a href="<?php echo $url ?>pembayaran.php"> <i class="fa-solid fa-money-bill-1-wave"></i> Pembayaran</a></li>      
			<li class="dropdown">

              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="fa-solid fa-user"></i> Hi <?php echo $user->nama; ?> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo $url ?>profile.php"> <i class="fa-solid fa-address-card"></i> Profile</a></li> 
                <li><a href="<?php echo $url ?>logout.php"> <i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>  
              </ul>
            </li>
			<?php }else{ ?>
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="fa-solid fa-user"></i> Login/Register <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo $url ?>login.php"> <i class="fa-solid fa-right-to-bracket"></i> Login</a></li>
              
                <li><a href="<?php echo $url ?>register.php"> <i class="fa-solid fa-user-plus"></i> Register</a></li>  
              </ul>
            </li>
			<?php } ?>
			

          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

   <?php if('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'] == $url.'index.php'){ ?>
    <div class="container">

     <!-- Full Page Image Background Carousel Header -->
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li> 
        </ol>

        <!-- Wrapper for Slides -->
          <div class="carousel-inner">
            <div class="item active">
                <!-- Set the first background image using inline CSS below. -->
                <div class="fill" style="background-image:url('<?php $url ?>assets/img/gb1.jpg');"></div>
                <div class="carousel-caption">
                    <h2>AS</h2>
                </div>
            </div>
            <div class="item">
                <!-- Set the second background image using inline CSS below. -->
                <div class="fill" style="background-image:url('<?php $url ?>assets/img/cat1.jpg');"></div>
                <div class="carousel-caption">
                    <h2>AS</h2>
                </div>
            </div>
			<div class="item">
                <!-- Set the second background image using inline CSS below. -->
                <div class="fill" style="background-image:url('<?php $url ?>assets/img/cat17.jpg');"></div>
                <div class="carousel-caption">
                    <h2>AS</h2>
                </div>
            </div>
			<div class="item">
                <!-- Set the second background image using inline CSS below. -->
                <div class="fill" style="background-image:url('<?php $url ?>assets/img/cat16.jpg');"></div>
                <div class="carousel-caption">
                    <h2>AS</h2>
                </div>
            </div>
			<div class="item">
                <!-- Set the second background image using inline CSS below. -->
                <div class="fill" style="background-image:url('<?php $url ?>assets/img/cat7.jpg');"></div>
                <div class="carousel-caption">
                    <h2>AS</h2>
                </div>
            </div> 
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>

    </header>
    </div> <!-- /container -->
   <?php } ?>
	
	<div class="container" style="margin-top:20px;">
	<div class="row">
		<div class="col-md-3">
			<div class="warna-bg" style="width:100%; height:auto; padding-top:3px;padding-bottom:3px; padding-left:10px;">
			<h4><font color="white">Kategori Menu <i class="fa-solid fa-utensils"></i> </h4>
			</div>
			<ul class="kategori">
				<?php 
					$kategori = mysqli_query($konek, "SELECT * FROM kategori_produk"); 
					while($data = mysqli_fetch_array($kategori)){
				?>
					<li><a href="<?php echo $url; ?>menu.php?kategori=<?php echo $data['id'] ?>"><?php echo $data['nama']; ?> (
					<?php 
						$ck = mysqli_num_rows(mysqli_query($konek, "SELECT * FROM produk WHERE kategori_produk_id='$data[id]'"));
						if($ck > 0){ echo $ck; }else{ echo 0; } ?>
					)</a></li>
				<?php } ?>
			</ul>
			<div class="warna-bg" style="width:100%; height:auto; padding-top:3px;padding-bottom:3px; padding-left:10px; 	margin-bottom:15px;">
				<h4><font color="white">Keranjang Belanja <i class="fa-solid fa-bucket"></i> </h4>
			</div>
			<div style=" width:100%; height:auto; padding-top:3px;padding-bottom:3px; padding-left:10px; 	margin-bottom:15px; border: 1px dashed #000;">
			
			<?php
                            if(isset($_SESSION['cart'])){
                                $total = 0;
                                $cart = unserialize($_SESSION['cart']);
                                if($cart == ''){
                                    $cart = [];
                                }
                                foreach($cart as $id => $qty){
                                    $product = mysqli_fetch_array(mysqli_query($konek, "select * from produk WHERE id='$id'"));
                                    if(isset($product)){
                                       $t = $qty * $product['harga'];
                                       $total += $t;
                                    }
                                }
                                echo '<h4 style="color:#f00;">Rp '. number_format($total, 0, ',', '.') .'</h4>';
                            }else{
                                echo '<h4 style="color:#f00;">Rp 0</h4>';
                            }
                                
                        ?>
				
				<a href="<?php echo $url; ?>keranjang.php">Lihat Keranjang Belanja <i class="fa-solid fa-bucket"></i> </a>
			</div>
			<div class="row col-md-12">
					
			</div>
			<div class="row col-sm-12">
				<hr>
				<img class="img-center" src="<?php echo $url.'uploads/logo2.png'; ?>" width="200" height="200"><br><br>
			</div>
		</div>
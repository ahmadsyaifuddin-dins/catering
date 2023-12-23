<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap_old.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
	<link rel="stylesheet" href="../../assets/css/admin.css">

	<title>Document</title>
</head>

<body>


	<div class="container" style="margin-top:32%;">
		<footer class="text-center">
			<font color="white">
				<div class="col-md-12 animate__animated animate__lightSpeedInLeft animate__slower"><b> &#169; Ahmad
						Syaifuddin <span id="year"></span> | AS Katering Online</b>
					<!-- <br> -->
				</div>
			</font>
		</footer>
	</div>
	<script src="<?php echo $url ?>assets/js/jquery.js"></script>
	<script src="<?php echo $url ?>assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo $url ?>assets/bootstrap/js/moment.js"></script>
	<script src="<?php echo $url ?>assets/bootstrap/js/bootstrap-datetimepicker.min.js"></script>
	<script type="text/javascript">
		$(function() {
			$('#datetimepicker').datetimepicker({
				format: 'YYYY-MM-DD',
			});
			$('#datetimepicker2').datetimepicker({
				format: 'YYYY-MM-DD',
			});
		});

		document.getElementById("year").innerHTML = new Date().getFullYear();
	</script>
</body>

</html>
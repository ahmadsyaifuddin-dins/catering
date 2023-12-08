<?php
	session_start();
	$konek = mysqli_connect("127.0.0.1", "root", "", "catering");

	// settings
	$url = "http://localhost/catering/";
	$title = "Asai's Kitchen";
	$no = 1;

	function alert($command){
		echo "<script>alert('".$command."');</script>";
	}

	function redir($command){
		echo "<script>document.location='".$command."';</script>";
	}

	function validate_admin_not_login($command){
		if(empty($_SESSION['iam_admin'])){
			redir($command);
		}
	}
?>

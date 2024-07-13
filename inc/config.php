<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "if0_36712978_e_commerce"; //nama database yg di tuju

// Create connection
$konek = mysqli_connect($servername, $username, $password, $database);

// Check connection
if ($konek->connect_error) {
	die("Connection failed: " . $konek->connect_error);
}

// settings posisi/tempat path folder aplikasi ini
$url = "http://localhost/catering/";
$title = "Asai's Kitchen 🍴🍉";
$no = 1;

function alert($command)
{
	echo "<script>alert('" . $command . "');</script>";
}

function redir($command)
{
	echo "<script>document.location='" . $command . "';</script>";
}

function validate_admin_not_login($command)
{
	if (empty($_SESSION['iam_admin'])) {
		redir($command);
	}
}

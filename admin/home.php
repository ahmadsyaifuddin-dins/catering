<?php
include "../inc/config.php";

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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.min.css" integrity="sha256-ZCK10swXv9CN059AmZf9UzWpJS34XvilDMJ79K+WOgc=" crossorigin="anonymous">
    <title>Admin</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="title-head animate__hinge animate__delay-3s"> <i class="fa-solid fa-gear"></i> Administrator Asai Kitchen (Mysql)</h2>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.all.min.js" integrity="sha256-5+4UA0RwHxrLdxuo+/LioZkIerSs8F/VDnV4Js9ZdwQ=" crossorigin="anonymous"></script>

    <?php include "inc/footer.php"; ?>

    <?php
    if (!empty($_SESSION['just_logged_in'])) {
        echo "<script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Selamat Anda telah Login',
                    showConfirmButton: false,
                    timer: 2000
                });
            </script>";
        // Unset the session variable to ensure SweetAlert is shown only once
        unset($_SESSION['just_logged_in']);
    }
    ?>
</body>
</html>

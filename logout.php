<?php
include "inc/config.php";
include "layout/header.php";

// Hapus sesi pengguna
unset($_SESSION['iam_user']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <script type="text/javascript">
        // SweetAlert untuk memberitahu bahwa pengguna telah logout
        Swal.fire({
            title: 'Anda sudah logout!',
            text: 'Anda telah berhasil logout.',
            icon: 'info',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect setelah pengguna menutup SweetAlert
                window.location.href = '<?php echo $url; ?>index.php';
            }
        });
    </script>
</body>
</html>

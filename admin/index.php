<?php
include "../inc/config.php";
if (!empty($_SESSION['iam_admin'])) {
    redir("home.php");
}

if (!empty($_POST)) {
    extract($_POST);
    $password = md5($password);

    // Use prepared statements to prevent SQL injection
    $query = "SELECT * FROM user WHERE email=? AND password=? AND status='admin'";
    $stmt = mysqli_prepare($konek, $query);

    // Check if the prepared statement was successful
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $email, $password);
        mysqli_stmt_execute($stmt);

        // Get the result
        $result = mysqli_stmt_get_result($stmt);

        // Check if any rows were returned
        if ($row = mysqli_fetch_object($result)) {
            $_SESSION['iam_admin'] = $row->id;
            redir("home.php");
        } else {
            // alert("Maaf email dan password anda salah");
            // Swal.fire code ...
            echo '<script>
                    Swal.fire({
                        title: "Gagal Login!",
                        text: "Password atau Akun Salah!",
                        icon: "error"
                    });
                  </script>';
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Handle the error if preparing the statement fails
        die('Error in preparing the statement');
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Login Admin 🔐</title>
    <link rel='stylesheet' href='<?php echo $url; ?>assets/bootstrap/css/bootstrap_old.min.css'>
    <link rel="stylesheet" href="<?php echo $url; ?>assets/css/style_login.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@latest/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@latest/dist/sweetalert2.min.css">


</head>

<body>
    <div class="wrapper">
        <form class="form-signin" action="" method="POST">
            <h2 class="form-signin-heading">Admin Login 🔐</h2>
            <input type="email" class="form-control" name="email" placeholder="📧Email" required="" autofocus="" /><br>
            <input type="password" class="form-control" name="password" placeholder="🔐Password" required="" />
            <button class="btn btn-lg btn-primary btn-block" type="submit">Login 🔑</button>
        </form>
    </div>
</body>

</html>
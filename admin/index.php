<?php
include "../inc/config.php";
if (!empty($_SESSION['iam_admin'])) {
    redir("home.php");
    exit; // Stop further execution if the admin is already logged in
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login Admin 🔒</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet' href='<?php echo $url; ?>assets/bootstrap/css/bootstrap_old.min.css'>
    <link rel="stylesheet" href="<?php echo $url; ?>assets/css/style_login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.min.css" integrity="sha256-ZCK10swXv9CN059AmZf9UzWpJS34XvilDMJ79K+WOgc=" crossorigin="anonymous">
</head>
<body>
    <div class="wrapper">
        <form class="form-signin" action="" method="POST">
            <h2 class="form-signin-heading">Admin Login 🔐</h2>
            <input type="email" class="form-control" name="email" placeholder="Email" required="" autofocus="" /><br>
            <input type="password" class="form-control" name="password" placeholder="Password" required="" />
            <button class="btn btn-lg btn-primary btn-block" type="submit">Login 🔑</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.all.min.js" integrity="sha256-5+4UA0RwHxrLdxuo+/LioZkIerSs8F/VDnV4Js9ZdwQ=" crossorigin="anonymous"></script>

    <?php
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        // Use prepared statements to prevent SQL injection
        $query = "SELECT * FROM user WHERE email=? AND password=? AND status='admin' LIMIT 1";
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
                $_SESSION['just_logged_in'] = true; // Set session variable to indicate successful login
                redir("home.php");
                exit; // Stop further execution after redirection
            } else {
                echo "<script type='text/javascript'>
                Swal.fire({
                    title: 'Gagal Login !',
                    text: 'Password atau Email Salah!',
                    icon: 'error',
                });
                </script>";
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            die('Error in preparing the statement');
        }
    }
    ?>
</body>
</html>

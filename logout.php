<?php include"inc/config.php"; ?>
<?php
	unset($_SESSION['iam_user']);
	redir($url."index.php");
?>

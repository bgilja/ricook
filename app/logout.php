<?php
session_start();
if(!empty($_POST["logout"])) {
	$_SESSION["user_id"] = "";
	header('Location:  index.php');
	session_destroy();
}
?>

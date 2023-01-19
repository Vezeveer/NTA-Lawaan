<?php
	include_once 'header.php';

	if(isset($_SESSION["usersname"])){
		header("location: main.php");
		exit();
	}

	include 'login.php';

	include_once 'footer.php';
?>

<?php
	include_once 'php-components/header.php';

	if(isset($_SESSION["usersname"])){
		header("location: main.php");
		exit();
	} else {
		header("location: login.php");
		exit();
	}

	include_once 'php-components/footer.php';

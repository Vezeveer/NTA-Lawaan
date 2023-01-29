<?php
	include_once 'php-components/header.php';
	echo "<!-- MAIN -->
	<div class=\"col p-4 overflow-auto\" id=\"main-content\">";
	if(isset($_SESSION["usersname"])){
		header("location: main.php");
		exit();
	} else {
		header("location: login.php");
		exit();
	}

	include_once 'php-components/footer.php';

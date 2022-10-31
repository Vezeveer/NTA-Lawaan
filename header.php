<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>NTA Lawaan</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/sidebar.css">
	<link rel="stylesheet" type="text/css" href="css/priority.css">
	<link rel="stylesheet" type="text/css" href="css/tableResizable.css">
	<link rel="stylesheet" type="text/css" href="css/tooltips.css">

	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body
	<?php // Click inside username input on page load
		if(!isset($_SESSION["usersname"])){
			// echo "onload=\"clickInput()\"";
		}
	?>
>
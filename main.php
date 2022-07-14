<?php
	include_once 'header.php';

	if($_SESSION["usersname"] == null){
		header("location: index.php");
		exit();
	}
?>
	<div class="container">
    <!-- tables, sidebar, etc -->

	<?php
		if(isset($_SESSION["usersname"])){
			echo "<li><a href='includes/logout.inc.php'>Logout</a></li>";
		}
	?>

    </div>
<?php
	include_once 'footer.php';
?>
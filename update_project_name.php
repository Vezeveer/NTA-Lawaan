<?php

include('includes\databasehandler.inc.php');

// MySQLi Procedural
$sql = "UPDATE `{$_GET['year']}` SET 
project = '{$_POST['project']}' WHERE project='{$_GET['project']}'";

if (mysqli_query($conn, $sql)) {
    header("location: ../main.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
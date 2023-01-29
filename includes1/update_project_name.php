<?php

include('databasehandler.inc.php');

$yr = "year_{$_GET['year']}";
// MySQLi Procedural
$sql = "UPDATE $yr SET 
project = '{$_POST['project']}' WHERE project='{$_GET['project']}'";

if (mysqli_query($conn, $sql)) {
    header("location: ../main.php");
} else {
    echo "Failed to update project name. Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
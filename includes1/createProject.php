<?php

require_once 'databasehandler.inc.php';

// MySQLi Procedural
$sql = "INSERT INTO `year_{$_GET['year']}` (project, aipRefCode)
VALUES ('{$_POST['projectName']}', '{$_POST['aipRefCode']}')";

if (mysqli_query($conn, $sql)) {
    header("location: ../main.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

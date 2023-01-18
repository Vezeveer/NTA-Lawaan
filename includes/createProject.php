<?php

require_once 'databasehandler.inc.php';

// MySQLi Procedural
$sql = "INSERT INTO `{$_GET['year']}` (project, approved, aipRefCode)
VALUES ('{$_POST['projectName']}', '0', '{$_POST['aipRefCode']}')";

if (mysqli_query($conn, $sql)) {
    header("location: ../main.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

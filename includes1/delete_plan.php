<?php
require_once 'databasehandler.inc.php';
$y = "year_".$_GET['year'];
$sql1 = "DROP TABLE {$y};";
$sql2 = "DELETE FROM `status` WHERE year = '{$_GET['year']}';";
$sql = $sql1.$sql2;

// Execute multiple queries
if (mysqli_multi_query($conn, $sql)) {
    header("location: ../dashboard.php?result=success");

} else {
    echo "Error deleting table: " . mysqli_error($conn);
}

mysqli_close($conn);
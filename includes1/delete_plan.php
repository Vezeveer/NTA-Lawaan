<?php
require_once 'databasehandler.inc.php';
require_once 'functions.inc.php';
$y = "year_".$_GET['year'];
$sql1 = "DROP TABLE {$y};";
$sql2 = "DELETE FROM `status` WHERE year = '{$_GET['year']}';";
$sql3 = "SELECT * FROM `status` WHERE active=1;";
$sql = $sql1.$sql2.$sql3;

// Execute multiple queries
if (mysqli_multi_query($conn, $sql)) {
    if ($result = mysqli_store_result($conn)) {
        while ($row = mysqli_fetch_row($result)) {
          
        }
        mysqli_free_result($result);
      } else {
        header("location: ../dashboard.php?result=success&lastpage={$_GET['lastpage']}");
      }
} else {
    echo "Error deleting table: " . mysqli_error($conn);
}

mysqli_close($conn);
<?php
require_once 'databasehandler.inc.php';
require_once 'functions.inc.php';
$y = "year_".$_GET['year'];
$sql = "DELETE FROM `docs` WHERE img_year = '{$_GET['year']}' AND img_type = '{$_GET['docType']}';";

// Execute multiple queries
if (mysqli_multi_query($conn, $sql)) {
    if ($result = mysqli_store_result($conn)) {
        while ($row = mysqli_fetch_row($result)) {
          
        }
        mysqli_free_result($result);
      } else {
        header("location: ../docs.php?year={$_GET['year']}&imgType={$_GET['docType']}");
      }
} else {
    echo "Error deleting table: " . mysqli_error($conn);
}

mysqli_close($conn);
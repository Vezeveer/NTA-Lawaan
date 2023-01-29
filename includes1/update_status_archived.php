<?php

require_once 'databasehandler.inc.php';

function updateStatusOfCurrentYear($conn, $year){
    $resultUpd = "UPDATE `status` SET `status`='approved', active='0' WHERE year=$year";
    if (mysqli_query($conn, $resultUpd)) {
        header("location: ../dashboard.php?userType={$_GET['userType']}");
    } else {
    echo "Error updating record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}

updateStatusOfCurrentYear($conn, $_GET['year']);
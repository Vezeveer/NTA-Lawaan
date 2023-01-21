<?php

require_once 'databasehandler.inc.php';

function updateStatusOfCurrentYear($conn, $year, $userType){
    $resultUpd = "";
    switch($userType){
        case "bo":
            $resultUpd = "UPDATE `status` SET `status`='bo_approved' WHERE year=$year";
            break;
        case "bdc":
            $resultUpd = "UPDATE `status` SET `status`='bc_finalizing' WHERE year=$year";
            $_SESSION['status'] = 'bc_finalizing'; // TODO: Cannot set status SESSION to said
            break;
        case "bc":
            $resultUpd = "UPDATE `status` SET `status`='pending_bo_approval' WHERE year=$year";
            break;
        default:
    }
    
    if (mysqli_query($conn, $resultUpd)) {
        // header("location: ../dashboard.php");
        header("location: logout.inc.php"); // TODO: Temporary logout for now..., because status does not change for current session
    } else {
    echo "Error updating record: " . mysqli_error($conn);
    }

    
    mysqli_close($conn);
}

updateStatusOfCurrentYear($conn, $_GET['year'], $_GET["userType"]);
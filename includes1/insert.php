<?php

include('databasehandler.inc.php');

if (true){
    // MySQLi Procedural
    $sql = "INSERT INTO `year_{$_GET['year']}` 
    (project, aipRefCode, activityDesc, 
    impOffice, startDate, endDate, expectedOutput, 
    fundingServices, personalServices, maint, 
    capitalOutlay, total)
    VALUES ('{$_POST['project']}', 
    '{$_POST['aipRefCode']}', '{$_POST['activityDesc']}', 
    '{$_POST['impOffice']}', '{$_POST['startDate']}', 
    '{$_POST['endDate']}', '{$_POST['expectedOutput']}', 
    '{$_POST['fundingServices']}', '{$_POST['personalServices']}', 
    '{$_POST['maint']}', '{$_POST['capitalOutlay']}', 
    '{$_POST['total']}')";

    if (mysqli_query($conn, $sql)) {
        header("location: ../main.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
    
    
}
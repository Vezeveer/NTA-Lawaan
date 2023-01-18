<?php

include('includes\databasehandler.inc.php');

if (true){
    echo "YES";

    // $stmt = $pdo->prepare("
    // INSERT INTO year_2017 (project, aipRefCode, activityDesc, impOffice) 
    // VALUES (:project, :aipRefCode, activityDesc, impOffice)
    // ");
    // $stmt->bindParam(':project', $project);
    // $stmt->bindParam(':aipRefCode', $aipRefCode);
    // $stmt->bindParam(':activityDesc', $activityDesc);
    // $stmt->bindParam(':impOffice', $impOffice);

    // $project = $_POST['project'];
    // $aipRefCode = $_POST['aipRefCode'];
    // $activityDesc = $_POST['activityDesc'];
    // $impOffice = $_POST['impOffice'];

    // $stmt->execute();

    // MySQLi Procedural
    $sql = "INSERT INTO `{$_GET['year']}` 
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
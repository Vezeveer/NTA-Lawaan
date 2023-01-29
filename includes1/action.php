<?php

//action.php

include('database_connection.php');
$yr = "year_".$_GET['year'];

if ($_POST['action'] == 'edit') {
    $data = array(
        ':aipRefCode'   => $_POST['aipRefCode'],
        ':id'    => $_POST['id'],
        ':activityDesc' => $_POST['activityDesc'],
        ':impOffice' => $_POST['impOffice'],
        ':startDate' => $_POST['startDate'],
        ':endDate' => $_POST['endDate'],
        ':expectedOutput' => $_POST['expectedOutput'],
        ':fundingServices' => $_POST['fundingServices'],
        ':personalServices' => $_POST['personalServices'],
        ':maint' => $_POST['maint'],
        ':capitalOutlay' => $_POST['capitalOutlay'],
        ':total' => $_POST['total'],
    );

    $query = "
        UPDATE {$yr} SET
        aipRefCode = :aipRefCode,
        activityDesc = :activityDesc, 
        impOffice = :impOffice, 
        startDate = :startDate, 
        endDate = :endDate, 
        expectedOutput = :expectedOutput, 
        fundingServices = :fundingServices, 
        personalServices = :personalServices,
        maint = :maint,
        capitalOutlay = :capitalOutlay,
        total = :total 
        WHERE id = :id
    ";
    $statement = $pdo->prepare($query);
    $statement->execute($data);
    echo json_encode($_POST);
}

if ($_POST['action'] == 'delete') {
    $query = "
        DELETE FROM {$yr} 
        WHERE id = '" . $_POST["id"] . "'
    ";
    $statement = $pdo->prepare($query);
    $statement->execute();
    echo json_encode($_POST);
}


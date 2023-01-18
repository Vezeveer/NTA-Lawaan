<?php

//action.php

include('includes\database_connection.php');

if ($_POST['action'] == 'edit') {
    $data = array(
        ':project'  => $_POST['project'],
        ':approved'  => $_POST['approved'],
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
 UPDATE year_2017 
 SET project = :project, 
 approved = :approved, 
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
 DELETE FROM year_2017 
 WHERE id = '" . $_POST["id"] . "'
 ";
    $statement = $pdo->prepare($query);
    $statement->execute();
    echo json_encode($_POST);
}


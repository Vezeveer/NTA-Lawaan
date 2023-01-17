<?php

//action.php

include('database_connection.php');

if ($_POST['action'] == 'edit') {
    $data = array(
        ':project'  => $_POST['project'],
        ':approved'  => $_POST['approved'],
        ':aipRefCode'   => $_POST['aipRefCode'],
        ':id'    => $_POST['id']
    );

    $query = "
 UPDATE year_2017 
 SET project = :project, 
 approved = :approved, 
 aipRefCode = :aipRefCode 
 WHERE id = :id
 ";
    $statement = $connect->prepare($query);
    $statement->execute($data);
    echo json_encode($_POST);
}

if ($_POST['action'] == 'delete') {
    $query = "
 DELETE FROM year_2017 
 WHERE id = '" . $_POST["id"] . "'
 ";
    $statement = $connect->prepare($query);
    $statement->execute();
    echo json_encode($_POST);
}

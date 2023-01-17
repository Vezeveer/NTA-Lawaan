<?php
include('database_connection.php');

$column = array("id", "project", "approved", "aipRefCode", "activityDesc", "impOffice", "startDate", "endDate", "expectedOutput", "fundingServices", "personalServices", "maint", "capitalOutlay", "total");
$query = "SELECT * FROM year_2017 ";

if (isset($_POST["search"]["value"])) {
    $query .= '
 WHERE project LIKE "%' . $_POST["search"]["value"] . '%" 
 OR approved LIKE "%' . $_POST["search"]["value"] . '%" 
 OR aipRefCode LIKE "%' . $_POST["search"]["value"] . '%" 
 OR activityDesc LIKE "%' . $_POST["search"]["value"] . '%" 
 OR impOffice LIKE "%' . $_POST["search"]["value"] . '%" 
 OR startDate LIKE "%' . $_POST["search"]["value"] . '%" 
 OR endDate LIKE "%' . $_POST["search"]["value"] . '%" 
 OR expectedOutput LIKE "%' . $_POST["search"]["value"] . '%" 
 OR fundingServices LIKE "%' . $_POST["search"]["value"] . '%" 
 OR personalServices LIKE "%' . $_POST["search"]["value"] . '%" 
 OR maint LIKE "%' . $_POST["search"]["value"] . '%" 
 OR capitalOutlay LIKE "%' . $_POST["search"]["value"] . '%" 
 OR total LIKE "%' . $_POST["search"]["value"] . '%" 
 ';
}

if (isset($_POST["order"])) {
    $query .= 'ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
} else {
    $query .= 'ORDER BY id DESC ';
}

$query1 = '';

if ($_POST["length"] != -1) {
    $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($query);
$statement->execute();
$number_filter_row = $statement->rowCount();
$statement = $connect->prepare($query . $query1);
$statement->execute();
$result = $statement->fetchAll();
$data = array();

foreach ($result as $row) {
    $sub_array = array();
    $sub_array[] = $row['id'];
    $sub_array[] = $row['project'];
    $sub_array[] = $row['approved'];
    $sub_array[] = $row['aipRefCode'];
    $sub_array[] = $row['activityDesc'];
    $sub_array[] = $row['impOffice'];
    $sub_array[] = $row['startDate'];
    $sub_array[] = $row['endDate'];
    $sub_array[] = $row['expectedOutput'];
    $sub_array[] = $row['fundingServices'];
    $sub_array[] = $row['personalServices'];
    $sub_array[] = $row['maint'];
    $sub_array[] = $row['capitalOutlay'];
    $sub_array[] = $row['total'];
    $data[] = $sub_array;
}

function count_all_data($connect)
{
    $query = "SELECT * FROM year_2017";
    $statement = $connect->prepare($query);
    $statement->execute();
    return $statement->rowCount();
}

$output = array(
    'draw'   => intval($_POST['draw']),
    'recordsTotal' => count_all_data($connect),
    'recordsFiltered' => $number_filter_row,
    'data'   => $data
);

echo json_encode($output);

?>
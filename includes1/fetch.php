<?php
include('database_connection.php');

$projectName = $_GET['projectName'];
$yr = "year_".$_GET['year'];
$column = array("id", "aipRefCode", "activityDesc", "impOffice", "startDate", "endDate", "expectedOutput", "fundingServices", "personalServices", "maint", "capitalOutlay", "total", "project");
$query = "SELECT * FROM {$yr} WHERE project = '{$projectName}' ";

if (isset($_POST["search"]["value"])) {
    $query .= '
 AND (aipRefCode LIKE "%' . $_POST["search"]["value"] . '%" 
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
 )';
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

$statement = $pdo->prepare($query);
$statement->execute();

$number_filter_row = $statement->rowCount();

$statement = $pdo->prepare($query . $query1);
$statement->execute();

$result = $statement->fetchAll();
$data = array();

foreach ($result as $row) {
    $sub_array = array();
    $sub_array[] = $row['id'];
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
    $sub_array[] = $row['project'];
    $data[] = $sub_array;
}

function count_all_data($pdo)
{
    $yr = "year_".$_GET['year'];
    $query = "SELECT * FROM {$yr} WHERE project = \"{$_GET['projectName']}\" ";
    $statement2 = $pdo->prepare($query);
    $statement2->execute();
    return $statement2->rowCount();
}

$output = array(
    'draw'   => intval($_POST['draw']),
    'recordsTotal' => count_all_data($pdo),
    'recordsFiltered' => $number_filter_row,
    'data'   => $data,
    'query1' => $query
);

echo json_encode($output);

?>
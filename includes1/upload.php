<?php
require_once 'databasehandler.inc.php';

if ($_FILES['file']['error'] == UPLOAD_ERR_OK) {
  // Generate unique filename
  $filename = uniqid() . '-' . basename($_FILES['file']['name']);

  // Move file to uploads folder
  //move_uploaded_file($_FILES['file']['tmp_name'], '../uploads/' . $filename);

  // Insert file information into database
  $sql = "INSERT INTO docs (img_name, img_data, img_year, img_type, img_ext) VALUES (?, ?, ?, ?, ?)";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "sssss", $filename, file_get_contents($_FILES['file']['tmp_name']), $_GET['year'], $_POST['docType'], $_FILES['file']['type']);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  header("location: ../docs.php?filesuccess=yes&year={$_GET['year']}&imgType={$_POST['docType']}");
} else {
    header("location: ../docs.php?filesuccess=no&year={$_GET['year']}&imgType={$_POST['docType']}");
}
?>
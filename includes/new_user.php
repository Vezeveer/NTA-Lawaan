<?php

require_once 'databasehandler.inc.php';

$userHashedPw = password_hash($_POST['userPsw'], PASSWORD_DEFAULT);

// MySQLi Procedural
$sql = "INSERT INTO user_table (userName, userPwd, userType, fullname, email)
VALUES ('{$_POST['userName']}', '{$userHashedPw}', '{$_POST['userType']}', '{$_POST['fullName']}', '{$_POST['userEmail']}')";

if($_POST['userPsw'] == $_POST['userPsw2']){
    if (mysqli_query($conn, $sql)) {
        header("location: ../main.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} 


mysqli_close($conn);

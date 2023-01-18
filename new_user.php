<?php

require_once 'includes/databasehandler.inc.php';

// MySQLi Procedural
$sql = "INSERT INTO user_table (userName, userPwd, userType)
VALUES ('{$_POST['userName']}', '{$_POST['userPwd']}', '{$_POST['userType']}')";

if($_POST['userPwd'] == $_POST['userPwd2']){
    if (mysqli_query($conn, $sql)) {
        header("location: ../main.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} 


mysqli_close($conn);

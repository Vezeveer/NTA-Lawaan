<?php

function emptyInputLogin($username, $password){
    $result = true;
    if(empty($username) || empty($password)){
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function loginUser($conn, $username, $password){
    $userExistsData = userExists($conn, $username);

    if($userExistsData === false){
        header("location: ../index.php?error=userdoesnotexist");
        exit();
    }

    $pwdHashed = $userExistsData["usersPwd"];
    $checkPwd = password_verify($password, $pwdHashed);

    if($checkPwd === false){
        header("location: ../index.php?error=userdoesnotexist");
        exit();
    }elseif($checkPwd === true){
        session_start();
        $_SESSION["usersname"] = $userExistsData["usersName"];
        header("location: ../main.php");
        exit();
    }

    // if(!($userExistsData["usersPwd"] === $password)){
    //     header("location: ../index.php?error=wrongpassword");
    //     exit();
    // }else{
    //     session_start();
    //     $_SESSION["usersname"] = $userExistsData["usersName"];
    //     header("location: ../main.php");
    //     exit();
    // }
}

function userExists($conn, $username){
    $sql = "SELECT * FROM users WHERE usersName = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $username); // ss for two string variables, sss=3
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    // check if there is anything in $resultData, then return it
    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }else{
        $result = false;
       return $result;
    }

    mysqli_stmt_close($stmt);
}

function getItems($conn, $aipRefCode){
    $sql = "SELECT * FROM projects;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $aipRefCode); // ss for two string variables, sss=3
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    // check if there is anything in $resultData, then return it
    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }else{
        $result = false;
       return $result;
    }

    mysqli_stmt_close($stmt);
}

/*
//statement to insert data
function createUser($conn, $username, $password){
    $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUES (?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ss", $name, $email, $username, $hashedPwd);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }else{
        $result = false;
       return $result;
    }

    mysqli_stmt_close($stmt);
}
*/
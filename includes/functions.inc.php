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
    $activeYear = getActiveYear($conn);
    $status = getStatusOfCurrentYear($conn, $activeYear);

    if($userExistsData === false){
        header("location: ../index.php?error=userdoesnotexist");
        exit();
    }

    $pwdHashed = $userExistsData["userPwd"];
    $checkPwd = password_verify($password, $pwdHashed);

    if($checkPwd === false){
        header("location: ../index.php?error=userdoesnotexist");
        exit();
    }elseif($checkPwd === true){
        session_start();
        $_SESSION["usersname"] = $userExistsData["userName"];
        $_SESSION["userType"] = $userExistsData["userType"];
        $_SESSION["status"] = $status;
        $_SESSION["activeYear"] = $activeYear;
        header("location: ../main.php?status=$status");
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
    $sql = "SELECT * FROM user_table WHERE userName = ?;";
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
        mysqli_stmt_close($stmt);
        return $row;
    }else{
        $result = false;
        mysqli_stmt_close($stmt);
        return $result;
    }
}

function getStatusOfCurrentYear($conn, $year){
    $result = mysqli_query($conn, "SELECT * FROM `status` WHERE year=$year");
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            return $row["status"];
        }
    } else {
        return "0 results";
    }
    mysqli_close($conn);
}

function getActiveYear($conn){
    $result = mysqli_query($conn, "SELECT * FROM `status` WHERE active=1");
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            return $row["year"];
        }
    } else {
        return "0 results";
    }
    mysqli_close($conn);
}

function getInactiveYears($conn, $year){
    $result = mysqli_query($conn, "SELECT * FROM `status` WHERE year!=$year");
    $years = array();
    foreach($result as $row){
        array_push($years, $row['year']);
    }
    if (mysqli_num_rows($result) > 0) {
        // while($row = mysqli_fetch_assoc($result)) {
        //     return $row["status"];
        // }
        return $years;
    } else {
        return "0 results";
    }
    mysqli_close($conn);
}

function getItems($conn, $year){
    $sql = "SELECT * FROM $year";
    $result = mysqli_query($conn, $sql);

    $array1 = array();

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            array_push($array1, $row);
        }
    } else {
        
    }

    mysqli_close($conn);
    return $array1;

    // $sql = "SELECT * FROM projects WHERE aipRefCode = ?;";
    // $stmt = mysqli_stmt_init($conn);

    // if(!mysqli_stmt_prepare($stmt, $sql)){
    //     header("location: ../index.php?error=stmtfailed");
    //     exit();
    // }

    // mysqli_stmt_bind_param($stmt, "s", $aipRefCode); // ss for two string variables, sss=3
    // mysqli_stmt_execute($stmt);

    // $resultData = mysqli_stmt_get_result($stmt);

    // // check if there is anything in $resultData, then return it
    // $array1 = array();
    // while($row = mysqli_fetch_assoc($resultData)){
    //     array_push($array1, $row);
    // }
    // mysqli_stmt_close($stmt);
    // return $array1;
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
        mysqli_stmt_close($stmt);
        return $row;
    }else{
        $result = false;
        mysqli_stmt_close($stmt);
        return $result;
    }
}
*/


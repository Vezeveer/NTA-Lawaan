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
    $status = "no_active";
    $activeYear = getActiveYear($conn);
    if($activeYear == 'noActive'){

    } else {
        $status = getStatusOfCurrentYear($conn, $activeYear);
    }

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
        $totalUsers = update_user_log($conn, true);
        header("location: ../dashboard.php?totalUsers={$totalUsers}");
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

function update_user_log($conn, $loggedIn){
    $totalUsers = 0;
    
    $result = mysqli_query($conn, "SELECT * FROM user_log");
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $totalUsers = $row["total_users"];
        }
    } else {
        return "0 results";
    }
    
    if($loggedIn == true){
        $totalUsers = $totalUsers+1;
        $resultUpd = "UPDATE user_log SET total_users={$totalUsers} WHERE id=0";
        if (mysqli_query($conn, $resultUpd)) {
           
          } else {
            echo "Error updating record: " . mysqli_error($conn);
          }
    }
    
    if($loggedIn == false){
        $totalUsers = $totalUsers-1;
        $resultUpd = "UPDATE user_log SET total_users={$totalUsers} WHERE id=0";
        if (mysqli_query($conn, $resultUpd)) {
            
          } else {
            echo "Error updating record: " . mysqli_error($conn);
          }
    }
    
    mysqli_close($conn);
    return $totalUsers;
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
        mysqli_close($conn);
    } else {
        mysqli_close($conn);
        return "noActive";
    }
}

function getInactiveYears($conn, $year){
    $result = '';
    if(getActiveYear($conn) == 'noActive'){
        $result = mysqli_query($conn, "SELECT * FROM `status`");
    } else {
        $result = mysqli_query($conn, "SELECT * FROM `status` WHERE year!=$year");
    }
    
    $years = array();
    foreach($result as $row){
        array_push($years, $row['year']);
    }
    if (mysqli_num_rows($result) > 0) {
        return $years;
    } else {
        return "0 results";
    }
    mysqli_close($conn);
}

function getItems($conn, $year){
    if(getActiveYear($conn) == 'noActive'){
        $_SESSION['status'] = 'no_active';
        return;
    } else {
        $_SESSION['status'] = getStatusOfCurrentYear($conn, getActiveYear($conn));
    }
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
}

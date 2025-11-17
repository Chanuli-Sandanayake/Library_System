<?php

// Function to validate username format
function invalidUsername($user_name){
    $result;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $user_name)){
        $result = true;
    } else {
        $result = false;
    }
    return $result; 
}

// Function to validate user ID
function invalidUserId($userid) {
    $result;
    if (!preg_match("/^U\d{3}$/", $userid)){
        $result = true;
    } else {
        $result = false;
    }
    return $result;                 
}

// Function to validate password                   
function invalidpwd($pwd) {
    $result;
    if (!preg_match("/^[a-zA-Z0-9!@#$]{8,}$/", $pwd)) {
        $result = true; 
    } else {
        $result = false; 
    }   
    return $result;
}



// Function to validate email format
function invalidEmail($email){
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// Function to check if username or email already exists in the database
function usernameExists($conn, $user_name, $email, $userid) {
    $sql = "SELECT * FROM user WHERE username = ? OR email = ? OR user_id = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location:../index.html?stat=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "sss", $user_name, $email, $userid);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        return false;
    }
    mysqli_stmt_close($stmt);

}

// Function to create a new user in the database
function createUser($conn, $userid, $fname, $lname, $user_name, $email, $pwd){
    $sql = "INSERT INTO user (user_id, email, first_name, last_name, username, password) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("Location:../index.html?stat=stmtfailed");
        exit();
    }
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "ssssss", $userid, $email, $fname, $lname, $user_name, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location:../index.html?stat=none");
    exit();
}
//login function
function loginUser($conn, $user_name, $pwd) {
    
    $sql = "SELECT * FROM user WHERE username = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location:../index.html?stat=sqlerror");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $user_name);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        // Verify password
        $pwdCheck = password_verify($pwd, $row['password']);
        if ($pwdCheck == false) {
            header("Location:../index.html?stat=wrongpwd");
            exit();
        } elseif ($pwdCheck == true) {
            // Start session and store user data
            session_start();
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_name'] = $row['username'];
            header("Location:dashboard.php?stat=success");
            exit();
        }
    } else {
        header("Location:../index.html?stat=nouser");
        exit();
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}


?>
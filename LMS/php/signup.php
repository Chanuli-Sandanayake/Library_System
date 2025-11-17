<?php

if (isset($_POST["submit"])) {
    $userid = $_POST["userid"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $user_name = $_POST["user_name"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];

    require_once 'db.php';
    require_once 'function.php';

    $invalidUserId = invalidUserId($userid);
    $invalidUsername = invalidUsername($user_name);
    $invalidEmail = invalidEmail($email);
    $invalidpwd = invalidpwd($pwd);             
    $userExists = usernameExists($conn, $user_name, $email, $userid);
    

    if ($invalidUserId !== false){
        header("Location:../index.html?stat=invaliduserid");
        exit();     
    }
    if ($invalidUsername !== false){
        header("Location:../index.html?stat=invalidusername");
        exit();     
    }
    if ($invalidEmail !== false){
        header("Location:../index.html?stat=invalidemail");
        exit(); 

    }if ($invalidpwd !== false){                                
        header("Location:../index.html?stat=invalidpwd");
        exit();    
    }                                                           
    if ($userExists !== false){
        header("Location:../index.html?stat=Already_Exists");
        exit();     
    }

    createUser($conn, $userid, $fname, $lname, $user_name, $email, $pwd);

} else {
    header('Location:../index.html');
    exit();
}
?>

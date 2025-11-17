<?php

if (isset($_POST["login"])) {
    $user_name = $_POST["user_name"];
    $pwd = $_POST["pwd"];

    require_once 'db.php';
    require_once 'function.php';

    if ($user_name == 'k_perera' && $pwd == 'admin123') {
        session_start();
        $_SESSION['user_name'] = 'k_perera';
        header('Location:admin.php?stat=admin_login_successful');
        exit();
    } else {
        loginUser($conn, $user_name, $pwd);
    }
} else {
    header('Location:../index.html?stat=error1');
    exit();
}

?>

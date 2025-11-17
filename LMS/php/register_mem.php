<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $member_id = $_POST['member_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $birthday = $_POST['birthday'];
    $email = $_POST['email'];

    // Validate member_id
    if (!preg_match("/^M\d{3}$/", $member_id)) {
        die("Invalid Member ID format. It should be 'M<MEMBER_ID>' (e.g., M001).");
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    // Check if member already exists
    $sql = "SELECT * FROM member WHERE email = ? OR member_id = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location:signup_mem.php?stat=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $email, $member_id);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($resultData)) {
        mysqli_stmt_close($stmt);
        header("Location:signup_mem.php?stat=Email_or_member_id_Exists");
        exit();
    }
    mysqli_stmt_close($stmt);

    // Insert new member
    $sql = "INSERT INTO member (member_id, first_name, last_name, birthday, email) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location:signup_mem.php?stat=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "sssss", $member_id, $first_name, $last_name, $birthday, $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location:signup_mem.php?stat=registration_successful");
    exit();
} else {
    header('Location:signup_mem.php');
    exit();
}
?>

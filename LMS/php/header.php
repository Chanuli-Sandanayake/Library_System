<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_name'])) {
    header('Location:../index.html?error=notloggedin');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>LMS Dashboard</title>

  <link rel="stylesheet" href="../css/style.css" />
  <link rel="shortcut icon" href="../img/01.png" title="LMS">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>

<body style="background-image: url('../img/bg1.jpg'); background-attachment: fixed" >
  <section class="home">
    <header class="header1">
      <nav class="nav1">
      
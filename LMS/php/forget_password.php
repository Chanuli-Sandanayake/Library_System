<?php
include_once 'db.php';

// Define variables to hold user input values
$userid = $user_name = $email = $new_pwd = '';

// Check if form is submitted
if (isset($_POST["submit"])) {
    // Fetching user input
    $userid = $_POST["userid"];
    $user_name = $_POST["user_name"];
    $email = $_POST["email"];

    // Check if user ID, username, and email match in the database
    if (!usernameExists($conn, $user_name, $email, $userid)) {
        // If user not found, redirect back to the form with error status
        header("Location: forget_password.php?stat=user_not_found");
        exit();
    } else {
        // If user found, check if new password is provided
        if(isset($_POST["new_pwd"])) {
            $new_pwd = $_POST["new_pwd"];
            if (strlen($new_pwd) > 7) {
                // Update the password in the database
                $result = updateUserPassword($conn, $userid, password_hash($new_pwd, PASSWORD_DEFAULT));
                if ($result['status'] == 'success') {
                    header("Location:../index.html?stat=password_updated");
                    exit();
                } else {
                    header("Location: forget_password.php?stat=password_update_failed");
                    exit();
                }
            } else {
                header("Location: forget_password.php?stat=invalidpwd");
                exit();
            }
        } else {
            // If new password not provided, display the input box for it
            $showNewPwdInput = true;
        }
    }
}

// Display the form
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Library Management System" />
    <title>LMS - Forget Password</title>
    <link rel="stylesheet" href="../css/style.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/01.png" title="LMS">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>
<body>
    <section class="home" style="background-image: url('../img/bg.jpg');">
        <header class="header1">
            <nav class="nav1">
                <p class="nav_logo1">Password Reset</p>
                <ul class="nav_items">
                <li class="nav_item">
                <a href="../index.html" class="nav_link">Login</a>
                </li>
            </ul>
            </nav>
        </header>
        <div class="container3">
            <div class="" >
            <form action="forget_password.php" method="POST" class="form3">
                <div class="input_box">
                    <i class="uil uil-user"></i>
                    <input type="text" class="rounded-input1" style="width:350px; height:47px" name="userid" placeholder="Enter Your Registered User ID eg: Uxxx" value="<?php echo htmlspecialchars($userid, ENT_QUOTES, 'UTF-8'); ?>" required />
                </div>
            <div class="input_box">
                <i class="uil uil-envelope-alt email"></i>
                <input type="email" class="rounded-input1" style="width:350px; height:47px" name="email" placeholder="Enter Your Registered Email" value="<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>" required />
            </div>
            <div class="input_box">
                <i class="uil uil-user-circle"></i>
                <input type="text" class="rounded-input1" style="width:350px; height:47px" name="user_name" placeholder="Enter Your Registered User Name" value="<?php echo htmlspecialchars($user_name, ENT_QUOTES, 'UTF-8'); ?>" required />
            </div>
            <?php if(isset($showNewPwdInput) && $showNewPwdInput): ?>
            <!-- Display new password input box -->
            <div class="input_box">
                <input type="password" class="rounded-input1" id="password" style="width:350px; height:47px" name="new_pwd" placeholder="Enter New Password" required />
                <i class="uil uil-lock password"></i>
                <i class="uil uil-eye-slash pw_hide" id="togglePassword" style="cursor: pointer;"></i>
            </div>
            <br>
            <button class="button2" type="submit" name="submit" style="display: block; margin: 0 auto;">Update Password</button>
            <?php else: ?>
            <!-- Display submit button if user not found or validation failed -->
            <br><br>
            <button class="button2" type="submit" name="submit" style="display: block; margin: 0 auto;">Submit</button>
            <br><br><br>
            <?php endif; ?>
            <div><br><br><br><br><br></div>
        </form>

        <script src="../js/alert.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const togglePassword = document.getElementById('togglePassword');
                const password = document.getElementById('password');

                togglePassword.addEventListener('click', function (e) {
                    // Toggle the type attribute
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
            
                    // Toggle the eye / eye slash icon
                    this.classList.toggle('uil-eye');
                    this.classList.toggle('uil-eye-slash');
                });
            });
            AOS.init();
        </script>

    </body>
</html>

<?php
// Database functions
function usernameExists($conn, $user_name, $email, $userid) {
    $sql = "SELECT * FROM user WHERE username = ? OR email = ? OR user_id = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        return false;
    }
    mysqli_stmt_bind_param($stmt, "sss", $user_name, $email, $userid);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    $result = mysqli_fetch_assoc($resultData);

    // Check if provided username, email, and user ID match with each other
    if ($result && $result['username'] === $user_name && $result['email'] === $email && $result['user_id'] === $userid) {
        mysqli_stmt_close($stmt);
        return true;
    } else {
        mysqli_stmt_close($stmt);
        return false;
    }
}


function updateUserPassword($conn, $userid, $hashedPwd) {
    $sql = "UPDATE user SET password = ? WHERE user_id = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        return array('status' => 'error', 'message' => 'stmtfailed');
    }
    mysqli_stmt_bind_param($stmt, "ss", $hashedPwd, $userid);
    if (!mysqli_stmt_execute($stmt)) {
        return array('status' => 'error', 'message' => 'stmtfailed');
    }
    mysqli_stmt_close($stmt);
    return array('status' => 'success', 'message' => 'Password updated successfully');
}
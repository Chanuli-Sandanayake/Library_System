<?php
include_once 'header.php';
include_once 'db.php';

if (isset($_POST["submit"])) {
    // Fetching user input
    $userid = $_POST["userid"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $user_name = $_POST["user_name"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];

    // Validation
    $invalidUserId = invalidUserId($userid);
    $invalidUsername = invalidUsername($user_name);
    $invalidEmail = invalidEmail($email);
    $invalidpwd = invalidpwd($pwd);
    $userExists = usernameExists($conn, $user_name, $email, $userid);

    if ($invalidUserId !== false) {
        header("Location: add_user.php?stat=invaliduserid");
        exit();     
    }
    if ($invalidUsername !== false) {
        header("Location: add_user.php?stat=invalidusername");
        exit();     
    }
    if ($invalidEmail !== false) {
        header("Location: add_user.php?stat=invalidemail");
        exit(); 
    }
    if ($invalidpwd !== false) {                                
        header("Location: add_user.php?stat=invalidpwd");
        exit();    
    }
    if ($userExists !== false) {
        header("Location: add_user.php?stat=usernametaken");
        exit();     
    }

    $result = createUser($conn, $userid, $fname, $lname, $user_name, $email, $pwd);
    if ($result['status'] == 'success') {
        header("Location: add_user.php?stat=Created");
        exit();
    } else {
        header("Location: add_user.php?stat=" . urlencode($result['message']));
        exit();
    }
}
?>


            <p class="nav_logo1">Admin Dashboard &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Add User</p>
            <ul class="nav_items">
                <li class="nav_item">
                    <a href="admin.php" class="nav_link">Home</a> 
                    <button class="button2" id="logoutBtn">Logout</button>
                </li>
            </ul>
        </nav>
    </header>

    <div class="container3">

        <!-- Signup Form -->
        <div class="" >
            <form action="add_user.php" method="POST">
                <div class="input_box">
                    <input type="text" class="rounded-input1" name="userid" placeholder="User ID eg: Uxxx" required />
                </div>
                <div class="input_box">
                    <input type="text" class="rounded-input1" name="fname" placeholder="First Name" required />
                </div>
                <div class="input_box">
                    <input type="text" class="rounded-input1" name="lname" placeholder="Last Name" required />
                </div>
                <div class="input_box">
                    <input type="text" class="rounded-input1" name="user_name" placeholder="User Name" required />
                </div>
                <div class="input_box">
                    <input type="email" class="rounded-input1" name="email" placeholder="Email" required />
                </div>
                <div class="input_box">
                    <input type="text" class="rounded-input1" name="pwd" placeholder="Password" required />
                </div><br>
                <button class="button2" type="submit" name="submit" style="display: block; margin: 0 auto;">Add</button>

            </form>
            <script src="../js/arlet.js"></script>
        </div>
    </div>

    <script src="../js/script.js"></script>
    <script>
        document.getElementById("updateLink").addEventListener("click", function(event) {
            event.preventDefault();
            document.getElementById('editForm').submit();
        });
        AOS.init();
    </script>


<?php




function invalidUsername($user_name) {
    return !preg_match("/^[a-zA-Z0-9]*$/", $user_name);
}

function invalidUserId($userid) {
    return !preg_match("/^U\d{3}$/", $userid);
}

function invalidpwd($pwd) {
    return !preg_match("/^[a-zA-Z0-9!@#$]{8,}$/", $pwd);
}

function invalidEmail($email) {
    return !filter_var($email, FILTER_VALIDATE_EMAIL);
}

function usernameExists($conn, $user_name, $email, $userid) {
    $sql = "SELECT * FROM user WHERE username = ? OR email = ? OR user_id = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        return true; // Assume user exists if statement fails to prepare
    }
    mysqli_stmt_bind_param($stmt, "sss", $user_name, $email, $userid);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    $result = mysqli_fetch_assoc($resultData);
    mysqli_stmt_close($stmt);
    return $result !== null;
}

function createUser($conn, $userid, $fname, $lname, $user_name, $email, $pwd) {
    $sql = "INSERT INTO user (user_id, email, first_name, last_name, username, password) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        return array('status' => 'error', 'message' => 'stmtfailed');
    }
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "ssssss", $userid, $email, $fname, $lname, $user_name, $hashedPwd);
    if (!mysqli_stmt_execute($stmt)) {
        return array('status' => 'error', 'message' => 'stmtfailed');
    }
    mysqli_stmt_close($stmt);
    return array('status' => 'success', 'message' => 'User created successfully');
}
include_once 'footer.php';
$conn->close();

?>
